<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VideoRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ApiResource]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createAt", type="datetime_immutable")
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column]
    private ?DateTimeImmutable $createAt;

    #[ORM\Column]
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
    private ?array $metadata = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mime_type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_h264 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_h265 = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $videoKey;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoActors::class)]
    private Collection $videoActors;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumb = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: Participant::class)]
    private Collection $participants;

    public function __construct()
    {
        $this->videoActors = new ArrayCollection();
        $this->participants = new ArrayCollection();
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

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setVideo($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getVideo() === $this) {
                $participant->setVideo(null);
            }
        }

        return $this;
    }
}
