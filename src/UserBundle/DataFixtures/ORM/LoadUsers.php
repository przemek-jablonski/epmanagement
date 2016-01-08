<?php

/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 06/01/16
 * Time: 5:26 PM
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\user;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager) {

        $testUser = new user();
        $testUser->setUsername('u');
        $testUser->setPassword($this->encodePassword($testUser, 'u'));
        $manager->persist($testUser);

        $testAdmin = new user();
        $testAdmin->setUsername('a');
        $testAdmin->setPassword($this->encodePassword($testUser, 'a'));
        $testAdmin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($testAdmin);

        $manager->flush();

    }

    private function encodePassword(user $testUser, $plainPassword) {

        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($testUser);

        return $encoder->encodePassword($plainPassword, $testUser->getSalt());
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}