<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\UserHealthInfoModel;

class RecommandationController extends BaseController {
    
    public function generer() {
        $modelHealth = new UserHealthInfoModel();
        $user = session()->get('user');

        if (! $user || empty($user['id'])) {
            return view('front-office/recommandation', [
                'infos' => [],
                'recommandations' => [],
                'sports' => []
            ]);
        }

        $info = $modelHealth
            ->where('id_user', $user['id'])
            ->orderBy('date_info', 'desc')
            ->first();
        
        if (!$info) {
            return view('front-office/recommandation', [
                'infos' => [],
                'recommandations' => [],
                'sports' => []
            ]);
        }

        $infos = [
            'id_user' => $info['id_user'],
            'poids' => $info['poids'],
            'valeur_objectif' => $info['valeur_objectif']
        ];

        $recommandations = $modelHealth->genererRecommandations($infos);
        $sports = $modelHealth->genererRecommandationsSports($infos);
        
        return view('front-office/recommandation', [
            'infos' => [$info],
            'recommandations' => $recommandations,
            'sports' => $sports
        ]);
    }
}