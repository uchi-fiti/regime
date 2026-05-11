<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table = 'sport';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'label',
        'description',
        'calories_par_heure',
    ];

    protected $validationRules = [
        'label' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Le libellé est obligatoire',
                'min_length' => 'Minimum 3 caractères'
            ]
        ],
        'description' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'La description est obligatoire',
                'min_length' => 'Minimum 5 caractères'
            ]
        ],
        'calories_par_heure' => [
            'rules' => 'required|numeric|greater_than[0]',
            'errors' => [
                'required' => 'Les calories par heure sont obligatoires',
                'numeric' => 'Doit être un nombre',
                'greater_than' => 'Doit être supérieur à 0'
            ]
        ]
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
}
