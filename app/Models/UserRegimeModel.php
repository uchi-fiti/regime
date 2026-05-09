<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRegimeModel extends Model
{
    protected $table = 'user_regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user_health_info',
        'id_regime',
        'id_sport',
        'date_commande',
        'duree',
        'prix',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'prix' => 'float',
        'duree' => 'integer',
    ];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    public function getWithDetails($id)
    {
        return $this->select('user_regime.*, regime.label as regime_label, sport.label as sport_label')
            ->join('regime', 'regime.id = user_regime.id_regime')
            ->join('sport', 'sport.id = user_regime.id_sport')
            ->find($id);
    }

}