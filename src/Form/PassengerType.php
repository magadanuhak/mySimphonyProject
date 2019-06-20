<?php

namespace App\Form;

use App\Entity\Passenger;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassengerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', ChoiceType::class, [
                'choices'  => [
                    'Mr' => "Mr",
                    'Miss' => "Miss"
                ],
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 255

                ]
            ])
            ->add('FirstName', TextType::class,
                 [
                    'attr' => ['class' => 'form-control',
                        'maxlength' => 255]
                ])
            ->add('Surname', TextType::class, [
                'attr' => ['class' => 'form-control',
                    'maxlength' => 255]
            ])
            ->add('Passport', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '10',
                    'type' => 'number'
                ]
            ]) ->add('add', SubmitType::class, [
                'label' => 'Add Passenger',
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Passenger::class,
        ]);
    }
}
