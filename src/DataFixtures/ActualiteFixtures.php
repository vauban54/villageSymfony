<?php

namespace App\DataFixtures;

use App\Entity\Actualite;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActualiteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 1; $i <= 3; $i++) {
            $actualite = new Actualite();
            $actualite->setTitle("Titre de l'actulité n°$i")
                ->setContent("Contenu de l'article n°$i")
                ->setImage("http://picsum.photos/id/" . mt_rand(1, 200) . "/400/300")
                ->setCreatedAt(new DateTime());
            $manager->persist($actualite);
        }

        $manager->flush();
    }
}
