<?php

namespace App\Controller;

use App\Entity\Mandnat;
use App\Form\MandnatType;
use App\Repository\MandnatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mandnat')]
class MandnatController extends AbstractController
{
    #[Route('/', name: 'app_mandnat_index', methods: ['GET'])]
    public function index(
        MandnatRepository $mandnatRepository,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $query = null,
        #[MapQueryParameter] string $sort = 'name',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] string $viewMode = 'list',
        #[MapQueryParameter] int $listItems = 10,
        #[MapQueryParameter] int $gridItems = 12,
    ): Response {
        $validSorts = ['name', 'conId'];
        $sort = in_array($sort, $validSorts) ? $sort : 'name';

        $validViewModes = ['list', 'grid'];
            $viewMode = in_array($viewMode, $validViewModes) ? $viewMode : 'list';
        $validSortDirections = ['asc', 'desc'];
            $sortDirection = in_array($sortDirection, $validSortDirections) ? $sortDirection : 'asc';

        $validListItems = [10, 20, 30];
            $listItems = in_array($listItems, $validListItems) ? $listItems : 10;

        $validGridItems = [12, 24, 36];
            $gridItems = in_array($gridItems, $validGridItems) ? $gridItems : 12;

            $items = $gridItems;

        if ($viewMode === 'list') {
                $items = $listItems;
        }

        $pager = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($mandnatRepository->findBySearch($query, $sort, $sortDirection)),
            $page,
            $items
        );

        return $this->render('mandnat/index.html.twig', [
            'pages' => $pager,
            'sortDirection' => $sortDirection,
            'sort' => $sort
        ]);
    }

    #[Route('/new', name: 'app_mandnat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mandnat = new Mandnat();
        $form = $this->createForm(MandnatType::class, $mandnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mandnat);
            $entityManager->flush();

            return $this->redirectToRoute('app_mandnat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mandnat/new.html.twig', [
            'mandnat' => $mandnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mandnat_show', methods: ['GET'])]
    public function show(Mandnat $mandnat): Response
    {
        return $this->render('mandnat/show.html.twig', [
            'mandnat' => $mandnat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mandnat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mandnat $mandnat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MandnatType::class, $mandnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mandnat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mandnat/edit.html.twig', [
            'mandnat' => $mandnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mandnat_delete', methods: ['POST'])]
    public function delete(Request $request, Mandnat $mandnat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mandnat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mandnat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mandnat_index', [], Response::HTTP_SEE_OTHER);
    }
}
