<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Motcles;

class MarquePagesMotClesController extends AbstractController
{
    // #[Route('/mot/cles', name: 'app_marque_pages_mot_cles')]
    // public function index(): Response
    // {
    //     return $this->render('marque_pages_mot_cles/index.html.twig', [
    //         'controller_name' => 'MarquePagesMotClesController',
    //     ]);
    // }

    #[Route('/recuperation')]
    public function recupMotcles(int $idmotcles, EntityManagerInterface $entityManager): Response 
    {
        $motcles = $entityManager->getRepository(Motcles::class)->find($idmotcles);
        return $this->render('marque_pages_mot_cles/index.html.twig', [
            'motcles' => $motcles,
        ]);
    }
}
