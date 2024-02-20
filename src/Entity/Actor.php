<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[Vich\Uploadable]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $bornAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $actorKey;

    #[Vich\UploadableField(mapping: 'actor', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilepic = null;

    #[ORM\OneToMany(mappedBy: 'actor', targetEntity: VideoActors::class)]
    private ArrayCollection|Collection $videoActors;

    #[ORM\OneToMany(mappedBy: 'actor', targetEntity: VideoParticipiant::class)]
    private Collection $videoParticipiants;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\OneToMany(mappedBy: 'actor', targetEntity: ActorClient::class)]
    private Collection $actorClients;

    public function __construct()
    {
        $this->videoActors = new ArrayCollection();
        $this->videoParticipiants = new ArrayCollection();
        $this->actorKey = Uuid::v1();
        $this->createAt = new \DateTimeImmutable();
        $this->actorClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBornAt(): ?\DateTimeInterface
    {
        return $this->bornAt;
    }

    public function setBornAt(?\DateTimeInterface $bornAt): static
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getProfilepic(): ?string
    {
        return $this->profilepic;
    }

    public function setProfilepic(?string $profilepic): static
    {
        $this->profilepic = $profilepic;

        return $this;
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
            $videoActor->setActor($this);
        }

        return $this;
    }

    public function removeVideoActor(VideoActors $videoActor): static
    {
        if ($this->videoActors->removeElement($videoActor)) {
            // set the owning side to null (unless already changed)
            if ($videoActor->getActor() === $this) {
                $videoActor->setActor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoParticipiant>
     */
    public function getVideoParticipiants(): Collection
    {
        return $this->videoParticipiants;
    }

    public function addVideoParticipiant(VideoParticipiant $videoParticipiant): static
    {
        if (!$this->videoParticipiants->contains($videoParticipiant)) {
            $this->videoParticipiants->add($videoParticipiant);
            $videoParticipiant->setActor($this);
        }

        return $this;
    }

    public function removeVideoParticipiant(VideoParticipiant $videoParticipiant): static
    {
        if ($this->videoParticipiants->removeElement($videoParticipiant)) {
            // set the owning side to null (unless already changed)
            if ($videoParticipiant->getActor() === $this) {
                $videoParticipiant->setActor(null);
            }
        }

        return $this;
    }

    public function getActorKey(): Uuid
    {
        return $this->actorKey;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeImmutable $createAt): void
    {
        $this->createAt = $createAt;
    }

    /**
     * @return Collection<int, ActorClient>
     */
    public function getActorClients(): Collection
    {
        return $this->actorClients;
    }

    public function addActorClient(ActorClient $actorClient): static
    {
        if (!$this->actorClients->contains($actorClient)) {
            $this->actorClients->add($actorClient);
            $actorClient->setActor($this);
        }

        return $this;
    }

    public function removeActorClient(ActorClient $actorClient): static
    {
        if ($this->actorClients->removeElement($actorClient)) {
            // set the owning side to null (unless already changed)
            if ($actorClient->getActor() === $this) {
                $actorClient->setActor(null);
            }
        }

        return $this;
    }
}
