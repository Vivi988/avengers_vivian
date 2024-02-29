<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteur;

class AuteurFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de 15 auteurs
        for ($i = 0; $i < 15; $i++) {
            $auteur = new Auteur();
            $auteur->setNom('Toto' . $i);
            $auteur->setPrenom('Doe' . $i);
            $auteur->setDatedenaissance(new \DateTime(mt_rand(1975, 1990)));
            $manager->persist($auteur);
        }

        $manager->flush();
    }
}
