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
        return $this->render('village/index.html.twig', [
        ]);
    }

    /**
     * @Route("/histoire", name="history")
     */
    public function history(): Response {
        return $this->render('village/histoire.html.twig');
    }
}
