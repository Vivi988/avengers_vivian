<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Employe;

class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 15; $i++) {
            $employe = new Employe();
            $employe->setNom("Doe$i");
            $employe->setPrenom("John$i");
            $employe->setPoste("Poste$i");
            $manager->persist($employe);
        }

        $manager->flush();
    }
}

