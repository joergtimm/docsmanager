<?php

namespace App\Controller;

use App\Entity\UserSetting;
use App\Form\UserSettingType;
use App\Repository\UserSettingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/setting')]
class UserSettingController extends AbstractController
{
    #[Route('/new', name: 'app_user_setting_new')]
    public function new(EntityManagerInterface $entityManager): UserSetting
    {
        $userSetting = new UserSetting();

        $userSetting
            ->setUser($this->getUser())
            ->setIsClientFilter(false);
        $entityManager->persist($userSetting);
        $entityManager->flush();

        return $userSetting;
    }

    #[Route('/', name: 'app_user_setting_get', methods: ['GET', 'POST'])]
    public function getSettings(
        Request $request,
        UserSettingRepository $userSettingRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $userSetting = $userSettingRepository->findOneBy(['user' => $this->getUser()]);
        if (!$userSetting) {
            $userSetting = $this->new($entityManager);
        }

        $form = $this->createForm(UserSettingType::class, $userSetting, [
            'action' => $this->generateUrl('app_user_setting_get'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UserSetting $userSetting */
            $userSetting = $form->getData();
            $entityManager->flush();

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('user_setting/_stream.html.twig', 'user_stream_success', [
                    'user_setting' => $userSetting,
                    'form' => $form,
                ]);

                $this->addFlash('stream', $stream);
            }
        }

        return $this->render('user_setting/new.html.twig', [
            'user_setting' => $userSetting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_setting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserSetting $userSetting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserSettingType::class, $userSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_setting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_setting/edit.html.twig', [
            'user_setting' => $userSetting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_setting_delete', methods: ['POST'])]
    public function delete(Request $request, UserSetting $userSetting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userSetting->getId(), $request->request->get('_token'))) {
            $entityManager->remove($userSetting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_setting_index', [], Response::HTTP_SEE_OTHER);
    }
}
