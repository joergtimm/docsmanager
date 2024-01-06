<?php

namespace App\Entity;

use App\Repository\ProducerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProducerRepository::class)]
class Producer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'producer', targetEntity: Production::class)]
    private Collection $productions;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $participant = null;

    #[ORM\Column(nullable: true)]
    private ?int $conId = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $status = null;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
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
            $production->setProducer($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): static
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getProducer() === $this) {
                $production->setProducer(null);
            }
        }

        return $this;
    }

    public function getParticipant(): ?string
    {
        return $this->participant;
    }

    public function setParticipant(?string $participant): static
    {
        $this->participant = $participant;

        return $this;
    }

    public function getConId(): ?int
    {
        return $this->conId;
    }

    public function setConId(?int $conId): static
    {
        $this->conId = $conId;

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
}
