<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', EmailType::class, [
                'mapped' => false
            ])
            ->add('password', PasswordType::class, [
                'toggle' => true
            ])
            ->add('_remember_me', CheckboxType::class, [
                'required' => false,
                'data' => true,
            ]);

        $builder->add('Login', SubmitType::class, [
            'validate' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => 'authenticate'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
