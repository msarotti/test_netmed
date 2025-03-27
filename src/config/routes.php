<?php

use App\Controllers\IndexController;
use App\Controllers\ProjectController;

return [
    'GET' => [
        '/' => [IndexController::class, 'index'],
        '/projects' => [ProjectController::class, 'getAll'],
        '/project' => [ProjectController::class, 'getDetails'],
    ],
];