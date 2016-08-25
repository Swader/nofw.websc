<?php

use nofw\app\Controllers\HomeController;
use nofw\app\Controllers\NewController;

return [
    ['GET', '/', [HomeController::class, 'indexAction']],

    ['GET', '/new', NewController::class],
    ['GET', '/new/action', [NewController::class, 'newAction']],
];