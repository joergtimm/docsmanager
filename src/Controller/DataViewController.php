<?php

namespace App\Controller;

use App\Entity\DataView;
use App\Repository\DataViewRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/_data/view')]
class DataViewController extends AbstractController
{
    #[Route('/_get', name: 'app_data_view_show', methods: ['GET', 'POST'])]
    public function getViewParams(
        DataViewRepository $dataViewRepository,
        #[MapQueryParameter] string $type = 'home',
    ): Response {
        $dataView = $dataViewRepository->findOneBy(['user' => $this->getUser(), 'type' => $type]);
        if (!$dataView) {
            $dataView = $this->new();
        }
        return $dataView;
    }

    #[Route('/new', name: 'app_data_view_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        #[MapQueryParameter] string $type = 'home',
        #[MapQueryParameter] string $title = 'Home',
        #[MapQueryParameter] string $gridlist = 'list',
    ): DataView {
        $dataView = new DataView();

        $dataView->setUpdateAt(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setTitle($title)
            ->setGridlist($gridlist)
            ->setSearchProbs(['title'])
            ->setType($type);

        $em->persist($dataView);
        $em->flush();

        return $dataView;
    }

    #[Route('/{id}/edit', name: 'app_data_view_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DataView $dataView, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DataViewType::class, $dataView);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_data_view_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('data_view/edit.html.twig', [
            'data_view' => $dataView,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_view_delete', methods: ['POST'])]
    public function delete(Request $request, DataView $dataView, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dataView->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dataView);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_data_view_index', [], Response::HTTP_SEE_OTHER);
    }
}
