<?php
return [
    'rootDir' => __DIR__ . "/../",
    'templatesDir' => __DIR__ . "/../views/",
    'publicDir' => __DIR__ . "/../public/",
    'vendorDir' => __DIR__ . "/../vendor/",
    'defaultController' => 'product',
    'controllerNamespace' => "app\\controllers",
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3307',
            'login' => 'root',
            'password' => '',
            'database' => 'myShopDB',
            'charset' => 'utf8'
            ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'files' => [
            'class' => \app\services\Files::class
        ]
    ]
];