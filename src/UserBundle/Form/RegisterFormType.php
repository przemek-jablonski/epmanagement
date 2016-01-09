<?php


namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Created by PhpStorm.
 * User: Ciemek
 * Date: 09/01/16
 * Time: 1:01 PM
 */


class RegisterFormType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', 'text')
            ->add('email', 'text')
            ->add('plainPassword', 'repeated', array('type' => 'password'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver); // TODO: Change the autogenerated stub
    }

}