<?php

namespace App\Twig\Components;

use App\Entity\DataView;
use App\Form\SwitchClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class SwitchClient extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?DataView $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $dataView = $this->initialFormData ?? new DataView();
        return $this->createForm(SwitchClientType::class, $dataView, [
            'action' => $dataView->getId()
                ? $this->generateUrl('app_mandnat_edit', ['id' => $dataView->getId()])
                : $this->generateUrl('app_mandnat_new'),
        ]);
    }
}
