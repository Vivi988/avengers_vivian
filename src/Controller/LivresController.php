<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Livre;
use App\Repository\LivreRepository;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        // Récupère les livres dans la BDD
        $livres = $entityManager->getRepository(Livre::class)->findAll();

        // Gestion d'erreur
        if (!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('livres/liste.html.twig', [
            'livres' => $livres,
        ]);
    }

    // Définition de la route 
    #[Route('/consulter/livre/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, EntityManagerInterface $entityManager): Response
    {
        // Cherche les marques pages en bdd selon l'ID de l'article
        $details = $entityManager->getRepository(Livre::class)->find($id);

        if (!$details) {
            throw $this->createNotFoundException(
                "Aucun livre avec l'id " . $id
            );
        }

        // Ajoute les valeurs dans la Vue
        return $this->render('livres/details.html.twig', [
            'details' => $details,
        ]);
    }

    public function listerLivresParLettre(LivreRepository $livreRepository, $lettre): Response
    {
        $livres = $livreRepository->trouverParPremiereLettre($lettre);

        return $this->render('livres/liste.html.twig', [
            'test1' => $livres,
        ]);
    }
}
