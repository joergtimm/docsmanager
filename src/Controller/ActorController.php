<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\User;
use App\Form\ActorType;
use App\Repository\ActorRepository;
use App\Service\DataViewManager;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/actor')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'app_actor_index', methods: ['GET'])]
    public function index(
        ActorRepository $actorRepository,
        DataViewManager $dataViewManager,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $query = null,
        #[MapQueryParameter] string $sort = 'name',
        #[MapQueryParameter] string $sortDirection = 'asc',
        #[MapQueryParameter] string $viewMode = 'list',
        #[MapQueryParameter] int $listItems = 10,
        #[MapQueryParameter] int $gridItems = 12,
    ): Response {
        /** @var User $me */
        $me = $this->getUser();
        $dataView = $dataViewManager->setDataView($me, DataViewManager::ACTOR);

        $validSorts = $dataView->getSearchProbs();
        $firstSort = reset($validSorts);
        $firstSort = (string) $firstSort;

        $sort = in_array($sort, $validSorts) ? $sort : $firstSort;

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
            new QueryAdapter($actorRepository->findBySearch($query, $sort, $sortDirection)),
            $page,
            $items
        );

        return $this->render('actor/index.html.twig', [
            'pager' => $pager,
            'sortDirection' => $sortDirection,
            'sort' => $sort,
            'viewMode' => $viewMode,
            'dataView' => $dataView
        ]);
    }

    #[Route('/new', name: 'app_actor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $actor = new Actor();
        $form = $this->createActorForm($actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($actor);
            $entityManager->flush();

            $this->addFlash('success', 'Video wurde angelegt');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('actor/new.html.twig', 'stream_success', [
                    'item' => $actor
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actor/new.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_actor_show', methods: ['GET'])]
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }

    #[Route('/{id}/popcard', name: 'app_actor_show_popcard', methods: ['GET'])]
    public function showPopCard(Actor $actor): Response
    {

        return $this->render('actor/_popcard.html.twig', [
            'actor' => $actor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_actor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Actor $actor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createActorForm($actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Dasteller wurde geändert');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('actor/edit.html.twig', 'stream_success', [
                    'item' => $actor
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_actor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_actor_delete', methods: ['POST'])]
    public function delete(Request $request, Actor $actor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($actor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_actor_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createActorForm(Actor $actor = null): FormInterface
    {
        $actor = $actor ?? new Actor();

        return $this->createForm(ActorType::class, $actor, [
            'action' => $actor->getId() ? $this->generateUrl(
                'app_actor_edit',
                ['id' => $actor->getId()]
            ) : $this->generateUrl('app_actor_new'),
        ]);
    }

}
