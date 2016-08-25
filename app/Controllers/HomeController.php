<?php

namespace nofw\app\Controllers;

class HomeController
{
    /** @var \Twig_Environment */
    private $twig;

    public function __construct(\Twig_Environment $te)
    {
        $this->twig = $te;
    }

    public function indexAction()
    {
        $this->twig->display('home/index.twig', ['message' => 'Yay!']);
    }
}