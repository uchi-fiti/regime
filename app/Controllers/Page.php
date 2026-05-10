<?php

namespace App\Controllers;
use App\Models\UserHealthInfoModel;

class Page extends BaseController
{
    /**
     * Affiche le modèle/template avec navigation dynamique
     */
    public function model()
    {
        $page = $this->request->getGet('page') ?? 'home';
        
        // Validation pour éviter les injections
        $allowed = ['regimes', 'profil', 'gold','recommandation'];
        $page = in_array($page, $allowed) ? $page : 'home';
        $realpage = "front-office/{$page}";
        
        return view('model', ['page' => $realpage]);
    }

}