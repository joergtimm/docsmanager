<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilepic = null;

    #[ORM\OneToMany(mappedBy: 'actor', targetEntity: VideoActors::class)]
    private Collection $videoActors;

    public function __construct()
    {
        $this->videoActors = new ArrayCollection();
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
}
