<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\RegimeModel;
use App\Models\SportModel;

class UserHealthInfoModel extends Model
{
    protected $table = 'user_health_info';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user',
        'taille',
        'poids',
        'id_objectif',
        'valeur_objectif',
        'date_info',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    public function genererRecommandations(array $infos) {
        // perdre du poids 
        $objectif = (float)$infos['valeur_objectif'];
        $signe = ($objectif < 0) ? '-' : '+';

        $regimeModel = new RegimeModel();
        $regimes = $regimeModel->findTypeRegime($signe);
        
        $recos = [];
        foreach ($regimes as $r) {
            $duree = $regimeModel->calcDureeRegime($r, $objectif);
            $prix = $regimeModel->calcPrixRegime($r['id'], $duree, $infos['id_user']);
            
            $recos[] = [
                'id_regime' => $r['id'],
                'label'     => $r['label'],
                'duree'     => $duree,
                'prix'      => $prix
            ];
        }
        return $recos;
    }

    public function genererRecommandationsSports(array $infos) {
        $objectif = (float)$infos['valeur_objectif'];
        $valeur = $objectif - $infos['poids'];
        $signe = ($valeur < 0) ? '-' : '+';

        $sportModel = new SportModel();
        if ($signe === '-') {
            $sports = $sportModel->where('variation_poids_journalier <', 0)->findAll();
        } else {
            $sports = $sportModel->where('variation_poids_journalier >', 0)->findAll();
        }

        $recos = [];
        foreach ($sports as $sport) {
            $variation = (float) $sport['variation_poids_journalier'];
            $duree = $variation !== 0.0 ? (int) ceil(abs($valeur) / abs($variation)) : 0;

            $recos[] = [
                'id_sport' => $sport['id'],
                'label' => $sport['label'],
                'variation' => $variation,
                'duree' => $duree,
            ];
        }

        return $recos;
    }

    public function test(){
        $infos = $this->findAll();
        return $infos[0].genererRecommandations();
    }
}
