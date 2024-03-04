<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(method: 'get')]
class UserForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?User $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $user = $this->initialFormData ?? new User();
        return $this->createForm(UserType::class, $user, [
            'action' => $user->getId()
                ? $this->generateUrl('app_user_edit', ['id' => $user->getId()])
                : $this->generateUrl('app_user_new'),
        ]);
    }
}
