<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\RegimeModel;

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
            $prix = $regimeModel->calcPrixRegime($r['id'], $duree);
            
            $recos[] = [
                'id_regime' => $r['id'],
                'label'     => $r['label'],
                'duree'     => $duree,
                'prix'      => $prix
            ];
        }
        return $recos;
    }

    public function test(){
        $infos = $this->findAll();
        return $infos[0].genererRecommandations();
    }
}
