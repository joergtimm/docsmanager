<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[Vich\Uploadable]
#[ApiResource]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $clientKey;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Production::class)]
    private Collection $productions;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Video::class)]
    private Collection $videos;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: ActorClient::class)]
    private Collection $actorClients;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $locality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $streetAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[Vich\UploadableField(
        mapping: 'client',
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: PushMessage::class)]
    private Collection $pushMessages;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'clients')]
    private ?User $user = null;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->clientKey = Uuid::v1();
        $this->actorClients = new ArrayCollection();
        $this->status = 'active';
        $this->updateAt = new \DateTimeImmutable();
        $this->pushMessages = new ArrayCollection();
        $this->user = null;
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): static
    {
        $this->company = $company;

        return $this;
    }



    /**
     * @return Collection<int, Production>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Production $production): static
    {
        if (!$this->productions->contains($production)) {
            $this->productions->add($production);
            $production->setOwner($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): static
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getOwner() === $this) {
                $production->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setOwner($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getOwner() === $this) {
                $video->setOwner(null);
            }
        }

        return $this;
    }

    public function getClientKey(): Uuid
    {
        return $this->clientKey;
    }

    public function setClientKey(Uuid $clientKey): void
    {
        $this->clientKey = $clientKey;
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
            $actorClient->setClient($this);
        }

        return $this;
    }

    public function removeActorClient(ActorClient $actorClient): static
    {
        if ($this->actorClients->removeElement($actorClient)) {
            // set the owning side to null (unless already changed)
            if ($actorClient->getClient() === $this) {
                $actorClient->setClient(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(?string $locality): static
    {
        $this->locality = $locality;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(?string $streetAddress): static
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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

    public function getImageDimensions(): ?array
    {
        return $this->imageDimensions;
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

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
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
            $pushMessage->setClient($this);
        }

        return $this;
    }

    public function removePushMessage(PushMessage $pushMessage): static
    {
        if ($this->pushMessages->removeElement($pushMessage)) {
            // set the owning side to null (unless already changed)
            if ($pushMessage->getClient() === $this) {
                $pushMessage->setClient(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
