<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard_base.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/add/bild', name: 'app_add_bild', methods: ['GET', 'POST'])]
    public function addBild(): Response
    {
        return $this->render('_gal-thumb.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
