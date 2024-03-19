<?php

namespace App\Twig\Components;

use App\Entity\Video;
use App\Form\VideoPartipiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
final class VideoActorParticipiant extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?Video $video;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            VideoPartipiantType::class,
            $this->video
        );
    }
}
