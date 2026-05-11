<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAbonnementModel extends Model
{
    protected $table = 'user_abonnement';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user',
        'id_abonnement',
        'date_achat',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;

    public function getAboByUser($idUser) {
        return $this->select('label, prix, remise, date_achat')
                    ->join('abonnement', 'abonnement.id = user_abonnement.id_abonnement')
                    ->where('id_user', $idUser)
                    ->findAll();
    }

    // select label, prix, remise, date_achat from user_abonnement join abonnement on id abonnement where id_user = 1
}
