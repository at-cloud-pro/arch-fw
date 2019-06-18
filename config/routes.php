<?php declare(strict_types=1);

use Controllers\InitialScreenController;

return [
    'default' => '/',
    'routes'  => [
        'route-name' => [
            'path'   => '/index',
            'class'  => InitialScreenController::class,
            'method' => 'render',
        ],
    ],
];
