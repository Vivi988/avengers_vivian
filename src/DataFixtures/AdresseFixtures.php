<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Adresse;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 15; $i++) {
            $adresse = new Adresse();
            $adresse->setAdresse("123 rue de l'Exemple $i");
            $adresse->setCommune("Commune$i");
            $adresse->setText("Texte additionnel $i");
            $manager->persist($adresse);
        }

        $manager->flush();
    }
}
