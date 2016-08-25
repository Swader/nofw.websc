<?php

namespace nofw\app\Controllers;

use Psr\Log\LoggerInterface;

class NewController
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

    public function __invoke()
    {
        $this->twig->display('home/index.twig', ['message' => 'Invoked NewController!']);
    }

    public function newAction()
    {
        $this->twig->display('home/index.twig', ['message' => 'newAction from NewController!']);
    }
}