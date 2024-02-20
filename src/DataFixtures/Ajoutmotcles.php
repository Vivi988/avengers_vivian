<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Motcles;

class Ajoutmotcles extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 25; $i++) {
            $motcles = new Motcles();
            $motcles->setMc('Mot-clé ' . $i);
            $manager->persist($motcles);
        }
        $manager->flush();
    }
}
