<?php

namespace StartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('StartBundle:Default:index.html.twig');
    }
}
