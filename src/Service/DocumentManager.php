<?php

namespace App\Service;

use App\DTO\VideoActrorsInfo;
use App\Entity\Documents;
use App\Entity\Video;
use App\Entity\VideoActors;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Traversable;

class DocumentManager
{
    public const ID_SHOT = 'id_shot';
    public const ID_CARD_FRONT = 'id_card_front';
    public const ID_CARD_BACK = 'id_card_back';
    public const CONTRACT = 'contract';

    public function __construct(private ?VideoRepository $videoRepository, private readonly ?FilesystemOperator $defaultFilesystem, private readonly ?SluggerInterface $slugger, private ?EntityManagerInterface $em)
    {
    }

    public function getMime(UploadedFile $uploadedFile): ?string
    {
        return $uploadedFile->getMimeType();
    }

    /**
     * @throws FilesystemException
     */
    public function uploadDocument(UploadedFile $uploadedFile, string $type, VideoActors $videoActor): void
    {

        $destination = sprintf(
            "%s/%s",
            $this->getVideoActorDocFolder($videoActor),
            $this->buildUniqidFilename($videoActor, $type)
        );


        if ($uploadedFile->getMimeType() == 'application/pdf') {
            $this->defaultFilesystem->write(
                $destination,
                file_get_contents($uploadedFile->getPathname())
            );
        }

        if (
            $uploadedFile->getMimeType() ==
            'image/png' || $uploadedFile->getMimeType() ==
            'image/jpeg' || $uploadedFile->getMimeType() ==
            'image/gif'
        ) {
            $this->defaultFilesystem->write(
                self::ID_CARD_FRONT,
                file_get_contents($uploadedFile->getPathname())
            );
        }
    }

    /**
     * @throws FilesystemException
     */
    public function uploadPdf(UploadedFile $uploadedFile): void
    {
        if (!$this->defaultFilesystem->has('owner')) {
            $this->defaultFilesystem->createDirectory('owner');
        }

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        if (isset($this->slugger)) {
            $newFilename = $this->slugger->slug(sprintf(
                "%s-%s.%s",
                Urlizer::urlize($originalFilename),
                uniqid('type', true),
                $uploadedFile->guessExtension()
            ), '-');
        }
    }

    public function buildUniqidFilename(VideoActors $videoActor, string $type): string
    {
        $video = $videoActor->getVideo();
        $owner = $video->getOwner();
        $actor = $videoActor->getActor();
        $videoKey = $video->getVideoKey();
        $ownerKey = $owner->getClientKey();
        $actorKey = $actor->getActorKey();

        return sprintf("%s-c-%s-v-%s-a-%s.pdf", $type, $ownerKey, $videoKey, $actorKey);
    }

    /**
     * @throws FilesystemException
     */
    public function buildVideoActorInfoDTO(
        VideoActors $videoActor,
    ): VideoActrorsInfo {
        $dto = new VideoActrorsInfo(
            $videoActor
        );
        $dto->setVideoDocsFolder($this->getVideoDocFolder($videoActor->getVideo()));
        $dto->setVideoActorDocs($this->getVideoActorDocuments($videoActor));
        return $this->setIsDocFile($dto);
    }

    /**
     * @throws FilesystemException
     */
    public function getVideoDocFolder(Video $video): ?string
    {
        $videoFolder = sprintf("%s/%s", $video->getOwner()->getClientKey(), $video->getVideoKey());
        if (!$this->defaultFilesystem->has($videoFolder)) {
                $this->defaultFilesystem->createDirectory($videoFolder);
        }

        return $videoFolder;
    }

    /**
     * @throws FilesystemException
     */
    public function getVideoActorDocFolder(VideoActors $videoActor): string
    {

        $video = $videoActor->getVideo();

        $videoActorDocFolder = $this->getVideoDocFolder($video) . '/' . $videoActor->getActor()->getActorKey();
        if (!$this->defaultFilesystem->has($videoActorDocFolder)) {
                $this->defaultFilesystem->createDirectory($videoActorDocFolder);
        }


        return $videoActorDocFolder;
    }

    public function setIsDocFile(VideoActrorsInfo $dto): VideoActrorsInfo
    {
        $videoActorDocs = $dto->getVideoActorDocs();
        foreach ($videoActorDocs as $videoActorDoc) {
            $docType = $videoActorDoc['docType'];
            switch ($docType) {
                case self::ID_SHOT:
                    $dto->setHasIdShot(true);
                    break;
                case self::ID_CARD_FRONT:
                    $dto->setHasIdCardFront(true);
                    break;
                case self::ID_CARD_BACK:
                    $dto->setHasIdCardBack(true);
                    break;
                case self::CONTRACT:
                    $dto->setHasContract(true);
                    break;
            }
        }

        return $dto;
    }

    /**
     * @throws FilesystemException
     */
    public function getDocIterator(VideoActors $videoActor): Traversable
    {
        return $this->defaultFilesystem->listContents($this->getVideoActorDocFolder($videoActor))->getIterator();
    }

    /**
     * @throws FilesystemException
     */
    public function getVideoActorDocuments(VideoActors $videoActor): array
    {
        $contenIterator = $this->getDocIterator($videoActor);
        $documents = [];


        foreach ($contenIterator as $item) {
            if ($item['type'] === 'file') {
                $documents[] = [
                    'filename' => basename($item['path']),
                    'path' => $item['path'],
                    'fileSize' => $item['fileSize'],
                    'visibility' => $item['visibility'],
                    'lastModified' => $item['lastModified'],
                    'mimeType' => $this->defaultFilesystem->mimeType($item['path']),
                    'checksum' => $this->defaultFilesystem->checksum($item['path']),
                    'docType' => $this->getDocType(basename($item['path'])),
                ];
            }
        }
        return $documents;
    }

    public function getDocType(?string $basename): ?string
    {
        if (str_contains($basename, self::ID_SHOT)) {
            return self::ID_SHOT;
        }

        if (str_contains($basename, self::ID_CARD_FRONT)) {
            return self::ID_CARD_FRONT;
        }

        if (str_contains($basename, self::ID_CARD_BACK)) {
            return self::ID_CARD_BACK;
        }

        if (str_contains($basename, self::CONTRACT)) {
            return self::CONTRACT;
        }

        return null;
    }

    /**
     * @throws FilesystemException
     */
    public function copyVideoActorDocsFixtures(): void
    {
        $videos = $this->videoRepository->findAll();

        foreach ($videos as $video) {
            $videoActors = $video->getVideoActors();
            foreach ($videoActors as $videoActor) {
                $destinationFolder = $this->getVideoActorDocFolder($videoActor);
                $this->copyFixtureFile(
                    $videoActor,
                    $destinationFolder,
                    [self::ID_SHOT,
                        self::ID_CARD_FRONT,
                        self::ID_CARD_BACK,
                        self::CONTRACT]
                );
            }
        }
    }


    /**
     * @throws FilesystemException
     */
    public function copyFixtureFile(VideoActors $videoActor, string $destinationFolder, array $types): void
    {

        foreach ($types as $type) {
            $destination = $destinationFolder . '/' . $this->buildUniqidFilename($videoActor, $type);
            $this->defaultFilesystem->copy('fixtures/pdf/' . $type . '.pdf', $destination);

            $ids = __DIR__ . "/../../assets/fixtures/pdf/id_shot.jpg";
            $ids = new UploadedFile(
                $ids,
                'id_shot.jpg',
                null,
                null,
                false,
            );

            $idf = __DIR__ . "/../../assets/fixtures/pdf/id_card_front.jpg";
            $idf = new UploadedFile(
                $idf,
                'id_card_front.jpg',
                null,
                null,
                false,
            );

            $idb = __DIR__ . "/../../assets/fixtures/pdf/id_card_back.jpg";
            $idb = new UploadedFile(
                $idb,
                'id_card_back.jpg',
                null,
                null,
                false,
            );

            $con = __DIR__ . "/../../assets/fixtures/pdf/contract.jpg";
            $con = new UploadedFile(
                $con,
                'contract.jpg',
                null,
                null,
                false,
            );

            $doc = new Documents();
            $doc
                ->setType($type)
                ->setVideoActor($videoActor)
                ->setCreateAt(new \DateTimeImmutable())
                ->setGenFileName($destination)
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setIsValid(true)
            ;
            if ($doc->getType() === self::ID_SHOT) {
                $doc->setImageFile($ids);
            }
            if ($doc->getType() === self::ID_CARD_FRONT) {
                $doc->setImageFile($idf);
            }
            if ($doc->getType() === self::ID_CARD_BACK) {
                $doc->setImageFile($idb);
            }
            if ($doc->getType() === self::CONTRACT) {
                $doc->setImageFile($con);
            }

            $this->em->persist($doc);
            $this->em->flush();
        }
    }

    /**
     * @throws FilesystemException
     */
    public function purgeFixturesVodeoActorDocs(): void
    {
        $content = $this->defaultFilesystem->listContents('/')->getIterator();
        foreach ($content as $item) {
            if ($item['type'] === 'file' && str_contains($item['path'], 'fixtures')) {
                $this->defaultFilesystem->delete($item['path']);
            }
            if ($item['type'] === 'directory' && str_contains($item['path'], 'fixtures')) {
                $this->defaultFilesystem->delete($item['path']);
            }
        }
    }
}
