<?php

use nofw\app\Controllers\HomeController;

define('ROOT', realpath(__DIR__.'/..'));
session_start();

require_once '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(ROOT.'/app/views');
$te = new Twig_Environment($loader);

$homeController = new HomeController($te);
$homeController->indexAction();