<?php
declare(strict_types=1);

namespace App\Controllers;

use Twig\Environment;

class IndexController {

    public function __construct(
        private Environment $twig
    ) {}
    public function index(): void {
        echo $this->twig->render('home.html.twig', ['title' => 'NetMedica']);
    }
}