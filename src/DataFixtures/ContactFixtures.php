<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Civilite;
use App\Entity\Contact;
use App\Entity\Motif;
use DateTime;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $mr = (new Civilite())->setGenre("Mr");
        $manager->persist($mr);

        $mme = (new Civilite())->setGenre("Mme");
        $manager->persist($mme);

        // $manager->flush();

        $motif_titles = [
            "Demander un renseignement",
            "Deposer une réclamation",
            "Partager une idée",
            "Suggérer une modification",
            "Nous faire part de votre encouragement",
            "Autre"
        ];

        $motifs = array(null, null, null, null, null, null);

        for ($i = 0; $i < count($motifs); $i++) {
            $motifs[$i] = (new Motif())->setTitle($motif_titles[$i]);
            $manager->persist($motifs[$i]);
        }

        // $manager->flush();

        // var_dump($motifs);

        $contacts = [
            [
                "motif" => $motifs[0],
                "nom" => "Lapin",
                "Prenom" => "Pierrot",
                "telephone" => "0383546234",
                "e_mail" => "pierrot.lapin@gmail.com",
                "civilite" => $mr,
                "content" => "Quand aura lieu le marché car je n'ai plus de carottes."
            ],
            [
                "motif" => $motifs[2],
                "nom" => "Rabbit",
                "Prenom" => "Roger",
                "telephone" => "0625495716",
                "e_mail" => "roger.rabbit@gmail.com",
                "civilite" => $mr,
                "content" => "Il faudrait ajouté un passage piéton au niveau de l'arrêt de bus dans le quartier St Georges."
            ],
            [
                "motif" => $motifs[0],
                "nom" => "Frog",
                "Prenom" => "Crazy",
                "telephone" => "",
                "e_mail" => "crazy.frog@gmail.com",
                "civilite" => $mr,
                "content" => "Quels sont les horaires d'ouverture de la mairie ?"
            ],
            [
                "motif" => $motifs[4],
                "nom" => "Maty",
                "Prenom" => "Mimi",
                "telephone" => "",
                "e_mail" => "mimi.maty@paradis.fr",
                "civilite" => $mme,
                "content" => "Toutes mes félicitations pour votre site internet."
            ],
        ];

        for ($i = 0; $i < count($contacts); $i++) {
            $contact_data = $contacts[$i];
            $manager->persist((new Contact())
                ->setMotif($contact_data["motif"])
                ->setNom($contact_data["nom"])
                ->setPrenom($contact_data["Prenom"])
                ->setTelephone($contact_data["telephone"])
                ->setEmail($contact_data["e_mail"])
                ->setCivilite($contact_data["civilite"])
                ->setContent($contact_data["content"])
                ->setCreatedAt(new DateTime())
            );
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
