<?php

namespace App\Form;

use App\Entity\Mandnat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class MandnatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('conId')
            ->add('customNr')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'beantragt' => 'beantragt',
                    'in Arbeit' => 'arbeit',
                    'Sandbox' => 'sandbox',
                    'Prod' => 'prod',
                ],
                'autocomplete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mandnat::class,
        ]);
    }
}
