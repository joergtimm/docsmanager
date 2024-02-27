<?php

namespace App\Entity;

use App\Repository\VideoParticipiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoParticipiantRepository::class)]
class VideoParticipiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'videoParticipiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Video $video = null;

    #[ORM\ManyToOne(inversedBy: 'videoParticipiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Actor $actor = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): static
    {
        $this->actor = $actor;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }
}
