<?php

namespace App\Form;

use App\Entity\Documents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('isValid')
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
            ->add('genFileName', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'löschen',
                'download_label' => 'download',
                'download_uri' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }
}
