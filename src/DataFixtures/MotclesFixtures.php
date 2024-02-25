<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Motcles;
use App\Entity\Marquepages;

class MotclesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $motclesList = [];

        // Persiste 25 Motcles
        for ($i = 0; $i < 25; $i++) {
            $motcles = new Motcles();
            $motcles->setMc('Mot-clé ' . $i);
            $manager->persist($motcles);
            $motclesList[] = $motcles; // Ajoute le mot-clé à la liste pour utilisation ultérieure
        }

        // Crée et persiste des Marquepages avec des mots-clés associés aléatoirement
        for ($j = 0; $j < 10; $j++) { // Adaptez ce nombre pour créer plus ou moins de Marquepages
            $marquepage = new Marquepages();
            $marquepage->setUrl('http://example.com/page' . $j);
            $marquepage->setDatecreation(new \DateTime(mt_rand(2000, 2020)));
            $marquepage->setCommentaire('Ceci est un exemple de marque-page ' . $j);

            // Associe aléatoirement entre 2 et 5 Motcles à ce Marquepage
            $randomMotcles = (array)array_rand($motclesList, rand(2, 5));
            foreach ($randomMotcles as $index) {
                $marquepage->addIdmotcle($motclesList[$index]); // Associe le mot-clé au marque-page
            }

            $manager->persist($marquepage);
        }

        $manager->flush(); // Enregistre toutes les modifications dans la base de données
    }
}
