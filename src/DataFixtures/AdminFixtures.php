<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Admin;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = new Admin();

        $manager->persist($admin
            ->setUsername("Roger")
            ->setPassword($this->encoder->encodePassword($admin, "rabit"))
            ->setEMail("roger.rabit@gmail.com")
            
        );

        $manager->flush();
    }
}
