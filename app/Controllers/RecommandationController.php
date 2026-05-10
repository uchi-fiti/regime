<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\UserHealthInfoModel;

class RecommandationController extends BaseController {
    
    public function generer() {
        $modelHealth = new UserHealthInfoModel();
        $user = session()->get('user');

        if (! $user || empty($user['id'])) {
            return view('test', [
                'infos' => [],
                'recommandations' => []
            ]);
        }

        $info = $modelHealth
            ->where('id_user', $user['id'])
            ->orderBy('date_info', 'desc')
            ->first();
        
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