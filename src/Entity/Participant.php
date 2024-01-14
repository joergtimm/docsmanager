<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ParticipantRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
#[ApiResource]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?DateTimeImmutable $bornAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthName = null;

    #[ORM\Column(length: 30)]
    private ?string $idType = null;

    #[ORM\Column(length: 100)]
    private ?string $idNumber = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updateAt = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Video $video = null;

    #[ORM\OneToOne(inversedBy: 'participant', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $owner = null;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBornAt(): ?DateTimeImmutable
    {
        return $this->bornAt;
    }

    public function setBornAt(DateTimeImmutable $bornAt): static
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    public function getBirthName(): ?string
    {
        return $this->birthName;
    }

    public function setBirthName(?string $birthName): static
    {
        $this->birthName = $birthName;

        return $this;
    }

    public function getIdType(): ?string
    {
        return $this->idType;
    }

    public function setIdType(string $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    public function setIdNumber(string $idNumber): static
    {
        $this->idNumber = $idNumber;

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

    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getOwner(): ?Client
    {
        return $this->owner;
    }

    public function setOwner(Client $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
