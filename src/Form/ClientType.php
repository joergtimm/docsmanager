<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('company')
            ->add('country')
            ->add('locality')
            ->add('region')
            ->add('postalCode')
            ->add('streetAddress')
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class)
            ->add('status')
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
            'data_class' => Client::class,
        ]);
    }
}
