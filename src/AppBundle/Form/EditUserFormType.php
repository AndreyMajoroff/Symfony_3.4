<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EditUserFormType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_MANAGER'
                ],
                'multiple' => true,
                'expanded' => true, // make it checkboxes
            ]);
    }
}