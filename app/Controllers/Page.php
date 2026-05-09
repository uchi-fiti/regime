<?php

namespace App\Controllers;

class Page extends BaseController
{
    /**
     * Affiche le modèle/template avec navigation dynamique
     */
    public function model()
    {
        $page = $this->request->getGet('page') ?? 'home';
        
        // Validation pour éviter les injections
        $allowed = ['regimes', 'profil', 'gold'];
        $page = in_array($page, $allowed) ? $page : 'home';
        
        return view('model', ['page' => $page]);
    }
}