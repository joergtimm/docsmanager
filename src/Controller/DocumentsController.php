<?php

namespace App\Controller;

use App\Entity\Documents;
use App\Entity\Video;
use App\Entity\VideoActors;
use App\Form\DocumentsType;
use App\Service\DocumentManager;
use App\Service\PdfManager;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use setasign\Fpdi\Tcpdf\Fpdi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

class DocumentsController extends AbstractController
{
    /**
     * @throws FilesystemException
     */
    #[Route('/doc/list/video/{id}', name: 'admin_documents_list', methods: ['GET', 'POST'])]
    public function listFromVideo(Video $video, DocumentManager $documentManager): Response
    {
        $videoActors = $video->getVideoActors();

        $actorDocuments = [];
        foreach ($videoActors as $videoActor) {
            $documents = $documentManager->buildVideoActorInfoDTO($videoActor);
            $actorDocuments[] = $documents;
        }

        return $this->render('documents/index.html.twig', [
            'documents' => $actorDocuments,
        ]);
    }


    #[Route('/admin/load/doc/{id}', name: 'admin_document_load')]
    public function loadPdf(Documents $documents, PdfManager $pdfManager): Response
    {

        $response = new StreamedResponse(function () use ($pdfManager, $documents) {
            $outputStream = fopen('php://output', 'wb');
            $fileStream = $pdfManager->readPdf($documents);

            stream_copy_to_stream($fileStream, $outputStream);
        });
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');


        return $response;
    }

    #[Route('/admin/show/doc/{id}', name: 'admin_document_show')]
    public function show(Documents $documents): Response
    {
        /*
        $fpdi = new Fpdi();
        $pageCount = $fpdi->setSourceFile($this->loadPdf($documents, $pdfManager));
            $pageNumbers = range(1, $pageCount);
            $pages = [];
        foreach ($pageNumbers as $pageNumber) {
            $templateId = $fpdi->importPage($pageNumber);
            $size = $fpdi->getTemplateSize($templateId);
            $pages[] = [
                'number' => $pageNumber,
                'size' => $size,
            ];
        }

        */

        return $this->render('documents/show.html.twig', [
            'document' => $documents,
        ]);
    }

    #[Route('/document/new/actor/{id}', name: 'app_document_new', methods: ['GET', 'POST'])]
    public function new(VideoActors $videoActor, Request $request, EntityManagerInterface $entityManager): Response
    {
        $document = new documents();
        $document->setVideoActor($videoActor);
        $form = $this->createDocumentForm($videoActor, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document->setVideoActor($videoActor);
            $entityManager->persist($document);
            $entityManager->flush();

            $this->addFlash('success', 'Document wurde angelegt');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('documents/new.html.twig', 'stream_success', [
                    'item' => $document
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute(
                'app_video_show',
                ['id' => $videoActor->getVideo()->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('documents/new.html.twig', [
            'document' => $document,
            'videoActor' => $videoActor,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_document_edit', methods: ['GET', 'POST'])]
    public function edit(Documents $document, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createDocumentForm($document->getVideoActor(), $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($document);
            $entityManager->flush();

            $this->addFlash('success', 'Document wurde geändert');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('documents/edit.html.twig', 'stream_success', [
                    'item' => $document
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute(
                'admin_document_show',
                ['id' => $document->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('documents/edit.html.twig', [
            'document' => $document,
            'videoActor' => $document->getVideoActor(),
            'form' => $form,
        ]);
    }

    private function createDocumentForm(VideoActors $videoActors, ?Documents $document = null): FormInterface
    {
        $document = $document ?? new Documents();

        return $this->createForm(DocumentsType::class, $document, [
            'action' => $document->getId() ? $this->generateUrl(
                'app_document_edit',
                ['id' => $document->getId()]
            ) : $this->generateUrl(
                'app_document_new',
                [
                'id' => $videoActors->getId()
                ]
            ),
        ]);
    }
}
