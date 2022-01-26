<?php

namespace App\DataFixtures;

use App\Entity\Motif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MotifFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $motif1 = new Motif();
        $motif1->setTitle("Demander un renseignement");
        $manager->persist($motif1);

        $motif2 = new Motif();
        $motif2->setTitle("Deposer une réclamation");
        $manager->persist($motif2);

        $motif3 = new Motif();
        $motif3->setTitle("Partager une idée");
        $manager->persist($motif3);

        $motif4 = new Motif();
        $motif4->setTitle("Suggérer une modification");
        $manager->persist($motif4);

        $motif5 = new Motif();
        $motif5->setTitle("Nous faire part de votre encouragement");
        $manager->persist($motif5);

        $motif6 = new Motif();
        $motif6->setTitle("Autre");
        $manager->persist($motif6);

        $manager->flush();
    }
}
