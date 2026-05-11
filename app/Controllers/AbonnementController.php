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
    }
}
