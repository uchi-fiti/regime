<?php

namespace App\Controllers;

use App\Models\RegimeModel;

class RegimeController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new RegimeModel();
    }

    /**
     * Afficher la liste de tous les régimes
     */
    public function index()
    {
        $regimes = $this->model->findAll();
        
        return view('back-office/regime-list', [
            'regimes' => $regimes
        ]);
    }

    /**
     * Afficher le formulaire d'création/édition
     */
    public function form($id = null)
    {
        $regime = null;
        
        if ($id) {
            $regime = $this->model->find($id);
            if (!$regime) {
                return redirect()->to('/back-office/regimes')
                    ->with('error', 'Régime non trouvé');
            }
        }

        return view('back-office/regime-form', [
            'regime' => $regime,
            'validation' => null
        ]);
    }

    /**
     * Créer un nouveau régime
     */
    public function create()
    {
        $data = [
            'label' => $this->request->getPost('label'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
            'variation_poids_journalier' => $this->request->getPost('variation_poids_journalier'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/regime-form', [
                'regime' => null,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/regimes')
            ->with('success', 'Régime créé avec succès');
    }

    /**
     * Mettre à jour un régime
     */
    public function update($id)
    {
        $regime = $this->model->find($id);
        if (!$regime) {
            return redirect()->to('/back-office/regimes')
                ->with('error', 'Régime non trouvé');
        }

        $data = [
            'id' => $id,
            'label' => $this->request->getPost('label'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
            'variation_poids_journalier' => $this->request->getPost('variation_poids_journalier'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/regime-form', [
                'regime' => $regime,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/regimes')
            ->with('success', 'Régime mis à jour avec succès');
    }

    /**
     * Supprimer un régime
     */
    public function delete($id)
    {
        $regime = $this->model->find($id);
        if (!$regime) {
            return redirect()->to('/back-office/regimes')
                ->with('error', 'Régime non trouvé');
        }

        $this->model->delete($id);

        return redirect()->to('/back-office/regimes')
            ->with('success', 'Régime supprimé avec succès');
    }
}