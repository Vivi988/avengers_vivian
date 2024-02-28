<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LivreRepository;

use App\Form\Type\LivreType;
use App\Entity\Livre;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

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

    #[Route("/livre/ajout", name : "livre_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine )
    {
        // Création d’un objet que l'on assignera au formulaire
        $livre = new Livre();

        // $livre->setTitre("Mon titre pré-rempli !"); // Pour pré-renseigner des valeurs
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $livre = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();
            return $this->redirectToRoute('livre_succes');
        }

        return $this->render('livres/ajout.html.twig',[
            'mon_formulaire_livres' => $form,
        ]);
    }

    #[Route('/livre_succes', name: 'livre_succes')]
    public function succes(){
        $ceb = "okok";
        return $this->render('livres/succes.html.twig',[
            "ceb" => $ceb,
        ]);
    }
}
