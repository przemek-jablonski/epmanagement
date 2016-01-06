<?php
/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 27/12/15
 * Time: 3:22 PM
 */

namespace UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\user;


class DummyAdditionController implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function additionAction() {

        $testUser = new user();
        $testUser->setUsername('u');
        $testUser->setPassword($this->encodePassword($testUser, 'u'));

        $manager = $this->getDoctrine()->getEntityManager();
        $manager->persist($testUser);
        $manager->flush();

        return $this->render('TicketBundle:Default:index.html.twig',
            array ('text' => 'test user added.'));
    }

    public function encodePassword (user $user, $plainPassword) {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }


    public function setContainer(ContainerInterface $container = null)
    {
        $this->$container = $container;
    }
}