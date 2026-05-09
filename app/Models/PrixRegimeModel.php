<?php

namespace App\Models;

use CodeIgniter\Model;

class PrixRegimeModel extends Model
{
    protected $table = 'prix_regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_regime',
        'jour_debut',
        'jour_fin',
        'prix_journalier',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    public function getByRegime($id_regime){
        return $this->where('id_regime', $id_regime)->findAll();
    }
}
