<?php

namespace App\Form;

use App\Entity\Fruits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FruitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [    
                'maxLength' => 100
            ]
        ])
        ->add('poids', IntegerType::class, [
            'attr' => [
                'min' => 0,
                'max' => 9999.99,
                'step' => 0.01
            ]
        ])
        ->add('price', NumberType::class, [
            'attr' => [
                'min' => 0,
                'max' => 9999.99,
                'step' => 0.01
            ]
        ])
        ->add('description', TextareaType::class, [
            'attr' => [
                'maxLength' => 255
            ]
        ])
        ->add('img1', FileType::class, [
            'required' => false,
            'mapped' => false,
            'help' => 'png, jpg, jpeg, jp2 ou webp - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1M',
                    'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). Maximum autorisé : {{ limit }} {{ suffix }}.',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
                ])
            ]
        ])
        // ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fruits::class,
        ]);
    }
}
