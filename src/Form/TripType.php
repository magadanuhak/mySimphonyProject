<?php

namespace App\Form;

use App\Entity\Passenger;
use App\Entity\Trip;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DepartureAirport',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 3,
                    'minlength' => 3,
                    'pattern' => '[A-Za-z]{3}'
                ]
            ])
            ->add('DestinationAirport',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 3,
                    'minlength' => 3,
                    'pattern' => '[A-Za-z]{3}'

                ]
            ])
            ->add('DepartureDateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form_datetime readonly'
                ],
                'html5' => false

            ])
            ->add('ArrivalDateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control form_datetime readonly'
                ],
                'html5' => false
            ])
            ->add('Passengers', EntityType::class, [
                'class' => Passenger::class,
                'attr' => ['class' =>"form-control"],
                'choice_label' => function(Passenger $passenger) {
                    return $passenger->getTitle() . " " . $passenger->getSurname() . " " . $passenger->getFirstName();
                },
                'choice_value' => function(Passenger $passenger) {
                    return $passenger->getTitle() . " " . $passenger->getSurname() . " " . $passenger->getFirstName();
                },
//It doesn't work - it makes passengers as checkboxes   'expanded' => true,
                'multiple'  => true
            ]) ->add('add', SubmitType::class, [
                'label' => 'Add Trip',
                'attr' => ['class' => 'btn btn-primary']

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
