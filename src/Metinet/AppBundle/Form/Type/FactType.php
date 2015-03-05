<?php


namespace Metinet\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'number')
            ->add('summary', 'textarea', ['required' => false])
            ->add('email', 'email')
            ->add('send', 'submit', ['label' => 'Submit'])
        ;
    }

    public function getName()
    {
        return 'fact';
    }
}
