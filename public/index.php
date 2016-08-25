<?php

use DI\ContainerBuilder;
use nofw\app\Controllers\HomeController;

define('ROOT', realpath(__DIR__.'/..'));
session_start();

require_once '../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder
    ->addDefinitions(require_once '../app/config/services.php')
    ->useAnnotations(true)
    ->build();

$container->call([HomeController::class, 'indexAction']);