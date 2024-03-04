<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\PushMessage;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createAt')
            ->add('state')
            ->add('description')
            ->add('client', EntityType::class, [
                'class' => Client::class,
'choice_label' => 'id',
            ])
            ->add('video', EntityType::class, [
                'class' => Video::class,
'choice_label' => 'id',
            ])
            ->add('document', EntityType::class, [
                'class' => Documents::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PushMessage::class,
        ]);
    }
}
