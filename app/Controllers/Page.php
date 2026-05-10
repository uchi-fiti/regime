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
        $page = $this->request->getGet('page') ?? 'dashboard';
        
        // Validation pour éviter les injections
        $allowed = ['regimes', 'profil', 'gold', 'recommandation', 'dashboard', 'home'];
        $page = in_array($page, $allowed) ? $page : 'dashboard';
        
        // Si dashboard est demandé, charger les données du dashboard
        if ($page === 'dashboard') {
            $data = $this->getDashboardData();
            $realpage = 'back-office/dashboard';
            return view('model', array_merge(['page' => $realpage], $data));
        }
        
        // Déterminer le dossier approprié pour les autres pages
        $folder = 'front-office';
        $realpage = "{$folder}/{$page}";

        if ($page === 'profil') {
            $user = session()->get('user');
            if (! $user || empty($user['id'])) {
                return redirect()->to('/connection');
            }

            $data = $this->getProfileData((int) $user['id']);
            return view('model', array_merge(['page' => $realpage], $data));
        }

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

    /**
     * Récupère les données du dashboard
     */
    private function getDashboardData()
    {
        $data = [];
        $db = \Config\Database::connect();

        // 1. Statistiques des Objectifs Utilisateurs
        $objectifStats = $db->query("
            SELECT o.id, o.label, COUNT(uhi.id) as count 
            FROM objectif o 
            LEFT JOIN user_health_info uhi ON o.id = uhi.id_objectif 
            GROUP BY o.id, o.label
        ")->getResultArray();
        
        $data['objectif_labels'] = array_column($objectifStats, 'label');
        $data['objectif_counts'] = array_column($objectifStats, 'count');

        // 2. Performance Commerciale - Top 5 des régimes les plus souscrits
        $top5Regimes = $db->query("
            SELECT r.id, r.label, COUNT(ur.id) as subscriptions, SUM(ur.prix) as revenue
            FROM regime r 
            LEFT JOIN user_regime ur ON r.id = ur.id_regime 
            GROUP BY r.id, r.label
            ORDER BY subscriptions DESC
            LIMIT 5
        ")->getResultArray();
        
        $data['regime_labels'] = array_column($top5Regimes, 'label');
        $data['regime_subscriptions'] = array_column($top5Regimes, 'subscriptions');
        $data['regime_revenues'] = array_column($top5Regimes, 'revenue');

        // 3. État du Porte-monnaie et Codes
        $codeModel = new CodeModel();
        $totalCodes = $codeModel->countAll();
        $usedCodes = $codeModel->where('statut', 1)->countAllResults();
        $data['total_codes'] = $totalCodes;
        $data['used_codes'] = $usedCodes;
        $data['unused_codes'] = $totalCodes - $usedCodes;
        $data['code_percentage'] = $totalCodes > 0 ? round(($usedCodes / $totalCodes) * 100, 1) : 0;

        // Dernières validations de codes utilisés
        $lastCodesUsed = $db->query("
            SELECT c.code, c.valeur, c.statut, c.id as code_id,
                   'Admin' as nom
            FROM code c
            WHERE c.statut = 1
            ORDER BY c.id DESC
            LIMIT 5
        ")->getResultArray();
        $data['last_codes_used'] = $lastCodesUsed;

        // 4. Analyse de la Base Utilisateurs - Répartition par genre
        $usersByGender = $db->query("
            SELECT genre, COUNT(*) as count
            FROM user
            GROUP BY genre
        ")->getResultArray();
        
        $data['gender_labels'] = array_column($usersByGender, 'genre');
        $data['gender_counts'] = array_column($usersByGender, 'count');
        $totalUsers = array_sum($data['gender_counts']);
        $data['total_users'] = $totalUsers;
        $data['gender_percentages'] = array_map(fn($c) => round(($c / $totalUsers) * 100, 1), $data['gender_counts']);

        // Proportion d'utilisateurs avec Option Gold
        $goldCount = $db->query("
            SELECT COUNT(DISTINCT ua.id_user) as count
            FROM user_abonnement ua
            JOIN abonnement a ON ua.id_abonnement = a.id
            WHERE a.label = 'Pass Gold'
        ")->getRow()->count;
        
        $data['gold_users'] = $goldCount;
        $data['non_gold_users'] = $totalUsers - $goldCount;

        // 5. Suivi des Revenus (Tableau Croisé)
        $revenueData = $db->query("
            SELECT 
                r.label as regime_label,
                DATE_FORMAT(ur.date_commande, '%Y-%m') as mois,
                SUM(ur.prix * (1 - COALESCE(a.remise, 0) / 100)) as revenue
            FROM user_regime ur
            JOIN regime r ON ur.id_regime = r.id
            LEFT JOIN user_abonnement ua ON ur.id_user_health_info IN (
                SELECT id FROM user_health_info WHERE id_user IN (
                    SELECT id FROM user
                )
            )
            LEFT JOIN abonnement a ON ua.id_abonnement = a.id
            WHERE ur.date_commande IS NOT NULL
            GROUP BY r.label, DATE_FORMAT(ur.date_commande, '%Y-%m')
            ORDER BY mois DESC, r.label
        ")->getResultArray();
        
        $data['revenue_data'] = $revenueData;
        
        // Préparer les données pour le tableau croisé
        $months = [];
        $regimes = [];
        $crosstabData = [];
        
        foreach ($revenueData as $row) {
            if (!in_array($row['mois'], $months)) $months[] = $row['mois'];
            if (!in_array($row['regime_label'], $regimes)) $regimes[] = $row['regime_label'];
        }
        
        foreach ($regimes as $regime) {
            $crosstabData[$regime] = [];
            foreach ($months as $month) {
                $revenue = 0;
                foreach ($revenueData as $row) {
                    if ($row['regime_label'] === $regime && $row['mois'] === $month) {
                        $revenue = $row['revenue'];
                        break;
                    }
                }
                $crosstabData[$regime][$month] = $revenue;
            }
        }
        
        $data['months'] = $months;
        $data['regimes_list'] = $regimes;
        $data['crosstab_data'] = $crosstabData;

        return $data;
    }

}