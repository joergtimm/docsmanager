<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Repository\VideoRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints\Valid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    shortName: 'video',
    operations: [
        new Get(uriTemplate: '/video/{videoKey}'),
    ],
    formats: [
       'jsonld',
        'json',
        'html',
        'jsonhal',
        'csv' => 'text/csv'
        ],
    normalizationContext: [
        'groups' => ['video:read']
    ]
)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video:read'])]
    private ?string $title = null;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createAt", type="datetime_immutable")
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column]
    private ?DateTimeImmutable $createAt;

    #[ORM\Column]
    #[Groups(['video:read'])]
    private ?bool $isverrifyted = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?Production $production = null;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updateAt", type="datetime_immutable")
     */
    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updateAt;

    #[ORM\Column(nullable: true)]
    #[Groups(['video:read'])]
    private ?array $metadata = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mime_type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_h264 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_h265 = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[Groups(['video:read'])]
    #[ApiProperty(identifier: true)]
    private Uuid $videoKey;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoActors::class)]
    private Collection $videoActors;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumb = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $owner = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoParticipiant::class, cascade: ['persist'], orphanRemoval: true)]
    #[Valid]
    private Collection $videoParticipiants;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: PushMessage::class)]
    private Collection $pushMessages;

    #[Vich\UploadableField(
        mapping: 'video',
        fileNameProperty: 'imageName',
        size: 'imageSize',
        mimeType: 'imageMimeType',
        originalName: 'imageOriginalName',
        dimensions: 'imageDimensions'
    )]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageMimeType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageOriginalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?array $imageDimensions = [];

    public function __construct()
    {
        $this->videoActors = new ArrayCollection();
        $this->isverrifyted = false;
        $this->videoParticipiants = new ArrayCollection();
        $this->createAt = new \DateTimeImmutable();
        $this->pushMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreateAt(): ?DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function isIsverrifyted(): ?bool
    {
        return $this->isverrifyted;
    }

    public function setIsverrifyted(bool $isverrifyted): static
    {
        $this->isverrifyted = $isverrifyted;

        return $this;
    }

    public function getProduction(): ?Production
    {
        return $this->production;
    }

    public function setProduction(?Production $production): static
    {
        $this->production = $production;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function setMetadata(?array $metadata): static
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mime_type;
    }

    public function setMimeType(?string $mime_type): static
    {
        $this->mime_type = $mime_type;

        return $this;
    }

    public function isIsH264(): ?bool
    {
        return $this->is_h264;
    }

    public function setIsH264(?bool $is_h264): static
    {
        $this->is_h264 = $is_h264;

        return $this;
    }

    public function isIsH265(): ?bool
    {
        return $this->is_h265;
    }

    public function setIsH265(?bool $is_h265): static
    {
        $this->is_h265 = $is_h265;

        return $this;
    }

    public function getVideoKey(): ?Uuid
    {
        return $this->videoKey;
    }

    public function setVideoKey(Uuid $videoKey): void
    {
        $this->videoKey = $videoKey;
    }

    /**
     * @return Collection<int, VideoActors>
     */
    public function getVideoActors(): Collection
    {
        return $this->videoActors;
    }

    public function addVideoActor(VideoActors $videoActor): static
    {
        if (!$this->videoActors->contains($videoActor)) {
            $this->videoActors->add($videoActor);
            $videoActor->setVideo($this);
        }

        return $this;
    }

    public function removeVideoActor(VideoActors $videoActor): static
    {
        if ($this->videoActors->removeElement($videoActor)) {
            // set the owning side to null (unless already changed)
            if ($videoActor->getVideo() === $this) {
                $videoActor->setVideo(null);
            }
        }

        return $this;
    }

    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    public function setThumb(?string $thumb): static
    {
        $this->thumb = $thumb;

        return $this;
    }

    public function getOwner(): ?Client
    {
        return $this->owner;
    }

    public function setOwner(?Client $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, VideoParticipiant>
     */
    public function getVideoParticipiants(): Collection
    {
        return $this->videoParticipiants;
    }

    public function addVideoParticipiant(VideoParticipiant $videoParticipiant): self
    {
        if (!$this->videoParticipiants->contains($videoParticipiant)) {
            $this->videoParticipiants[] = $videoParticipiant;
            $videoParticipiant->setVideo($this);
        }

        return $this;
    }

    public function removeVideoParticipiant(VideoParticipiant $videoParticipiant): self
    {
        if ($this->videoParticipiants->removeElement($videoParticipiant)) {
            // set the owning side to null (unless already changed)
            if ($videoParticipiant->getVideo() === $this) {
                $videoParticipiant->setVideo(null);
            }
        }

        return $this;
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
            $pushMessage->setVideo($this);
        }

        return $this;
    }

    public function removePushMessage(PushMessage $pushMessage): static
    {
        if ($this->pushMessages->removeElement($pushMessage)) {
            // set the owning side to null (unless already changed)
            if ($pushMessage->getVideo() === $this) {
                $pushMessage->setVideo(null);
            }
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageMimeType(): ?string
    {
        return $this->imageMimeType;
    }

    public function setImageMimeType(?string $imageMimeType): void
    {
        $this->imageMimeType = $imageMimeType;
    }

    public function getImageOriginalName(): ?string
    {
        return $this->imageOriginalName;
    }

    public function setImageOriginalName(?string $imageOriginalName): void
    {
        $this->imageOriginalName = $imageOriginalName;
    }

    public function getImageDimensions(): array|null
    {
        $imageDimensions = $this->imageDimensions;
        $imageDimensions[] = '1';

        return array_unique($imageDimensions);
    }

    /**
     * @param array<string> $imageDimensions
     * @return $this
     */
    public function setImageDimensions(?array $imageDimensions): self
    {
        $this->imageDimensions = $imageDimensions;

        return $this;
    }
}
