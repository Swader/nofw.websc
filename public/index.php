<?php

use nofw\app\Controllers\HomeController;

require_once '../vendor/autoload.php';

$homeController = new HomeController();
$homeController->indexAction();