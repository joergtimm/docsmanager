<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\UserSetting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TalesFromADev\FlowbiteBundle\Form\Type\SwitchType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('isVerified', SwitchType::class, [
                'required' => false
            ])
            ->add(
                'roles',
                ChoiceType::class,
                [
                    'label' => 'User Roles',
                    'choices' => [
                        'Super Admin' => 'ROLE_SUPER_ADMIN',
                        'Admin' => 'ROLE_ADMIN',
                        'Prime' => 'ROLE_PRIME',
                        'VIP' => 'ROLE_VIP',
                        'Frau' => 'ROLE_FRAU',
                        'Special Memmber' => 'ROLE_SPECIAL_MEMBER',
                        'Member' => 'ROLE_MEMBER',
                        'User' => 'ROLE_USER',
                    ],
                    'autocomplete' => true,
                    'multiple' => true,
                ]
            )
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
                'preload' => true,
                'by_reference' => false,
                'multiple' => true,
                'autocomplete' => true,
                'required' => false
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'new Password',
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
