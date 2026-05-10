<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\UserHealthInfoModel;

class RecommandationController extends BaseController {
    
    public function generer() {
        $modelHealth = new UserHealthInfoModel();

        $info = $modelHealth->find(6);
        
        if (!$info) {
            return view('test', [
                'infos' => [],
                'recommandations' => []
            ]);
        }

        $infos = [
            'id_user' => $info['id_user'],
            'poids' => $info['poids'],
            'valeur_objectif' => $info['valeur_objectif']
        ];

        $recommandations = $modelHealth->genererRecommandations($infos);
        
        return view('test', [
            // 'page' => 'test', 
            'infos' => [$info],
            'recommandations' => $recommandations
        ]);
    }
}