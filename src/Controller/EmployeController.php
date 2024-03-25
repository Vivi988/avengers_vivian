<?php

namespace App\Controller;

use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
        $employe = $employeRepository->findAll();
        $totalEmploye = $employeRepository->compterTousLesEmployes();

        if (!$employe) {
            throw $this->createNotFoundException("Aucune employe n'est enregistré !");
        }

        return $this->render('employe/liste.html.twig', [
            'employe' => $employe,
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

}
