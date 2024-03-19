<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Form\ClientType;
use App\Repository\ClientRepository;
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
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    public function index(
        ClientRepository $clientRepository,
        DataViewManager $dataViewManager,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $query = null,
        #[MapQueryParameter] string $sort = 'name',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] string $viewMode = 'list',
        #[MapQueryParameter] int $listItems = 10,
        #[MapQueryParameter] int $gridItems = 12,
    ): Response {
        /** @var User $me */
        $me = $this->getUser();
        $dataView = $dataViewManager->setDataView($me, DataViewManager::CLIENT);

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
            new QueryAdapter($clientRepository->findBySearch(
                $query,
                $sort,
                $sortDirection,
            )),
            $page,
            $items
        );

        return $this->render('client/index.html.twig', [
            'pager' => $pager,
            'sortDirection' => $sortDirection,
            'sort' => $sort,
            'viewMode' => $viewMode,
            'dataView' => $dataView
        ]);
    }

    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('success', 'Client wurde angelegt');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('client/new.html.twig', 'stream_success', [
                    'item' => $client
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createClientForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success', 'Client wurde geändert');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('client/edit.html.twig', 'stream_success', [
                    'item' => $client
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createClientForm(Client $client = null): FormInterface
    {
        $client = $client ?? new client();

        return $this->createForm(clientType::class, $client, [
            'action' => $client->getId() ? $this->generateUrl(
                'app_client_edit',
                ['id' => $client->getId()]
            ) : $this->generateUrl('app_client_new'),
        ]);
    }
}
