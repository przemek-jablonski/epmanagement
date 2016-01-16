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
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class RegisterController extends Controller
{

    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request) {

        $user = new user();
        $session = new Session();

        $form = $this->createForm(new RegisterFormType(), $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $user->setRoles(array('ROLE_USER'));

            $user->setPassword(
                $this->encodePassword($user, $user->getPlainPassword())
            );

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->sendRegistrationMail($user);

            $this->session = new Session();
            $this->session->getFlashBag()
                ->add('flash_success', 'Welcome! Good to have you onboard.
                Use your newly obtained credentials to login and start tracking.');

            $url = $this->generateUrl('ticketcrud_index');
            return $this->redirect($url);
        }

        if($form->isSubmitted() && !$form->isValid()) {
            $this->session = new Session();
            $this->session->getFlashBag()
                ->add('flash_error', 'Something is not right abount the credentials you have put in. See errors for info.');
        }

        return array('form' => $form->createView());
    }

    public function sendRegistrationMail(user $newUser) {

        $mail = \Swift_Message::newInstance()
            ->setSubject("Hi " . $newUser->getEmail())
            ->setFrom('appeasyprojectmanagement@gmail.com')
            ->setTo($newUser->getEmail())
            ->setBcc('sharaquss@gmail.com')
            ->setBody(
                'Hi!
                Thanks for registering in Easy Project Management app!

                Hope you will have fun with this management tool.
                Thanks again!');
        $this->get('mailer')->send($mail);
    }


    private function encodePassword(user $testUser, $plainPassword) {

        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($testUser);

        return $encoder->encodePassword($plainPassword, $testUser->getSalt());
    }
}