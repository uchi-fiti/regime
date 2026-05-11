<?php

namespace App\Models;

use CodeIgniter\Model;

class TableImcModel extends Model
{
    protected $table = 'table_imc';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'valeur_debut',
        'valeur_fin',
        'label',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
}
