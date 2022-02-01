<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Contact;
use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\ContactRepository;
use App\Repository\EvenementRepository;
use App\Form\EventType;
use App\Form\ActualityType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use DateTime;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(ContactRepository $repoContact): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Récupération de tout les contacts depuis le repository
        $contacts = $repoContact->findAll();
        return $this->render('village/contact.html.twig', [
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/newEvenement", name="event_create")
     * @Route("/evenements/{id}/edit", name="event_edit")
     */
    public function createEvenement(Evenement $evenement = null, Request $request, EntityManagerInterface $manager): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
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
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $evenements = $repoEvent->findAll();
        return $this->render('village/events.html.twig', [
            'evenements' => $evenements
        ]);
    }

    /**
     * @Route("/evenements/{id}/remove", name="event_remove")
     */
    public function eventRemove(Evenement $evenement, EntityManagerInterface $manager): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

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
        
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
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
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $actualites = $repoActuality->findAll();
        return $this->render('village/actualitys.html.twig', [
            'actualites' => $actualites
        ]);
    }

    /**
     * @Route("/actualitys/{id}/remove", name="actuality_remove")
     */
    public function actualityRemove(Actualite $actualite, EntityManagerInterface $manager): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }        
        
        //On supprime l'actualité
        $manager->remove($actualite);
        $manager->flush();

        return $this->render('village/actualityRemove.html.twig');
    }

    /**
     * @Route("/contact/{id}/remove", name="contact_remove")
     */
    public function contactRemove(Contact $contact, EntityManagerInterface $manager): Response
    {
        // Si on est pas connecter on redirige vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $manager->remove($contact);
        $manager->flush();
        return $this->render('village/contactRemove.html.twig');
    }






}
