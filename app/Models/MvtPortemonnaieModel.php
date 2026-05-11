<?php

namespace App\Models;

use CodeIgniter\Model;

class MvtPortemonnaieModel extends Model
{
    protected $table = 'mvt_portemonnaie';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user',
        'montant',
        'type_mvt',
        'date_mvt',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
}
