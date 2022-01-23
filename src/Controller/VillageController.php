<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VillageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('village/index.html.twig', []);
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
     * @Route("/village/evenements/12", name="event_show")
     */
    public function eventShow(): Response
    {
        return $this->render('village/eventShow.html.twig');
    }

    /**
     * @Route("/village/actualitys", name="actualitys")
     */
    public function actuality(): Response
    {
        return $this->render('village/actualitys.html.twig');
    }

    /**
     * @Route("/village/actualitys/11", name="actuality_show")
     */
    public function actualityShow(): Response
    {
        return $this->render('village/actualityShow.html.twig');
    }
}
