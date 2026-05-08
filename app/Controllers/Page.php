<?php

namespace App\Controllers;

class Page extends BaseController
{
    /**
     * Affiche la page model/template
     */
    public function model()
    {
        return view('model');
    }

     public function home()
    {
        return view('home');
    }
}
