<?php

namespace App\Form;

use App\Entity\Actor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageConstrains = [
            new Image([
                'maxSize' => '23M',
                'mimeTypes' => 'image/*'
            ]),
        ];

        $builder
            ->add('name', TextType::class)
            ->add('bornAt', DateType::class)
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender:',
                'choices' => [
                    'female' => 'female',
                    'male' => 'male',
                    'divers' => 'divers',
                ],
                'expanded' => false,
                'multiple' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
