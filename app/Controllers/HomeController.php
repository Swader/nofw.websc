<?php

namespace nofw\app\Controllers;

use Psr\Log\LoggerInterface;

class HomeController
{
    /**
     * @Inject
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @Inject
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(\Twig_Environment $te, LoggerInterface $logger)
    {
        $this->twig = $te;
        $this->logger = $logger;
    }

    public function indexAction()
    {
        $this->twig->display('home/index.twig', ['message' => 'Yay!']);
    }
}