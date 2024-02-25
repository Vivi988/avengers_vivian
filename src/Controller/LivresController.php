<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LivreRepository;

/**
 * Contrôleur gérant les livres.
 */
class LivresController extends AbstractController
{
    /**
     * Affiche la liste de tous les livres et le nombre total de livres.
     */
    #[Route('/livres', name: 'app_livres')]
    public function getAll(LivreRepository $livreRepository): Response
    {
        $livres = $livreRepository->findAll();
        $totalLivres = $livreRepository->compterTousLesLivres();

        if (!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        return $this->render('livres/liste.html.twig', [
            'livres' => $livres,
            'totalLivres' => $totalLivres,
        ]);
    }

    /**
     * Affiche les détails d'un livre spécifique par son ID.
     */
    #[Route('/consulter/livre/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, LivreRepository $livreRepository): Response
    {
        $details = $livreRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucun livre avec l'id $id");
        }

        return $this->render('livres/details.html.twig', [
            'details' => $details,
        ]);
    }

    /**
     * Liste les livres dont le titre commence par une lettre donnée.
     */
    #[Route('/livres/lettre/{lettre}', name: 'livres_par_lettre')]
    public function listerLivresParLettre(LivreRepository $livreRepository, string $lettre): Response
    {
        $listelivre = $livreRepository->trouverParPremiereLettre($lettre);

        return $this->render('livres/liste.html.twig', [
            'livres' => $listelivre,
        ]);
    }
}
