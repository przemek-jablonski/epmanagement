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


class RegisterController extends Controller
{

    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction() {
        $form = $this->createFormBuilder()
            ->add('username', 'text')
            ->add('email', 'text')
            ->add('password', 'repeated', array(
                'type' => 'password'
            ))
            ->getForm();

        $formView = $form->createView();
        $formView->widgetSchema->setLabel('the_field_id', false);

        return array('form' => $form->createView());
    }

}