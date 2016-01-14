<?php

/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 14/01/16
 * Time: 12:54 AM
 */

use UserBundle\Entity\user;
use TicketBundle\Entity\ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomMailerServiceController extends Controller
{

    /*

    public function sendMail($target, $text) {
        $mail = \Swift_Message::newInstance()
            ->setSubject('easy Project Management app')
            ->setFrom('appeasyprojectmanagement@gmail.com')
            ->setTo($target, 'sharaquss@gmail.com')
            ->setBody($text);

        $this->get('mailer')->send($mail);
    }

    public function sendRegistrationMail(user $newUser) {

        $mail = \Swift_Message::newInstance()
            ->setSubject("Hi " . $newUser->getEmail())
            ->setFrom('appeasyprojectmanagement@gmail.com')
            ->setTo($newUser->getEmail(), 'sharaquss@gmail.com')
            ->setBody(
                'Hi!
                Thanks for registering in Easy Project Management app!

                Hope you will have fun with this management tool.
                Thanks again!');
        $this->get('mailer')->send($mail);
    }

    */

    public function sendNewTicketMail(user $user, ticket $newTicket) {

        $mail = \Swift_Message::newInstance()
            ->setSubject("New Ticket in epmanagement appeared!")
            ->setFrom('appeasyprojectmanagement@gmail.com')
            ->setTo($user->getEmail(), 'sharaquss@gmail.com')
            ->setBody(
                $this->renderView('@Mailer/emailTemplateNewTicket.html.twig',
                    array(  'username' => $user->getUsername(),
                            'ticket' => $newTicket)));

        $this->get('mailer')->send($mail);

/*
        ->setBody(
            $this->renderView(
            // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('name' => $name)
            ),
            'text/html'
        )
*/


    }

}