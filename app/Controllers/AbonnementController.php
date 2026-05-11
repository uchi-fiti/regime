<?php

namespace App\Controllers;

use App\Models\AbonnementModel;
use App\Models\UserAbonnementModel;
use App\Models\MvtPortemonnaieModel;

class AbonnementController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return redirect()->to('/connection');
        }

        $aboId = (int) $this->request->getGet('abonnement');
        if ($aboId <= 0) {
            return redirect()->to(site_url('model?page=gold'));
        }

        $aboModel = new AbonnementModel();
        $abonnement = $aboModel->find($aboId);
        if (! $abonnement) {
            return redirect()->to(site_url('model?page=gold'));
        }

        return view('front-office/confirmation_abonnement', [
            'abonnement' => $abonnement,
        ]);
    }

    public function confirmer()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return redirect()->to('/connection');
        }

        $aboId = (int) $this->request->getPost('abonnement_id');
        if ($aboId <= 0) {
            return redirect()->to(site_url('model?page=gold'));
        }

        $aboModel = new AbonnementModel();
        $abonnement = $aboModel->find($aboId);
        if (! $abonnement) {
            return redirect()->to(site_url('model?page=gold'));
        }

        $balance = $this->getBalance((int) $user['id']);
        $prix = (float) $abonnement['prix'];
        if ($balance < $prix) {
            return view('front-office/confirmation_abonnement', [
                'abonnement' => $abonnement,
                'error' => 'Solde insuffisant pour confirmer cet abonnement.',
            ]);
        }

        $userAboModel = new UserAbonnementModel();
        $userAboModel->insert([
            'id_user' => (int) $user['id'],
            'id_abonnement' => $aboId,
            'date_achat' => date('Y-m-d H:i:s'),
        ]);

        $mvtModel = new MvtPortemonnaieModel();
        $mvtModel->insert([
            'id_user' => (int) $user['id'],
            'montant' => $prix,
            'type_mvt' => 'debit',
            'date_mvt' => date('Y-m-d H:i:s'),
        ]);

        return view('front-office/confirmation_abonnement', [
            'abonnement' => $abonnement,
            'success' => 'Abonnement confirme avec succes.',
        ]);
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
}
