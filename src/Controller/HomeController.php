<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function indexCadeaux(): string
    {
        return $this->twig->render('Home/main_cadeaux.html.twig');
    }

    public function indexGoddies(): string
    {
        return $this->twig->render('Home/main_goddies.html.twig');
    }

    public function indexVisite(): string
    {
        return $this->twig->render('Home/main_visite.html.twig');
    }

    public function indexAccueil(): string
    {
        return $this->twig->render('Home/main_accueil.html.twig');
    }
}
