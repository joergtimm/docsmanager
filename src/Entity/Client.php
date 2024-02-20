<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

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

    public function __construct()
    {
        $this->productions = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->clientKey = Uuid::v1();
        $this->actorClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

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
}
