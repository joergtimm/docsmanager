<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];


    #[ORM\Column]
    private string $password;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DataView::class)]
    private Collection $dataViews;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserSetting $userSetting = null;

    private bool $isMe = false;
    public function __construct()
    {
        $this->dataViews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, DataView>
     */
    public function getDataViews(): Collection
    {
        return $this->dataViews;
    }

    public function addDataView(DataView $dataView): static
    {
        if (!$this->dataViews->contains($dataView)) {
            $this->dataViews->add($dataView);
            $dataView->setUser($this);
        }

        return $this;
    }

    public function removeDataView(DataView $dataView): static
    {
        if ($this->dataViews->removeElement($dataView)) {
            // set the owning side to null (unless already changed)
            if ($dataView->getUser() === $this) {
                $dataView->setUser(null);
            }
        }

        return $this;
    }

    public function getUserSetting(): ?UserSetting
    {
        return $this->userSetting;
    }

    public function setUserSetting(UserSetting $userSetting): static
    {
        // set the owning side of the relation if necessary
        if ($userSetting->getUser() !== $this) {
            $userSetting->setUser($this);
        }

        $this->userSetting = $userSetting;

        return $this;
    }

    public function isMe(): bool
    {
        return $this->isMe;
    }

    public function setIsMe(bool $isMe): void
    {
        $this->isMe = $isMe;
    }
}
