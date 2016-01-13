<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    /**
     * @Template
     */


    public function loginAction() {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
/*
        if($this->error->getLine() != null) {
            $session = new Session();
            $session->getFlashBag()
                ->add('flash_error', 'Oops! Your username or password does not match or exist. Try again or register, please.');
        }
*/
        /*
        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
        */

        return array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
        );
    }

    public function

    public function loginCheckAction() {


    }


    public function logoutAction() {
        $session = new Session();
        $this->$session->getFlashbag()
            ->add('flash_success', 'COME BACK');
    }



}