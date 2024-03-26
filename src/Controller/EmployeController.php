<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EmployeRepository;

use App\Form\Type\EmployeType;
use App\Entity\Employe;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class EmployeController extends AbstractController
{
    // #[Route('/employe', name: 'app_employe')]
    // public function index(): Response
    // {
    //     return $this->render('employe/index.html.twig', [
    //         'controller_name' => 'EmployeController',
    //     ]);
    // }

    // Lister les employés
    #[Route('/employe', name: 'app_employe')]
    public function getAll(EmployeRepository $employeRepository): Response
    {
        $employes = $employeRepository->findAll();
        $totalEmploye = $employeRepository->compterTousLesEmployes();

        if (!$employes) {
            throw $this->createNotFoundException("Aucun employe n'est enregistré !");
        }

        return $this->render('employe/liste.html.twig', [
            'employe' => $employes,
            'totalEmploye' => $totalEmploye,
        ]);
    }

    /**
     * Affiche les détails d'un employé spécifique par son ID.
     */
    #[Route('/consulter/employe/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, EmployeRepository $EmployeRepository): Response
    {
        $details = $EmployeRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucun employé avec l'id $id");
        }

        return $this->render('employe/details.html.twig', [
            'details' => $details,
        ]);
    }

    #[Route("/employe/ajout", name: "employe_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine)
    {
        // Création d’un objet que l'on assignera au formulaire
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $employe = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();
            return $this->redirectToRoute('employe_succes');
        }

        return $this->render('employe/ajout.html.twig', [
            'mon_formulaire_employes' => $form,
        ]);
    }

    #[Route('/employe_succes', name: 'employe_succes')]
    public function succes()
    {
        $ceb = "modification okok";
        return $this->render('employe/succes.html.twig', [
            "ceb" => $ceb,
        ]);
    }

    #[Route("/modifier/employe/{id}", name: "employe_modifier")]
    public function modifier(int $id, Request $request, EmployeRepository $employeRepository, ManagerRegistry $doctrine): Response
    {
        $details = $employeRepository->find($id);

        if (!$details) {
            throw $this->createNotFoundException("Aucun employé avec l'id $id");
        }

        $form = $this->createForm(EmployeType::class, $details);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($details);
            $entityManager->flush();

            return $this->redirectToRoute('employe_succes');
        }

        return $this->render('employe/modif.html.twig', [
            'mon_formulaire_employes_modif' => $form->createView(),
            'details_modif' => $details,
        ]);
    }
}
