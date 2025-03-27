<?php
declare(strict_types=1);

namespace App\Common;

use DI\Container;

class Router {
    private array $routes;
    private Container $container;

    public function __construct(array $routes, Container $container) {
        $this->routes = $routes;
        $this->container = $container;
    }

    /**
     * Magage the route dispatching the request 
     * to the appropriate controller and method
     * 
     * @param string $method
     * @param string $path
     */
    public function dispatch(string $method, string $path) {
        $method = strtoupper($method);
        $path = parse_url($path, PHP_URL_PATH);

        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = preg_replace('/\{([^}]+)\}/', '(?P<\1>[^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches);
                    $matches = array_values($matches);
                    $controller = $this->container->get($handler[0]);
                    return call_user_func_array([$controller, $handler[1]], $matches);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
