<?php

namespace App\Form;

use App\Entity\Actor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'löschen',
                'download_label' => 'download',
                'download_uri' => true,
                'image_uri' => true,
                'imagine_pattern' => 'video_card_thumbnail',
                'asset_helper' => true,
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
