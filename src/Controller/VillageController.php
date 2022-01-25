<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Evenement;
use App\Repository\ActualiteRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/village/evenements", name="events")
     */
    public function event(): Response
    {
        return $this->render('village/events.html.twig');
    }

    /**
     * @Route("/village/evenements/{id}", name="event_show")
     */
    public function eventShow(Evenement $evenement): Response
    {
        return $this->render('village/eventShow.html.twig', [
            'evenement' => $evenement
        ]);
    }

    /**
     * @Route("/village/new", name="actuality_create")
     */
    public function createActuality()
    {
        return $this->render('village/createActuality.html.twig');
    }

    /**
     * @Route("/village/actualitys", name="actualitys")
     */
    public function actuality(ActualiteRepository $repo): Response
    {
        return $this->render('village/actualitys.html.twig');
    }

    /**
     * @Route("/village/actualitys/{id}", name="actuality_show")
     */
    public function actualityShow(Actualite $actualite): Response
    {
        return $this->render('village/actualityShow.html.twig', [
            'actualite' => $actualite
        ]);
    }
}
