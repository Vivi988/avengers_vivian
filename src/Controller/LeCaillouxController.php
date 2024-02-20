<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LeCaillouxController extends AbstractController
{
    #[Route('/le/cailloux', name: 'app_le_cailloux')]
    public function index(): Response
    {
        return $this->render('le_cailloux/index.html.twig', [
            'controller_name' => 'LeCaillouxController',
        ]);
    }
}
