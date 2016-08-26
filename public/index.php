<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;

define('ROOT', realpath(__DIR__.'/..'));
session_start();

require_once '../vendor/autoload.php';

$dotenv = new Dotenv(ROOT);
$dotenv->load();

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder
    ->addDefinitions(require_once '../app/config/services.php')
    ->useAnnotations(true)
    ->build();

$routeList = require ROOT . '/app/config/routes.php';

/** @var FastRoute\Dispatcher $dispatcher */
$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $r) use ($routeList) {
        foreach ($routeList as $routeDef) {
            $r->addRoute($routeDef[0], $routeDef[1], $routeDef[2]);
        }
    }
);

$route = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo $container->get(Twig_Environment::class)->render('errors/error404.twig');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo $container->get(Twig_Environment::class)->render('errors/error405.twig');
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        $container->call($controller, $parameters);
        break;
}