<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\AdresseType;
use App\Entity\Adresse;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class AdresseController extends AbstractController
{
    // #[Route('/adresse', name: 'app_adresse')]
    // public function index(): Response
    // {
    //     return $this->render('adresse/index.html.twig', [
    //         'controller_name' => 'AdresseController',
    //     ]);
    // }

    #[Route('/adresse', name: 'app_adresse')]
    public function getAll(AdresseRepository $adresseRepository): Response
    {
        $adresse = $adresseRepository->findAll();
        $totalAdresse = $adresseRepository->compterToutesLesAdresses();

        if (!$adresse) {
            throw $this->createNotFoundException("Aucune adresse n'est enregistrée !");
        }

        return $this->render('adresse/liste.html.twig', [
            'adresse' => $adresse,
            'totalAdresse' => $totalAdresse,
        ]);
    }

    /**
     * Affiche les détails d'une adresse spécifique par son ID.
     */
    #[Route('/consulter/adresse/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, AdresseRepository $AdresseRepository): Response
    {
        $details = $AdresseRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucune adresse avec l'id $id");
        }

        return $this->render('adresse/details.html.twig', [
            'details' => $details,
        ]);
    }

    #[Route('/adresse_succes', name: 'adresse_succes')]
    public function succes()
    {
        $ceb = "modification okok";
        return $this->render('adresse/succes.html.twig', [
            "ceb" => $ceb,
        ]);
    }

    #[Route("/adresse/ajout", name: "adresse_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine)
    {
        // Création d’un objet que l'on assignera au formulaire
        $adresse = new Adresse();

        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $employe = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($adresse);
            $entityManager->flush();
            return $this->redirectToRoute('adresse_succes');
        }

        return $this->render('adresse/ajout.html.twig', [
            'mon_formulaire_adresses' => $form,
        ]);
    }

    #[Route("/modifier/adresse/{id}", name: "adresse_modifier")]
    public function modifier(int $id, Request $request, AdresseRepository $adresseRepository, ManagerRegistry $doctrine): Response
    {
        $details = $adresseRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucune adresse avec l'id $id");
        }

        $form = $this->createForm(AdresseType::class, $details);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($details);
            $entityManager->flush();

            return $this->redirectToRoute('adresse_succes');
        }

        return $this->render('adresse/modif.html.twig', [
            'mon_formulaire_adresses_modif' => $form->createView(),
            'details_modif' => $details,
        ]);
    }
}
