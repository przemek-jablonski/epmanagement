<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($text)
    {
        //calling function render, which returns (render) Response Object
        return $this->render('TicketBundle:Default:index.html.twig',
                                array ('text' => $text));
    }


}
