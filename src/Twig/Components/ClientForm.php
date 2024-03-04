<?php

namespace App\Twig\Components;

use App\Entity\Client;
use App\Entity\Mandnat;
use App\Form\ClientType;
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
    public ?Client $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $client = $this->initialFormData ?? new Client();
        return $this->createForm(ClientType::class, $client, [
            'action' => $client->getId()
                ? $this->generateUrl('app_client_edit', ['id' => $client->getId()])
                : $this->generateUrl('app_client_new'),
        ]);
    }
}
