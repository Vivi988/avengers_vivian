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
        $totalAuteur = $auteurRepository->compterTousLesAuteurs();

        if (!$auteurs) {
            throw $this->createNotFoundException("Aucun auteur n'est enregistré !");
        }

        return $this->render('auteur/liste.html.twig', [
            'auteurs' => $auteurs,
            'totalAuteurs' => $totalAuteur,
        ]);
    }

    #[Route("/auteur/ajout", name: "auteur_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine)
    {
        // Création d’un objet que l'on assignera au formulaire
        $auteur = new Auteur();

        // $livre->setTitre("Mon titre pré-rempli !"); // Pour pré-renseigner des valeurs
        $form = $this->createForm(AuteurType::class, $auteur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('auteur_succes');
        }

        return $this->render('auteur/ajout.html.twig', [
            'mon_formulaire_auteurs' => $form,
        ]);
    }

    #[Route('/auteur_succes', name: 'auteur_succes')]
    public function succes()
    {
        return $this->render('auteur/succes.html.twig', []);
    }

    #[Route("/modifier/auteur/{id}", name: "auteur_modifier")]
    public function modifier(int $id, Request $request, AuteurRepository $auteurRepository, ManagerRegistry $doctrine): Response
    {
        $details = $auteurRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucun auteur avec l'id $id");
        }

        $form = $this->createForm(AuteurType::class, $details);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($details);
            $entityManager->flush();

            return $this->redirectToRoute('auteur_succes');
        }

        return $this->render('auteur/modif.html.twig', [
            'mon_formulaire_auteurs_modif' => $form->createView(),
            'details' => $details,
        ]);
    }
}
