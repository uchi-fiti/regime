<?php

namespace App\Controllers;

class Auth extends BaseController
{
    /**
     * Affiche la page d'inscription
     */
    public function inscription()
    {
        return view('front-office/inscription');
    }

    /**
     * Affiche la page de connexion
     */
    public function connection()
    {
        return view('front-office/connection');
    }

    /**
     * Affiche la page d'information sanitaire
     */
    public function information()
    {
        return view('front-office/information');
    }

    /**
     * Affiche la page de choix d'objectif
     */
    public function chooseObj()
    {
        return view('front-office/choose_obj');
    }

   
}
