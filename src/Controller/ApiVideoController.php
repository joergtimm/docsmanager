<?php

namespace App\Controller;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ApiVideoController extends AbstractController
{
    #[Route('/api/video/{videoKey}', name: 'app_api_video_show', methods: ['GET', 'POST'])]
    public function apiShow(Video $video): JsonResponse
    {
        $videoValues = [
            'id' => $video->getId(),
            'key' => $video->getVideoKey(),
            'title' => $video->getTitle(),
            'isVisible' => $video->isIsverrifyted()
        ];

        return $this->json($videoValues);
    }
}
