<?php

namespace App\Twig\Components;

use App\Entity\Video;
use App\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class VideosForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?Video $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $video = $this->initialFormData ?? new Video();
        return $this->createForm(VideoType::class, $video, [
            'action' => $video->getId()
                ? $this->generateUrl('app_video_edit', ['id' => $video->getId()])
                : $this->generateUrl('app_video_new'),
        ]);
    }
}
