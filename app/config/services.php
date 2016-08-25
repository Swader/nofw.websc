<?php

return [

    Twig_Environment::class => function () {

        $loader = new Twig_Loader_Filesystem(ROOT . '/app/views');
        $te = new Twig_Environment($loader);

        return $te;
    },

    Psr\Log\LoggerInterface::class => function () {
        $logger = new \Monolog\Logger('nofwlog');

        $logger->pushHandler(
            new Monolog\Handler\StreamHandler(ROOT . '/logs/all.log')
        );
        $logger->pushHandler(
            new Monolog\Handler\StreamHandler(
                ROOT . '/logs/error.log', \Monolog\Logger::NOTICE
            )
        );

        Monolog\ErrorHandler::register($logger);

        return $logger;
    },

];