<?php

namespace App\Entity;

use App\Repository\UserSettingRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: UserSettingRepository::class)]
class UserSetting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'userSetting', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?Client $clientInUse = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isClientFilter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getClientInUse(): ?Client
    {
        return $this->clientInUse;
    }

    public function setClientInUse(?Client $clientInUse): static
    {
        $this->clientInUse = $clientInUse;

        return $this;
    }

    public function isIsClientFilter(): ?bool
    {
        return $this->isClientFilter;
    }

    public function setIsClientFilter(bool $isClientFilter): static
    {
        $this->isClientFilter = $isClientFilter;

        return $this;
    }
}
