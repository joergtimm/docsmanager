<?php

namespace App\Service;

use App\Entity\Documents;
use League\Flysystem\FilesystemOperator;
use setasign\Fpdi\PdfParser\StreamReader;

class PdfManager
{
    public function __construct(

    ) {
    }

    /**
     * @param Documents $documents
     *
     * @return resource
     */
    public function readPdf(Documents $documents)
    {

    }
}
