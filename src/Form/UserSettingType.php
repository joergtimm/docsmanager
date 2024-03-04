<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\UserSetting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TalesFromADev\FlowbiteBundle\Form\Type\SwitchType;

class UserSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientInUse', EntityType::class, [
                'label' => false,
                'required' => 'false',
                'class' => Client::class,
                'placeholder' => 'Client...',
                'autocomplete' => true,
                'tom_select_options' => [
                    'allowEmptyOption' => true
                ],
                'by_reference' => false,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'empty_data' => '',
                'attr' => [
                    'data-action' => 'autosubmit#debouncedSubmit',
                    'data-turbo-frames' => "videos"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSetting::class,
            'validation_groups' => false,
        ]);
    }
}
