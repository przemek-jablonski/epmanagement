<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 08/01/16
 * Time: 10:51 PM
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use UserBundle\Entity\user;
use UserBundle\Form\RegisterFormType;


class RegisterController extends Controller
{

    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request) {

        $user = new user();

        //tu bylo ", new user());"
        $form = $this->createForm(new RegisterFormType(), $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        /*
            $data = $form->getData();

            $user = new user();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            //$user->setPassword($this->encodePassword($user, $data['password']));
            $user->setPassword($this->encodePassword($user, $data['plainPassword']));

            $data = null;
        */
            $user = $form->getData();

            $user->setPassword(
                $this->encodePassword($user, $user->getPlainPassword())
            );

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $session = new Session();
            $session->getFlashBag()
                ->add('flash_success', 'Welcome! Good to have you onboard.
                Use your newly obtained credentials to login and start tracking.');
            /*
            $request->getSession()->getFlashbag()
                ->add('flash_success', 'Welcome! Good to have you onboard.
                Use your newly obtained credentials to login and start tracking.');
            */
            $url = $this->generateUrl('ticketcrud_index');
            return $this->redirect($url);

        }

        return array('form' => $form->createView());
    }


    private function encodePassword(user $testUser, $plainPassword) {

        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($testUser);

        return $encoder->encodePassword($plainPassword, $testUser->getSalt());
    }
}