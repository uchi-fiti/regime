<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nom',
        'mail',
        'genre',
        'mdp',
        'role',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[100]',
        'mail' => 'required|valid_email|is_unique[user.mail]',
        'genre' => 'required|in_list[M,F,other]',
        'mdp' => 'required|min_length[8]|max_length[255]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire.',
            'min_length' => 'Le nom doit contenir au moins 2 caracteres.',
            'max_length' => 'Le nom ne doit pas depasser 100 caracteres.',
        ],
        'mail' => [
            'required' => 'L\'email est obligatoire.',
            'valid_email' => 'Veuillez saisir un email valide.',
            'is_unique' => 'Cet email est deja utilise.',
        ],
        'genre' => [
            'required' => 'Le genre est obligatoire.',
            'in_list' => 'Le genre selectionne est invalide.',
        ],
        'mdp' => [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caracteres.',
            'max_length' => 'Le mot de passe est trop long.',
        ],
    ];
}
