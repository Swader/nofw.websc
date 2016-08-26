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
        $this->twig->display(
            'home/index.twig', ['message' => 'Invoked NewController!']
        );
    }

    public function newAction()
    {
        $transport = \Swift_SmtpTransport::newInstance(
            getenv('MAILGUN_SMTP_HOST'), 2525
        )
            ->setUsername(getenv('MAILGUN_SMTP_LOGIN'))
            ->setPassword(getenv('MAILGUN_SMTP_PASS'));

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance('Hello from Mailgun')
            ->setFrom(['someone@domain.com' => 'John Doe'])
            ->setTo('bruno.skvorc@sitepoint.com')
            ->setBody("Test body!");

        $message = ($mailer->send($message)) ? "Success" : "Failure";

        $this->twig->display(
            'home/index.twig',
            ['message' => 'newAction from NewController tried sending an email: ' . $message]
        );
    }
}