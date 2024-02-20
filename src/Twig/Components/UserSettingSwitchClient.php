<?php

namespace App\Twig\Components;

use App\Entity\UserSetting;
use App\Form\UserSettingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(method: 'post')]
final class UserSettingSwitchClient extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?UserSetting $initialFormData = null;


    protected function instantiateForm(): FormInterface
    {
        $userSettings = $this->initialFormData ?? new UserSetting();
        return $this->createForm(UserSettingType::class, $userSettings, [
            'action' => $this->generateUrl('app_user_setting_get'),
        ]);
    }

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager): RedirectResponse
    {
        // Submit the form! If validation fails, an exception is thrown
        // and the component is automatically re-rendered with the errors
        $this->submitForm();


        $userSettings = $this->getForm()->getData();
        $entityManager->persist($userSettings);
        $entityManager->flush();

        return $this->redirectToRoute('app_main');
    }
}
