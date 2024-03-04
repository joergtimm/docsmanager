<?php

namespace App\Controller;

use App\Entity\PushMessage;
use App\Form\PushMessageType;
use App\Repository\PushMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/push/message')]
class PushMessageController extends AbstractController
{
    #[Route('/', name: 'app_push_message_index', methods: ['GET'])]
    public function index(PushMessageRepository $pushMessageRepository): Response
    {
        return $this->render('push_message/index.html.twig', [
            'push_messages' => $pushMessageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_push_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pushMessage = new PushMessage();
        $form = $this->createForm(PushMessageType::class, $pushMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pushMessage);
            $entityManager->flush();

            return $this->redirectToRoute('app_push_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('push_message/new.html.twig', [
            'push_message' => $pushMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_push_message_show', methods: ['GET'])]
    public function show(PushMessage $pushMessage): Response
    {
        return $this->render('push_message/show.html.twig', [
            'push_message' => $pushMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_push_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PushMessage $pushMessage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PushMessageType::class, $pushMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_push_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('push_message/edit.html.twig', [
            'push_message' => $pushMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_push_message_delete', methods: ['POST'])]
    public function delete(Request $request, PushMessage $pushMessage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pushMessage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pushMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_push_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
