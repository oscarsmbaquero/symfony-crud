<?php

namespace App\Form;

use App\Entity\Extremoduro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ExtremoduroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,  array(
                'label' => 'Name', 
                'attr' => array('style' => 'width: 400px')
            ))        
            ->add('year',null,  array(
                'label' => 'Year', 
                'attr' => array('style' => 'width: 400px')
                ))
            ->add('image',null,  array(
                'label' => 'Image', 
                'attr' => array('style' => 'width: 400px')
                ))
            ->add('enviar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Extremoduro::class,
        ]);
    }
}
