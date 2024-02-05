<?php

namespace App\Controller;


use App\Entity\Documents;
use App\Entity\Video;
use App\Service\DocumentManager;
use App\Service\PdfManager;
use Dompdf\Dompdf;
use Knp\Snappy\Pdf;
use League\Flysystem\FilesystemException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use setasign\Fpdi\Tcpdf\Fpdi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $response = new StreamedResponse(function () use ($pdfManager, $documents)
        {
            $outputStream = fopen('php://output', 'wb');
            $fileStream = $pdfManager->readPdf($documents);

            stream_copy_to_stream($fileStream, $outputStream);

        });
        $response->headers->set('Content-Type', 'application/pdf');



        return $response;
    }

    /**
     * @throws PdfParserException
     * @throws PdfReaderException
     */
    #[Route('/admin/show/doc/{id}', name: 'admin_document_show')]
    public function show(Documents $documents, Fpdi $fpdi, PdfManager $pdfManager): Response
    {

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


        return $this->render('documents/show.html.twig', [
            'document' => $documents,
            'pages' => $pages
        ]);
    }

}
