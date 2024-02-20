<?php

namespace App\Twig\Components;

use App\Entity\Documents;
use App\Entity\Mandnat;
use App\Entity\VideoActors;
use App\Form\DocumentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(method: 'get')]
final class DocumentsForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?Documents $initialFormData = null;

    #[LiveProp]
    public ?VideoActors $videoActor = null;

    protected function instantiateForm(): FormInterface
    {
        $document = $this->initialFormData ?? new Documents();
        $videoActor = $this->videoActor;
        $document->setVideoActor($videoActor);

        return $this->createForm(DocumentsType::class, $document, [
            'action' => $document->getId()
                ? $this->generateUrl('app_document_edit', ['id' => $document->getId()])
                : $this->generateUrl('app_document_new', ['id' => $videoActor->getId()]),
        ]);
    }
}
