<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Marquepages;
use DateTime;


class MarquePagesController extends AbstractController
{
    // #[Route('/marque/pages', name: 'app_marque_pages')]
    // public function index(): Response
    // {
        

    //     return $this->render('marque_pages/index.html.twig', [
    //         'controller_name' => 'MarquePagesController',
    //     ]);
    // }

    // Définition de la route 
    #[Route('/ajouter')]
    public function addMarquePages(EntityManagerInterface $entityManager): Response
    {
        // Instanciation de la classe MarquePage
        $marquePage = new MarquePages();
        // Attribue les valeurs de l'objet en BDD
        $marquePage->setDateCreation(new DateTime('now'));
        $marquePage->setCommentaire("Test com");
        $marquePage->setUrl("Test.url");

        // Sauvegarde les livres dans la BDD
        $marquePage = $entityManager->persist($marquePage);
        $entityManager->flush();

        return new Response("<h1>Marque Page ajouté</h1><a href='/'>Retourner</a>");
    }
    // Définition de la route 
    #[Route('/')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        // Récupère les livres dans la BDD
        $marquePages = $entityManager->getRepository(Marquepages::class)->findAll();
        
        // Gestion d'erreur
        if(!$marquePages) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('marque_pages/index.html.twig', [
            'marquePages' => $marquePages,
        ]);
    }

    // Définition de la route 
    #[Route('/consulter/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, EntityManagerInterface $entityManager): Response
    {
        // Cherche les marques pages en bdd selon l'ID de l'article
        $details = $entityManager->getRepository(Marquepages::class)->find($id);

        if(!$details) {
            throw $this->createNotFoundException(
                "Aucun marque pages avec l'id ". $id
            );
        }

        $motcles = $details->getIdmotcles();
        // Ajoute les valeurs dans la Vue
        return $this->render('marque_pages/details.html.twig', [
            'details' => $details,
            'mc' => $motcles,
        ]);
    }
}
