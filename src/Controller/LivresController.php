<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Livre;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function getAll(EntityManagerInterface $entityManager): Response
    {
        // Récupère les livres dans la BDD
        $livres = $entityManager->getRepository(Livre::class)->findAll();
        
        // Gestion d'erreur
        if(!$livres) {
            throw $this->createNotFoundException("Aucun livre n'est enregistré !");
        }

        // Transfère les données à la Vue
        return $this->render('livres/liste.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/ajouterlivre')]
    public function addLivre(EntityManagerInterface $entityManager): Response
    {
        // Instanciation de la classe Livre
        $livre = new Livre();
        // Attribue les valeurs de l'objet en BDD
        $livre->setAuteur("tata " . mt_rand(1,35));
        $livre->setAnnee(new \DateTime(mt_rand(1975, 2020)));
        $livre->setTitre("L'art et la mane hier");

        // Sauvegarde les livres dans la BDD
        $entityManager->persist($livre);
        $entityManager->flush();

        return new Response("<h1>Livre ajouté</h1><a href='/livres'>Retourner</a>");
    }

    // Définition de la route 
    #[Route('/consulter/livre/{id}', requirements: ["id" => "\d+"])]
    public function consulterDetails(int $id, EntityManagerInterface $entityManager): Response
    {
        // Cherche les marques pages en bdd selon l'ID de l'article
        $details = $entityManager->getRepository(Livre::class)->find($id);

        if(!$details) {
            throw $this->createNotFoundException(
                "Aucun livre avec l'id ". $id
            );
        }

        // Ajoute les valeurs dans la Vue
        return $this->render('livres/details.html.twig', [
            'details' => $details,
        ]);
    }
}
