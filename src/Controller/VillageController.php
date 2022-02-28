<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Form\ActualityType;
use App\Form\ContactType;
use App\Form\EventType;
use App\Repository\ActualiteRepository;
use App\Repository\AdminRepository;
use App\Repository\ContactRepository;
use App\Repository\EvenementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;


class VillageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $repoEvent, ActualiteRepository $repoActuality, AdminRepository $repoAdmin): Response
    {
        $evenements = $repoEvent->findAll();

        $actualites = $repoActuality->findAll();

        $admins = $repoAdmin->findAll();
        return $this->render('village/index.html.twig', [
            // Je crée les variables correspondante à mes repository
            'admins' => $admins,
            'evenements' => $evenements,
            'i' => 0,            
            'actualites' => $actualites
        ]);
    }

    /**
     * @Route("/admin/histoire", name="history")
     */
    public function history(): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('village/histoire.html.twig');
    }
        
    /**
     * @Route("/evenements/{id}", name="event_show")
     */
    public function eventShow(Evenement $evenement): Response
    {
        return $this->render('village/eventShow.html.twig', [
            'evenement' => $evenement
        ]);
    }  
    
    /**
     * @Route("/actualitys/{id}", name="actuality_show")
     */
    public function actualityShow(Actualite $actualite): Response
    {
        return $this->render('village/actualityShow.html.twig', [
            'actualite' => $actualite

        ]);
    }
    
    /**
     * @Route("/takeContact", name="contact_create")
     * @Route("/contact/{id}/edit", name="contact_edit")
     */
    public function takeContact(Contact $contact = null, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$contact) {
            $contact = new Contact();
        }

        $formContact = $this->createForm(ContactType::class, $contact);

        $formContact->handleRequest($request);

        // On vérifier que le form est soumettable et valide
        if ($formContact->isSubmitted() && $formContact->isValid()) {

            if (!$contact->getId()) {
                $contact->setCreatedAt(new DateTime());
            }
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }

        // dump($contact);

        return $this->render('village/takeContact.html.twig', [
            'formContact' => $formContact->createView(),
            'editModeContact' => $contact->getId() !== null
        ]);
    }   

    /**
     * @Route("/contact/{id}", name="contact_show")
     */
    public function contactShow(Contact $contact): Response
    {
        return $this->render('village/contactShow.html.twig', [
            'contact' => $contact
        ]);
    }
    
}
