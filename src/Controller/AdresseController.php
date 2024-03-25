<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\Type\AdresseType;
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
}
