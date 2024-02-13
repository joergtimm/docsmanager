<?php

namespace App\Twig\Components;

use App\Entity\Mandnat;
use App\Form\MandnatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(method: 'get')]
final class ClientForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?Mandnat $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $client = $this->initialFormData ?? new Mandnat();
        return $this->createForm(MandnatType::class, $client, [
            'action' => $client->getId()
                ? $this->generateUrl('app_mandnat_edit', ['id' => $client->getId()])
                : $this->generateUrl('app_mandnat_new'),
        ]);
    }
}
