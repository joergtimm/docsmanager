<?php

namespace App\Twig\Components;

use App\Entity\UserSetting;
use App\Form\UserSettingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class UserSettingSwitchClient extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?UserSetting $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $userSetting = $this->initialFormData ?? new UserSetting();
        return $this->createForm(UserSettingType::class, $userSetting, [
            'action' => $this->generateUrl('app_user_setting_get'),
        ]);
    }
}
