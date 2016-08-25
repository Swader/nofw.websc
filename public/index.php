<?php

use nofw\app\Controllers\HomeController;

define('ROOT', realpath(__DIR__.'/..'));
session_start();

require_once '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(ROOT.'/app/views');
$te = new Twig_Environment($loader);

$logger = new \Monolog\Logger('nofwlog');

$logger->pushHandler(
    new Monolog\Handler\StreamHandler('../logs/all.log')
);
$logger->pushHandler(
    new Monolog\Handler\StreamHandler('../logs/error.log', \Monolog\Logger::NOTICE)
);

Monolog\ErrorHandler::register($logger);

$logger->info('Logging set up');

$homeController = new HomeController($te, $logger);
$homeController->indexAction();