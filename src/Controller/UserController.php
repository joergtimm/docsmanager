<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
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

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET', 'POST'])]
    public function index(
        UserRepository $userRepository,
        DataViewManager $dataViewManager,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $query = null,
        #[MapQueryParameter] string $sort = 'username',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] string $viewMode = 'list',
        #[MapQueryParameter] int $listItems = 10,
        #[MapQueryParameter] int $gridItems = 12,
    ): Response {


        /** @var User $me */
        $me = $this->getUser();
        $dataView = $dataViewManager->setDataView($me, DataViewManager::USER);
        $validSorts = $dataView->getSearchProbs();
        $firstSort = reset($validSorts);
        $firstSort = (string) $firstSort;

        $sort = in_array($sort, $validSorts) ? $sort : $firstSort;

        $validViewModes = ['list', 'grid'];
        $viewMode = in_array($viewMode, $validViewModes) ? $viewMode : 'grid';
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
            new QueryAdapter($userRepository->findBySearch(
                $query,
                $sort,
                $sortDirection
            )),
            $page,
            $items
        );

        return $this->render('user/index.html.twig', [
            'pager' => $pager,
            'sortDirection' => $sortDirection,
            'sort' => $sort,
            'viewMode' => $viewMode,
            'dataView' => $dataView
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createUserForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'User wurde geändert');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('user/edit.html.twig', 'stream_success', [
                    'item' => $user
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createUserForm(User $user = null): FormInterface
    {
        $user = $user ?? new User();

        return $this->createForm(UserType::class, $user, [
            'action' => $user->getId() ? $this->generateUrl('app_user_edit', ['id' => $user->getId()]) : $this->generateUrl('app_video_new'),
        ]);
    }
}
