<?php

namespace App\Form;

use App\Entity\Documents;
use App\Service\DocumentManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TalesFromADev\FlowbiteBundle\Form\Type\SwitchType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{
    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'löschen',
                'download_label' => 'download',
                'download_uri' => false,
                'image_uri' => false,
                'imagine_pattern' => 'video_card_thumbnail',
                'asset_helper' => false,
            ])
            ->add('isValid', SwitchType::class, [
                'label' => 'valid',
                'false_values' => [false, null],
                'required' => false,
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
