<?php

namespace CustomMailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\user;
use TicketBundle\Entity\ticket;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('CustomMailerBundle:Default:index.html.twig');
    }

    public function sendNewTicketMail(user $user, ticket $newTicket)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject("New Ticket in epmanagement appeared!")
            ->setFrom('appeasyprojectmanagement@gmail.com')
            ->setTo('sharaquss@gmail.com')
          //  ->setCc('sharaquss@gmail.com')
            ->setBody(
                $this->renderView('CustomMailerBundle:Mails:emailTemplateNewTicket.html.twig',
                    array('username' => $user->getUsername(),
                        'ticket' => $newTicket)),
              'text/html');

        $this->get('mailer')->send($mail);

        return "mail sent";

    }
}
