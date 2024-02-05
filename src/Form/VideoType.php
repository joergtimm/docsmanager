<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Video;
use App\Entity\VideoActors;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('isverrifyted', SwitchType::class, [
                'label' => 'verrify',
                'required' => false,
            ])
            ->add('videoActors', CollectionType::class, [
                'entry_type' => VideoActorType::class
            ])
        ;


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
