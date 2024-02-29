<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use DateTime;

class LivreFIxtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Création de 15 livres
        for ($i = 0; $i < 15; $i++) {
            $livre = new Livre();
            $livre->setTitre('Livre ' . $i);
            $livre->setAuteur('Auteur ' . $i);
            $livre->setAnnee(new \DateTime(mt_rand(1975, 2020)));
            $manager->persist($livre);
        }
        $manager->flush();
    }
}
