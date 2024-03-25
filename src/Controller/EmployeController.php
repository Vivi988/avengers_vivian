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
}
