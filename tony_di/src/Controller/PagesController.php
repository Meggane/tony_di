<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/homepage", name="homepage")
     */
    public function index()
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    /**
     * @Route("/dates", name="dates")
     */
    public function dates() {
        return $this->render("pages/dates.html.twig", [
            "controller_name" => "PagesController",
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation() {
        return $this->render("pages/presentation.html.twig", [
            "controller_name" => "PagesController",
        ]);
    }

    /**
     * @Route("/animations", name="animations")
     */
    public function animations() {
        return $this->render("pages/animations.html.twig", [
            "controller_name" => "PagesController",
        ]);
    }

    /**
     * @Route("/theatre", name="theater")
     */
    public function theater() {
        return $this->render("pages/theater.html.twig", [
            "controller_name" => "PagesController",
        ]);
    }

    /**
     * @Route("/legal_notice", name="legal_notice")
     */
    public function legalNotice() {
        return $this->render("pages/legal_notice.html.twig", [
            "controller_name" => "PagesController",
        ]);
    }
}
