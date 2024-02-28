<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\Type\AuteurType;
use App\Entity\Auteur;
use App\Repository\AuteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class AuteurController extends AbstractController
{
    // #[Route('/auteur', name: 'app_auteur')]
    // public function index(): Response
    // {
    //     return $this->render('auteur/index.html.twig', [
    //         'controller_name' => 'AuteurController',
    //     ]);
    // }

    #[Route('/auteur', name: 'app_auteur')]
    public function getAll(AuteurRepository $auteurRepository): Response
    {
        $auteurs = $auteurRepository->findAll();
        $totalAuteur = $auteurRepository->compterTousLesLivres();

        if (!$auteurs) {
            throw $this->createNotFoundException("Aucun auteur n'est enregistré !");
        }

        return $this->render('livres/liste.html.twig', [
            'livres' => $auteurs,
            'totalLivres' => $totalAuteur,
        ]);
    }

    #[Route("/auteur/ajout", name : "auteur_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine )
    {
        // Création d’un objet que l'on assignera au formulaire
        $auteur = new Auteur();

        // $livre->setTitre("Mon titre pré-rempli !"); // Pour pré-renseigner des valeurs
        $form = $this->createForm(AuteurType::class, $auteur);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $livre = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('aueteur_succes');
        }

        return $this->render('auteur/ajout.html.twig',[
            'mon_formulaire_auteurs' => $form,
        ]);
    }

    #[Route('/auteur_succes', name: 'auteur_succes')]
    public function succes(){
        $ceb = "okok";
        return $this->render('auteur/succes.html.twig',[
            "ceb" => $ceb,
        ]);
    }
}
