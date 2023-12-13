<?php

namespace App\Entity;

use App\Repository\MandnatRepository;
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
}
