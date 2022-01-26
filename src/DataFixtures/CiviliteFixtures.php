<?php

namespace App\DataFixtures;

use App\Entity\Civilite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CiviliteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $civilite = new Civilite();
        $civilite->setGenre("Mr");
        $manager->persist($civilite);

        $civilite2 = new Civilite();
        $civilite2->setGenre("Mme");
        $manager->persist($civilite2);
        $manager->flush();
    }
}
