<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserHealthInfoModel;
use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\CodeModel;
use App\Models\UserAbonnementModel;
use App\Models\AbonnementModel;
use App\Models\PrixRegimeModel;
use App\Models\SportModel;

class BackOfficeController extends BaseController
{
    public function form()
    {
        return view('back-office/connection');
    }

    public function login()
    {
        $model = new UserModel();

        $nom = $this->request->getPost('nom');
        $mdp = $this->request->getPost('password');

        $user = $model->where('nom', $nom)->first();
        if (!$user || $mdp !== $user['mdp']) {
            return redirect()->to('/back-office/connection')
                ->with('error', 'Nom d\'utilisateur ou mot de passe incorrect');
        }

        session()->set('user', [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'role' => $user['role'],
        ]);

        return redirect()->to('/back-office/model_back');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/back-office/connection');
    }
   
    public function model()
    {
        $page = $this->request->getGet('page') ?? 'dashboard';
        
        // Validation pour éviter les injections
        $allowed = ['regime', 'prix-regime', 'sport', 'abonnement', 'code'];
        $page = in_array($page, $allowed) ? $page : 'dashboard';
        
        // Si dashboard est demandé, charger les données du dashboard
        if ($page === 'dashboard') {
            $data = $this->getDashboardData();
            $data['page'] = 'back-office/dashboard';
            return view('model_back', $data);
        }
        
        // Charger les données selon la page demandée
        $data = ['page' => 'back-office/' . $page];
        
        switch($page) {
            case 'regime':
                $regimeModel = new RegimeModel();
                $data['regimes'] = $regimeModel->findAll();
                $data['regime'] = null;
                break;
            case 'prix-regime':
                $prixRegimeModel = new PrixRegimeModel();
                $regimeModel = new RegimeModel();
                $data['prixRegimes'] = $prixRegimeModel->findAll();
                $data['prixRegime'] = null;
                $data['regimes'] = $regimeModel->findAll();
                break;
            case 'sport':
                $sportModel = new SportModel();
                $data['sports'] = $sportModel->findAll();
                $data['sport'] = null;
                break;
            case 'abonnement':
                $abonnementModel = new AbonnementModel();
                $data['abonnements'] = $abonnementModel->findAll();
                $data['abonnement'] = null;
                break;
            case 'code':
                $codeModel = new CodeModel();
                $data['codes'] = $codeModel->findAll();
                $data['code'] = null;
                break;
        }
        
        return view('model_back', $data);
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
