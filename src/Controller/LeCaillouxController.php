<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\LeCailloux;

class LeCaillouxController extends AbstractController
{
    // #[Route('/lecailloux', name: 'app_le_cailloux')]
    // public function index(): Response
    // {
    //     return $this->render('le_cailloux/index.html.twig', [
    //         'controller_name' => 'LeCaillouxController',
    //     ]);
    // }

    #[Route('/lecailloux', name: 'app_le_cailloux')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        // Récupère les données dans la BDD
        $listeducailloux = $entityManager->getRepository(LeCailloux::class)->findAll();
        
        // Gestion d'erreur
        if(!$listeducailloux) {
            throw $this->createNotFoundException("Aucuns cliché du cailloux n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('le_cailloux/index.html.twig', [
            'listeducailloux' => $listeducailloux,
        ]);
    }

}
