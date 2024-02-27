<?php

namespace App\Entity;

use App\Repository\DataViewRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataViewRepository::class)]
class DataView
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 20)]
    private ?string $gridlist = null;

    #[ORM\Column(nullable: true)]
    private ?array $searchProbs = null;

    #[ORM\ManyToOne(inversedBy: 'dataViews')]
    private ?User $user = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updateAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $page = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $query = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sort = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sortDirection = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $viewMode = null;

    #[ORM\Column(nullable: true)]
    private ?int $listItems = null;

    #[ORM\Column(nullable: true)]
    private ?int $gridItems = null;

    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
        $this->updateAt = new \DateTimeImmutable();
        $this->user = null;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGridlist(): ?string
    {
        return $this->gridlist;
    }

    public function setGridlist(string $gridlist): static
    {
        $this->gridlist = $gridlist;

        return $this;
    }

    public function getSearchProbs(): ?array
    {
        return $this->searchProbs;
    }

    public function setSearchProbs(?array $searchProbs): static
    {
        $this->searchProbs = $searchProbs;

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

    public function setUpdateAt(?DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function setSort(?string $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getSortDirection(): ?string
    {
        return $this->sortDirection;
    }

    public function setSortDirection(?string $sortDirection): static
    {
        $this->sortDirection = $sortDirection;

        return $this;
    }

    public function getViewMode(): ?string
    {
        return $this->viewMode;
    }

    public function setViewMode(?string $viewMode): static
    {
        $this->viewMode = $viewMode;

        return $this;
    }

    public function getListItems(): ?int
    {
        return $this->listItems;
    }

    public function setListItems(?int $listItems): static
    {
        $this->listItems = $listItems;

        return $this;
    }

    public function getGridItems(): ?int
    {
        return $this->gridItems;
    }

    public function setGridItems(?int $gridItems): static
    {
        $this->gridItems = $gridItems;

        return $this;
    }
}
