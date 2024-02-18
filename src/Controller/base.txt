<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarquePagesController extends AbstractController
{
    #[Route('/marque/pages', name: 'app_marque_pages')]
    public function index(): Response
    {
        return $this->render('marque_pages/index.html.twig', [
            'controller_name' => 'MarquePagesController',
        ]);
    }
}
