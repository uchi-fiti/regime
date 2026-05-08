<?php

namespace App\Controllers;

class Auth extends BaseController
{
    /**
     * Affiche la page d'inscription
     */
    public function inscription()
    {
        return view('inscription');
    }

    /**
     * Affiche la page de connexion
     */
    public function connection()
    {
        return view('connection');
    }

    /**
     * Affiche la page d'information sanitaire
     */
    public function information()
    {
        return view('information');
    }

    /**
     * Affiche la page de choix d'objectif
     */
    public function chooseObj()
    {
        return view('choose_obj');
    }
}
