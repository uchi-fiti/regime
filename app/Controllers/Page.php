<?php

namespace App\Controllers;
use App\Models\UserHealthInfoModel;
use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\CodeModel;
use App\Models\UserAbonnementModel;
use App\Models\AbonnementModel;
use App\Models\MvtPortemonnaieModel;

class Page extends BaseController
{
    /**
     * Affiche le modèle/template avec navigation dynamique
     */
    public function model()
    {
        $page = $this->request->getGet('page') ?? 'home';
        
        // Validation pour éviter les injections
        $allowed = ['regimes', 'profil', 'gold','recommandation'];
        $page = in_array($page, $allowed) ? $page : 'home';
        $realpage = "front-office/{$page}";
        
        return view('model', ['page' => $realpage]);
    }

    private function getProfileData(int $userId): array
    {
        $healthModel = new UserHealthInfoModel();
        $objectifModel = new ObjectifModel();
        $aboModel = new UserAbonnementModel();

        $healthInfo = $healthModel
            ->where('id_user', $userId)
            ->orderBy('date_info', 'desc')
            ->first();

        $objectifLabel = null;
        $taille = null;
        $poids = null;
        $valeurObjectif = null;
        $imc = null;

        if (! empty($healthInfo)) {
            $taille = (float) $healthInfo['taille'];
            $poids = (float) $healthInfo['poids'];
            $valeurObjectif = (float) $healthInfo['valeur_objectif'];
            $imc = $this->calcImc($poids, $taille);

            $objectif = $objectifModel->find($healthInfo['id_objectif']);
            $objectifLabel = $objectif['label'] ?? null;
        }

        $abonnement = $aboModel
            ->select('abonnement.label, abonnement.prix, abonnement.remise, user_abonnement.date_achat')
            ->join('abonnement', 'abonnement.id = user_abonnement.id_abonnement')
            ->where('user_abonnement.id_user', $userId)
            ->orderBy('user_abonnement.date_achat', 'desc')
            ->first();

        return [
            'balance' => $this->getBalance($userId),
            'health_info' => $healthInfo,
            'objectif_label' => $objectifLabel,
            'taille' => $taille,
            'poids' => $poids,
            'valeur_objectif' => $valeurObjectif,
            'imc' => $imc,
            'abonnement' => $abonnement,
            'programme_actif' => $this->getActiveProgramme($userId),
        ];
    }

    private function getBalance(int $userId): float
    {
        $model = new MvtPortemonnaieModel();

        $credits = (float) ($model->selectSum('montant')
            ->where('id_user', $userId)
            ->where('type_mvt', 'credit')
            ->get()
            ->getRow()
            ->montant ?? 0);

        $debits = (float) ($model->selectSum('montant')
            ->where('id_user', $userId)
            ->where('type_mvt', 'debit')
            ->get()
            ->getRow()
            ->montant ?? 0);

        return $credits - $debits;
    }

    private function calcImc(float $poids, float $taille): ?float
    {
        if ($taille <= 0) {
            return null;
        }

        $tailleMetres = $taille / 100;
        return $poids / ($tailleMetres * $tailleMetres);
    }

    private function getActiveProgramme(int $userId): ?array
    {
        $db = \Config\Database::connect();

        $row = $db->query(
            "SELECT ur.id, ur.date_commande, ur.duree, ur.prix,
                    r.label AS regime_label,
                    s.label AS sport_label
             FROM user_regime ur
             JOIN user_health_info uhi ON uhi.id = ur.id_user_health_info
             JOIN regime r ON r.id = ur.id_regime
             LEFT JOIN sport s ON s.id = ur.id_sport
             WHERE uhi.id_user = ?
             ORDER BY ur.date_commande DESC, ur.id DESC
             LIMIT 1",
            [$userId]
        )->getRowArray();

        return $row ?: null;
    }

   

}