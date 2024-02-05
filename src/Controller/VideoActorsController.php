<?php

namespace App\Controller;

use App\Entity\Video;
use App\Entity\VideoActors;
use App\Form\VideoActorsType;
use App\Repository\VideoActorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/video/actors')]
class VideoActorsController extends AbstractController
{
    #[Route('/{id}', name: 'app_video_actors_index', methods: ['GET'])]
    public function listVideoActors(Video $video, VideoActorsRepository $videoActorsRepository): Response
    {
        $videoActors = $videoActorsRepository->findBy(['video' => $video]);


        return $this->render('video_actors/index.html.twig', [
            'videoActors' => $videoActors,
        ]);
    }

    #[Route('/new', name: 'app_video_actors_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $videoActor = new VideoActors();
        $form = $this->createForm(VideoActorsType::class, $videoActor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($videoActor);
            $entityManager->flush();

            return $this->redirectToRoute('app_video_actors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video_actors/new.html.twig', [
            'video_actor' => $videoActor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_actors_show', methods: ['GET'])]
    public function show(VideoActors $videoActor): Response
    {
        return $this->render('video_actors/show.html.twig', [
            'video_actor' => $videoActor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_video_actors_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VideoActors $videoActor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VideoActorsType::class, $videoActor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_video_actors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video_actors/edit.html.twig', [
            'video_actor' => $videoActor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_actors_delete', methods: ['POST'])]
    public function delete(Request $request, VideoActors $videoActor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoActor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($videoActor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_video_actors_index', [], Response::HTTP_SEE_OTHER);
    }
}
