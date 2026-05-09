<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PrixRegimeModel;

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

    public function calcPrixRegime($idRegime, $duree){
        $ppr = new PrixRegimeModel();
        $plage = $ppr->where('id_regime', $idRegime)
                    ->where('jour_debut <=', $duree)
                    ->where('jour_fin >=', $duree)
                    ->first();
        
        if ($plage) {
            return $plage['prix_journalier'] * $duree;
        }
        return 0;
    }
}

