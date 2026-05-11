<?php

namespace App\Controllers;

use App\Models\AbonnementModel;

class AbonnementController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AbonnementModel();
    }

    /**
     * Afficher la liste de tous les abonnements
     */
    public function index()
    {
        $abonnements = $this->model->findAll();
        
        return view('back-office/abonnement-list', [
            'abonnements' => $abonnements
        ]);
    }

    /**
     * Afficher le formulaire de création/édition
     */
    public function form($id = null)
    {
        $abonnement = null;
        
        if ($id) {
            $abonnement = $this->model->find($id);
            if (!$abonnement) {
                return redirect()->to('/back-office/abonnements')
                    ->with('error', 'Abonnement non trouvé');
            }
        }

        return view('back-office/abonnement-form', [
            'abonnement' => $abonnement,
            'validation' => null
        ]);
    }

    /**
     * Créer un nouveau abonnement
     */
    public function create()
    {
        $data = [
            'label' => $this->request->getPost('label'),
            'prix' => $this->request->getPost('prix'),
            'remise' => $this->request->getPost('remise'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/abonnement-form', [
                'abonnement' => null,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/abonnements')
            ->with('success', 'Abonnement créé avec succès');
    }

    /**
     * Mettre à jour un abonnement
     */
    public function update($id)
    {
        $abonnement = $this->model->find($id);
        if (!$abonnement) {
            return redirect()->to('/back-office/abonnements')
                ->with('error', 'Abonnement non trouvé');
        }

        $data = [
            'id' => $id,
            'label' => $this->request->getPost('label'),
            'prix' => $this->request->getPost('prix'),
            'remise' => $this->request->getPost('remise'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/abonnement-form', [
                'abonnement' => $abonnement,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/abonnements')
            ->with('success', 'Abonnement mis à jour avec succès');
    }

    /**
     * Supprimer un abonnement
     */
    public function delete($id)
    {
        $abonnement = $this->model->find($id);
        if (!$abonnement) {
            return redirect()->to('/back-office/abonnements')
                ->with('error', 'Abonnement non trouvé');
        }

        $this->model->delete($id);

        return redirect()->to('/back-office/abonnements')
            ->with('success', 'Abonnement supprimé avec succès');
      
use App\Models\UserAbonnementModel;
use App\Models\MvtPortemonnaieModel;


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
