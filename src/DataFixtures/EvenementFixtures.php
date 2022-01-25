<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 1; $i <= 3; $i++) {
            $evenement = new Evenement();
            $evenement->setTitle("Titre de l'évènement n°$i")
                ->setContent("Contenu de l'évènement n°$i")
                ->setImage("http://picsum.photos/id/" . mt_rand(1, 200) . "/400/300")
                ->setCreatedAt(new DateTime());
            $manager->persist($evenement);
        }

        $manager->flush();
    }
}
