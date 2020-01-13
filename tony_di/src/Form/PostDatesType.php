<?php

namespace App\Form;

use App\Entity\PostDates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostDatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Seul en scène' => 'Seul en scène',
                    'Théâtre' => 'Théâtre',
                ],
            ])
            ->add('start_date', DateTimeType::class, [
                'years' => range(2020, 2025),
            ])
            ->add('end_date', DateTimeType::class, [
                'years' => range(2020, 2025),
            ])
            ->add('spectacle')
            ->add('lieu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostDates::class,
        ]);
    }
}
