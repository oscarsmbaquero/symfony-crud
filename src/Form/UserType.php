<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',null,  array(
                'label' => 'UserName', 
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('password',null,  array(
                'label' => 'Password', 
                'attr' => array('style' => 'width: 400px')
            ), PasswordType::class)
            ->add('Name',null,  array(
                'label' => 'Name', 
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('enviar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
