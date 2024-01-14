<?php

namespace App\Entity;

use App\Repository\MandnatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MandnatRepository::class)]
class Mandnat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $conId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custom_nr = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;


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

    public function getConId(): ?int
    {
        return $this->conId;
    }

    public function setConId(int $conId): static
    {
        $this->conId = $conId;

        return $this;
    }

    public function getCustomNr(): ?string
    {
        return $this->custom_nr;
    }

    public function setCustomNr(?string $custom_nr): static
    {
        $this->custom_nr = $custom_nr;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
