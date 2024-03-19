<?php

namespace App\DTO;

use App\Entity\VideoActors;

class VideoActrorsInfo
{
    public ?VideoActors $videoActor = null;

    public bool $hasIdShot = false;

    public bool $hasIdCardFront = false;

    public bool $hasIdCardBack = false;

    public bool $hasContract = false;

    public bool $hasAllRequiredDocuments = false;

    public ?string $IDSFileName = null;

    public ?string $IDCFrontFileName = null;

    public ?string $IDCBackFileName = null;

    public ?string $ContractFileName = null;

    public ?string $videoDocsFolder = null;

    public ?array $videoActorDocs = [];

    public function __construct(
        ?VideoActors $videoActor = null,
        bool $hasIdShot = false,
        bool $hasIdCardFront = false,
        bool $hasIdCardBack = false,
        bool $hasContract = false,
    ) {
        $this->videoActor = $videoActor;
        $this->hasIdShot = $hasIdShot;
        $this->hasIdCardFront = $hasIdCardFront;
        $this->hasIdCardBack = $hasIdCardBack;
        $this->hasContract = $hasContract;
        $this->hasAllRequiredDocuments =
            $this->hasIdShot && $this->hasIdCardFront && $this->hasIdCardBack && $this->hasContract;
    }

    public function setHasIdShot(bool $hasIdShot): void
    {
        $this->hasIdShot = $hasIdShot;
    }

    public function setHasIdCardFront(bool $hasIdCardFront): void
    {
        $this->hasIdCardFront = $hasIdCardFront;
    }

    public function setHasIdCardBack(bool $hasIdCardBack): void
    {
        $this->hasIdCardBack = $hasIdCardBack;
    }

    public function setHasContract(bool $hasContract): void
    {
        $this->hasContract = $hasContract;
    }

    public function setIDSFileName(?string $IDSFileName): void
    {
        $this->IDSFileName = $IDSFileName;
    }

    public function getHasIdShot(): bool
    {
        return $this->hasIdShot;
    }

    public function getHasIdCardFront(): bool
    {
        return $this->hasIdCardFront;
    }

    public function getHasIdCardBack(): bool
    {
        return $this->hasIdCardBack;
    }

    public function setHasAllRequiredDocuments(bool $hasAllRequiredDocuments): void
    {
        $this->hasAllRequiredDocuments = $hasAllRequiredDocuments;
    }

    public function hasAllRequiredDocuments(): bool
    {
        return $this->hasIdShot && $this->hasIdCardFront && $this->hasIdCardBack && $this->hasContract;
    }

    public function getIDCFrontFileName(): ?string
    {
        return $this->IDCFrontFileName;
    }

    public function setIDCFrontFileName(?string $IDCFrontFileName): void
    {
        $this->IDCFrontFileName = $IDCFrontFileName;
    }

    public function getIDCBackFileName(): ?string
    {
        return $this->IDCBackFileName;
    }

    public function setIDCBackFileName(?string $IDCBackFileName): void
    {
        $this->IDCBackFileName = $IDCBackFileName;
    }

    public function getContractFileName(): ?string
    {
        return $this->ContractFileName;
    }

    public function setContractFileName(?string $ContractFileName): void
    {
        $this->ContractFileName = $ContractFileName;
    }

    public function getVideoDocsFolder(): ?string
    {
        return $this->videoDocsFolder;
    }

    public function setVideoDocsFolder(?string $videoDocsFolder): void
    {
        $this->videoDocsFolder = $videoDocsFolder;
    }

    public function getVideoActorDocs(): ?array
    {
        return $this->videoActorDocs;
    }

    public function setVideoActorDocs(?array $videoActorDocs): void
    {
        $this->videoActorDocs = $videoActorDocs;
    }
}
