<?php

namespace App\Twig\Components;

use App\Entity\Actor;
use App\Form\ActorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(method: 'get')]
final class ActorForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?Actor $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $actor = $this->initialFormData ?? new Actor();
        return $this->createForm(ActorType::class, $actor, [
            'action' => $actor->getId()
                ? $this->generateUrl('app_actor_edit', ['id' => $actor->getId()])
                : $this->generateUrl('app_actor_new'),
        ]);
    }
}
