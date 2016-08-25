<?php

namespace nofw\app\Controllers;

use Psr\Log\LoggerInterface;

class HomeController
{
    /** @var \Twig_Environment */
    private $twig;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(\Twig_Environment $te, LoggerInterface $logger)
    {
        $this->twig = $te;
        $this->logger = $logger;
    }

    public function indexAction()
    {
        $this->logger->info('We are in index.');
        $this->twig->display('home/index.twig', ['message' => 'Yay!']);
    }
}