<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class,
                [
                    'attr' => [
                        'class' =>'form-control',
                        'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
                        'maxlength' => 254
                    ],
                    'required' => false

                ])
            ->add('name',TextType::class,
                [
                    'attr' => [
                        'class' =>'form-control',
                        'maxlength' => 254
                    ],
                    'required' => false
                ])
            ->add('address',TextType::class,
                [
                    'attr' => [
                        'class' =>'form-control',
                        'maxlength' => 254
                    ],
                    'required' => false
                ])
            ->add('city',TextType::class,
                [
                    'attr' => [
                        'class' =>'form-control',
                        'maxlength' => 254
                    ],
                    'required' => false
                ])
            ->add('country',TextType::class,
                [
                    'attr' => [
                        'class' =>'form-control',
                        'maxlength' => 254
                    ],
                    'required' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
