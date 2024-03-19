<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Client;
use App\Entity\Video;
use App\Entity\VideoActors;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UuidType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;
use TalesFromADev\FlowbiteBundle\Form\Type\SwitchType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('owner', EntityType::class, [
                'class' => Client::class,
                'by_reference' => false,
                'choice_label' => 'company',
                'choice_value' => 'id'
            ])
            ->add('isverrifyted', SwitchType::class, [
                'label' => 'verrify',
                'required' => false,
            ])
            ->add('videoParticipiants', LiveCollectionType::class, [
                'entry_type' => VideoPartipiantType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
