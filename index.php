<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Common\Router;
use DI\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$container = new Container();

$container->set(Environment::class, function () {
    $loader = new FilesystemLoader(__DIR__ . '/views');
    return new Environment($loader);
});

$routes = require __DIR__ . '/src/config/routes.php';
$router = new Router($routes, $container);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);