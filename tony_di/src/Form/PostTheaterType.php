<?php

namespace App\Form;

use App\Entity\PostTheater;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PostTheaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('image',FileType::class, [
                'label' => 'Image',
                'mapped' => true,
                'data_class' => null,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/png',
                            'image/jpeg',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid document',
                    ])
                ],
            ])
            ->add('content', CKEditorType::class)
            ->add('link_teaser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostTheater::class,
        ]);
    }
}
