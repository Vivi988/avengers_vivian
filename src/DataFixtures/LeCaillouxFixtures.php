<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\LeCailloux; // Assurez-vous d'importer votre entité LeCailloux

class LeCaillouxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // tableau de données pour les cailloux
        $dataCailloux = [
            ['url' => 'https://www.picture-worl.org/_media/img/large/img-2773.jpg', 'description' => 'Description1', 'categorie' => 'Flore'],
            ['url' => 'https://backoffice.lepetitjournal.com/sites/default/files/inline-images/TORTUES%20randall-ruiz-LVnJlyfa7Zk-unsplash.jpg', 'description' => 'Description2', 'categorie' => 'Faune'],
            ['url' => 'https://www.picture-worl.org/_media/img/large/img-2773.jpg', 'description' => 'Description1', 'categorie' => 'Flore'],
            ['url' => 'https://backoffice.lepetitjournal.com/sites/default/files/inline-images/TORTUES%20randall-ruiz-LVnJlyfa7Zk-unsplash.jpg', 'description' => 'Description2', 'categorie' => 'Faune'],
            ['url' => 'https://www.picture-worl.org/_media/img/large/img-2773.jpg', 'description' => 'Description1', 'categorie' => 'Flore'],
            ['url' => 'https://backoffice.lepetitjournal.com/sites/default/files/inline-images/TORTUES%20randall-ruiz-LVnJlyfa7Zk-unsplash.jpg', 'description' => 'Description2', 'categorie' => 'Faune'],
        ];

        // Parcourt chaque élément du tableau et crée une entité LeCailloux
        foreach ($dataCailloux as $data) {
            $leCailloux = new LeCailloux();
            $leCailloux->setUrl($data['url']);
            $leCailloux->setDescription($data['description']);
            $leCailloux->setCategorie($data['categorie']);

            $manager->persist($leCailloux);
        }

        $manager->flush();
    }
}
