<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 16/01/16
 * Time: 3:54 AM
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\user;
use UserBundle\Repository\userRepository;


class UserController extends Controller {

    public function profileAction() {
        /** @var userRepository $repo */
        $repo = $this->getDoctrine()->getRepository('UserBundle:user');

        /** @var user $userProfiled */
       // $userProfiled = $repo->findUser($this->getUser());

        return $this->render('UserBundle:Profile:userprofile.html.twig', array(
            'user' => $this->getUser()
        ));
    }

}