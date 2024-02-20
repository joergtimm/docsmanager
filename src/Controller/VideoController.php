<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use App\Service\DataViewManager;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Uid\Uuid;

#[Route('/admin/video')]
#[IsGranted('ROLE_ADMIN')]
class VideoController extends AbstractController
{
    #[Route('/', name: 'app_video_index', methods: ['GET', 'POST'])]
    public function index(
        VideoRepository $videoRepository,
        DataViewManager $dataViewManager,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $query = null,
        #[MapQueryParameter] string $sort = 'title',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] string $viewMode = 'list',
        #[MapQueryParameter] int $listItems = 10,
        #[MapQueryParameter] int $gridItems = 12,
    ): Response {


        /** @var User $me */
        $me = $this->getUser();
        $dataView = $dataViewManager->setDataView($me, DataViewManager::VIDEO);
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
            new QueryAdapter($videoRepository->findBySearch(
                $me->getUserSetting()->getClientInUse(),
                $query,
                $sort,
                $sortDirection
            )),
            $page,
            $items
        );

        return $this->render('video/index.html.twig', [
            'pager' => $pager,
            'sortDirection' => $sortDirection,
            'sort' => $sort,
            'viewMode' => $viewMode
        ]);
    }

    #[Route('/new', name: 'app_video_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        DataViewManager $dataViewManager
    ): Response {
        $video = new Video();
        $video->setCreateAt(new DateTimeImmutable());
        $form = $this->createVideoForm($video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Video $video */
            $video = $form->getData();
            $video->setCreateAt(new DateTimeImmutable());
            $video->setUpdateAt(new DateTimeImmutable());
            $video->setVideoKey(Uuid::v1());
            $client = $dataViewManager->getClient($this->getUser());
            $video->setOwner($client);

            $entityManager->persist($video);
            $entityManager->flush();
            $this->addFlash('success', 'Video wurde angelegt');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('/video/new.html.twig', 'stream_success', [
                    'item' => $video
                ]);
                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_show', methods: ['GET', 'POST'])]
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Video $video, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createVideoForm($video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Video $video */
            $video = $form->getData();
            $video->setUpdateAt(new DateTimeImmutable('now'));
            $entityManager->persist($video);
            $entityManager->flush();
            $this->addFlash('success', 'Video wurde geändert');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('/video/edit.html.twig', 'stream_success', [
                    'item' => $video
                ]);

                $this->addFlash('stream', $stream);
            }


            return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_delete', methods: ['POST'])]
    public function delete(Request $request, Video $video, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $video->getId(), $request->request->get('_token'))) {
            $entityManager->remove($video);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
    }

    private function createVideoForm(Video $video = null): FormInterface
    {
        $video = $video ?? new Video();

        return $this->createForm(VideoType::class, $video, [
            'action' => $video->getId() ? $this->generateUrl('app_video_edit', ['id' => $video->getId()]) : $this->generateUrl('app_video_new'),
        ]);
    }

    #[Route('/play/{id}', name: 'app_video_play')]
    public function play(Video $video)
    {
    }
}
