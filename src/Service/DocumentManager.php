<?php

namespace App\Service;

use App\Entity\Video;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class DocumentManager
{
    public const ID_SHOT = 'id_shot';
    public const ID_CARD_FRONT = 'id_card_front';
    public const ID_CARD_BACK = 'id_card_back';
    public const CONTRACT = 'contract';

    public function __construct(private FilesystemOperator $documentsFilesystem, private SluggerInterface $slugger)
    {
    }

    public function get0(UploadedFile $uploadedFile): ?string
    {
        return $uploadedFile->getMimeType();
    }

    public function uploadDocument(UploadedFile $uploadedFile, ?string $type, Video $video)
    {
        if ($uploadedFile->getMimeType() == 'application/pdf') {
            $this->documentsFilesystem->write(
                'owner/' . self::CONTRACT,
                file_get_contents($uploadedFile->getPathname())
            );
        }

        if (
            $uploadedFile->getMimeType() ==
            'image/png' || $uploadedFile->getMimeType() ==
            'image/jpeg' || $uploadedFile->getMimeType() ==
            'image/gif'
        ) {
            $this->documentsFilesystem->write(
                'owner/' . self::ID_CARD_FRONT,
                file_get_contents($uploadedFile->getPathname())
            );
        }
    }

    /**
     * @throws FilesystemException
     */
    public function uploadPdf(UploadedFile $uploadedFile)
    {
        if (!$this->documentsFilesystem->has('owner')) {
            $this->documentsFilesystem->createDirectory('owner');
        }

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $this->slugger->slug(Urlizer::urlize($originalFilename) . '-' . uniqid('type', true) . '.' . $uploadedFile->guessExtension(), '-');
    }

    public function buildUniqidFilename(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $uploadedFile->getClientOriginalExtension();

        $newBasename = $this->slugger->slug(
            Urlizer::urlize($originalFilename) . '-' . uniqid('type', true),
            '-'
        );

        return $newBasename . '.' . $extension;
    }
}
