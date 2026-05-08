<?php

namespace App\Models;

use CodeIgniter\Model;

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
}
