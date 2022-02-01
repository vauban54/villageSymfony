<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Form\ActualityType;
use App\Form\ContactType;
use App\Form\EventType;
use App\Repository\ActualiteRepository;
use App\Repository\ContactRepository;
use App\Repository\EvenementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response as FlexResponse;

class VillageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $repoEvent, ActualiteRepository $repoActuality): Response
    {
        $evenements = $repoEvent->findAll();

        $actualites = $repoActuality->findAll();
        return $this->render('village/index.html.twig', [
            // Je crée les variables correspondante à mes repository
            'evenements' => $evenements,
            'actualites' => $actualites
        ]);
    }

    /**
     * @Route("/histoire", name="history")
     */
    public function history(): Response
    {
        return $this->render('village/histoire.html.twig');
    }

    /**
     * @Route("/newEvenement", name="event_create")
     * @Route("/evenements/{id}/edit", name="event_edit")
     */
    public function createEvenement(Evenement $evenement = null, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$evenement) {
            $evenement = new Evenement();
        }

        $formEvenement = $this->createForm(EventType::class, $evenement);

        $formEvenement->handleRequest($request);

        // On vérifier que le form est soumettable et valide
        if ($formEvenement->isSubmitted() && $formEvenement->isValid()) {
            if (!$evenement->getId()) {
                $evenement->setCreatedAt(new DateTime());
            }

            $manager->persist($evenement);
            $manager->flush();

            return $this->redirectToRoute('event_show', [
                'id' => $evenement->getId()
            ]);
        }

        // dump($evenement);

        return $this->render('village/createEvent.html.twig', [
            'formEvenement' => $formEvenement->createView(),
            'editModeEvent' => $evenement->getId() !== null
        ]);
    }

    /**
     * @Route("/evenements", name="events")
     */
    public function event(EvenementRepository $repoEvent): Response
    {
        $evenements = $repoEvent->findAll();
        return $this->render('village/events.html.twig', [
            'evenements' => $evenements
        ]);
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
     * @Route("/evenements/{id}/remove", name="event_remove")
     */
    public function eventRemove(Evenement $evenement, EntityManagerInterface $manager): Response
    {

        // On supprime l'évènement
        $manager->remove($evenement);
        $manager->flush();

        return $this->render('village/eventRemove.html.twig');
    }

    /**
     * @Route("/newActuality", name="actuality_create")
     * @Route("/actualitys/{id}/edit", name="actuality_edit")
     */
    public function createActuality(Actualite $actualite = null, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$actualite) {
            $actualite = new Actualite();
        }


        $formActualite = $this->createForm(ActualityType::class, $actualite);


        $formActualite->handleRequest($request);

        // On vérifier que le form est soumettable et valide
        if ($formActualite->isSubmitted() && $formActualite->isValid()) {
            if (!$actualite->getId()) {
                $actualite->setCreatedAt(new DateTime());
            }

            $manager->persist($actualite);
            $manager->flush();

            return $this->redirectToRoute('actuality_show', [
                'id' => $actualite->getId()
            ]);
        }

        // dump($actualite);

        return $this->render('village/createActuality.html.twig', [
            'formActualite' => $formActualite->createView(),
            'editMode' => $actualite->getId() !== null
        ]);
    }

    /**
     * @Route("/actualitys", name="actualitys")
     */
    public function actuality(ActualiteRepository $repoActuality): Response
    {
        $actualites = $repoActuality->findAll();
        return $this->render('village/actualitys.html.twig', [
            'actualites' => $actualites
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
     * @Route("/actualitys/{id}/remove", name="actuality_remove")
     */
    public function actualityRemove(Actualite $actualite, EntityManagerInterface $manager): Response
    {
        //On supprime l'actualité
        $manager->remove($actualite);
        $manager->flush();

        return $this->render('village/actualityRemove.html.twig');
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
     * @Route("/contact", name="contact")
     */
    public function contact(ContactRepository $repoContact): Response
    {
        $contacts = $repoContact->findAll();
        return $this->render('village/contact.html.twig', [
            'contacts' => $contacts
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

    /**
     * @Route("/contact/{id}/remove", name="contact_remove")
     */
    public function contactRemove(Contact $contact, EntityManagerInterface $manager): Response
    {
        $manager->remove($contact);
        $manager->flush();
        return $this->render('village/contactRemove.html.twig');
    }
}
