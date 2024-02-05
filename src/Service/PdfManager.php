<?php

namespace App\Service;

use App\Entity\Documents;
use Knp\Snappy\Pdf;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;

class PdfManager
{
    public function __construct(private readonly ?FilesystemOperator $documentsFilesystem)
    {
    }

    /**
     * @throws FilesystemException
     */
    public function readPdf(Documents $documents)
    {
        return $this->documentsFilesystem->readStream($documents->getGenFileName());
    }
}
