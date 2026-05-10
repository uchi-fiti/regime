<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PrixRegimeModel;
use App\Models\UserAbonnement;


class RegimeModel extends Model
{
    protected $table = 'regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'label',
        'photo',
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
        'variation_poids_journalier',
    ];

    protected $validationRules = [
        'label' => [
            'rules' => 'required|min_length[4]',
        ],
        'pourcentage_viande' => [
            'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        ],

        'pourcentage_poisson' => [
            'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        ],

        'pourcentage_volaille' => [
            'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        ],

        'variation_poids_journalier' => [
            'rules' => 'required|decimal',
        ],
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    public function findTypeRegime($signe) {
        if ($signe === '-') {
            return $this->where('variation_poids_journalier <', 0)
                        ->findAll();
        } else {
            return $this->where('variation_poids_journalier >', 0)
                        ->findAll();
        }
    }

    public function calcDureeRegime($regime, $objectif) {
        $variation = abs($regime['variation_poids_journalier']);
        if ($variation == 0) return 0;
        
        return ceil(abs($objectif) / $variation);
    }

    public function calcPrixRegime($idRegime, $duree, $idUser){
        $ppr = new PrixRegimeModel();
        $plage = $ppr->where('id_regime', $idRegime)
                    ->where('jour_debut <=', $duree)
                    ->where('jour_fin >=', $duree)
                    ->first();
        if(!$plage) {
            $plage = $ppr->where('id_regime', $idRegime)
            ->orderBy("jour_fin", "DESC")
            ->first();
        }
        $userAbo = new UserAbonnementModel();
        $abonnements = $userAbo->getAboByUser($idUser);
        $remise = 1;
        if ($abonnements) {
            foreach ($abonnements as $abo) {
                $remise *= (1 - $abo['remise']);
            }
        }

        if ($plage) {
            return $plage['prix_journalier'] * $duree * $remise;
        }
        return 0;
    }
}

