<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentsRepository::class)]
#[Vich\Uploadable]
class Documents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $documentKey;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isValid = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Vich\UploadableField(
        mapping: 'documents',
        fileNameProperty: 'imageName',
        size: 'imageSize',
        mimeType: 'imageMimeType',
        originalName: 'imageOriginalName',
        dimensions: 'imageDimensions'
    )]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'pdfName', size: 'pdfSize')]
    private ?File $pdfFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdfName = null;

    #[ORM\Column(nullable: true)]
    private ?int $pdfSize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genFileName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mimeType = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VideoActors $videoActor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageMimeType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageOriginalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?array $imageDimensions = null;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: PushMessage::class)]
    private Collection $pushMessages;

    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
        $this->documentKey = Uuid::v1();
        $this->pushMessages = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
    public function getMergeName(): ?string
    {
        $clientKey = $this->videoActor->getVideo()->getOwner()->getClientKey();
        $videoKey = $this->videoActor->getVideo()->getVideoKey();
        $actorKey = $this->videoActor->getActor()->getActorKey();
        $type = $this->type;

        return sprintf('%s%s%s%s', $clientKey, $videoKey, $actorKey, $type);
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(?bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): static
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): static
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPdfFile(): ?File
    {
        return $this->pdfFile;
    }

    public function setPdfFile(?File $pdfFile = null): void
    {
        $this->pdfFile = $pdfFile;

        if (null !== $pdfFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPdfName(): ?string
    {
        return $this->pdfName;
    }

    public function setPdfName(?string $pdfName): static
    {
        $this->pdfName = $pdfName;

        return $this;
    }

    public function getPdfSize(): ?int
    {
        return $this->pdfSize;
    }

    public function setPdfSize(?int $pdfSize): static
    {
        $this->pdfSize = $pdfSize;

        return $this;
    }

    public function getFilename(): ?string
    {
        $name = $this->imageName;

        return $this->imageName;
    }

    public function getGenFileName(): ?string
    {
        return $this->genFileName;
    }

    public function setGenFileName(?string $genFileName): static
    {
        $this->genFileName = $genFileName;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): static
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getVideoActor(): ?VideoActors
    {
        return $this->videoActor;
    }

    public function setVideoActor(?VideoActors $videoActor): static
    {
        $this->videoActor = $videoActor;

        return $this;
    }

    public function getImageMimeType(): ?string
    {
        return $this->imageMimeType;
    }

    public function setImageMimeType(?string $imageMimeType): static
    {
        $this->imageMimeType = $imageMimeType;

        return $this;
    }

    public function getImageOriginalName(): ?string
    {
        return $this->imageOriginalName;
    }

    public function setImageOriginalName(?string $imageOriginalName): static
    {
        $this->imageOriginalName = $imageOriginalName;

        return $this;
    }

    public function getImageDimensions(): ?array
    {
        return $this->imageDimensions;
    }

    public function setImageDimensions(?array $imageDimensions): void
    {
        $this->imageDimensions = $imageDimensions;
    }

    public function getDocumentKey(): Uuid
    {
        return $this->documentKey;
    }

    public function setDocumentKey(Uuid $documentKey): void
    {
        $this->documentKey = $documentKey;
    }

    /**
     * @return Collection<int, PushMessage>
     */
    public function getPushMessages(): Collection
    {
        return $this->pushMessages;
    }

    public function addPushMessage(PushMessage $pushMessage): static
    {
        if (!$this->pushMessages->contains($pushMessage)) {
            $this->pushMessages->add($pushMessage);
            $pushMessage->setDocument($this);
        }

        return $this;
    }

    public function removePushMessage(PushMessage $pushMessage): static
    {
        if ($this->pushMessages->removeElement($pushMessage)) {
            // set the owning side to null (unless already changed)
            if ($pushMessage->getDocument() === $this) {
                $pushMessage->setDocument(null);
            }
        }

        return $this;
    }
}
