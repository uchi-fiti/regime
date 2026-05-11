<?php

namespace App\Controllers;

use App\Models\PrixRegimeModel;
use App\Models\RegimeModel;

class PrixRegimeController extends BaseController
{
    protected $model;
    protected $regimeModel;

    public function __construct()
    {
        $this->model = new PrixRegimeModel();
        $this->regimeModel = new RegimeModel();
    }

    /**
     * Afficher la liste de tous les prix régimes
     */
    public function index()
    {
        $prixRegimes = $this->model->findAll();
        
        // Enrichir avec les labels des régimes
        foreach ($prixRegimes as &$prix) {
            $regime = $this->regimeModel->find($prix['id_regime']);
            $prix['regime_label'] = $regime ? $regime['label'] : 'N/A';
        }
        
        return view('back-office/prix-regime-list', [
            'prixRegimes' => $prixRegimes
        ]);
    }

    /**
     * Afficher le formulaire de création/édition
     */
    public function form($id = null)
    {
        $prixRegime = null;
        
        if ($id) {
            $prixRegime = $this->model->find($id);
            if (!$prixRegime) {
                return redirect()->to('/back-office/prix-regimes')
                    ->with('error', 'Prix régime non trouvé');
            }
        }

        $regimes = $this->regimeModel->findAll();

        return view('back-office/prix-regime-form', [
            'prixRegime' => $prixRegime,
            'regimes' => $regimes,
            'validation' => null
        ]);
    }

    /**
     * Créer un nouveau prix régime
     */
    public function create()
    {
        $data = [
            'id_regime' => $this->request->getPost('id_regime'),
            'jour_debut' => $this->request->getPost('jour_debut'),
            'jour_fin' => $this->request->getPost('jour_fin'),
            'prix_journalier' => $this->request->getPost('prix_journalier'),
        ];

        if (!$this->model->save($data)) {
            $regimes = $this->regimeModel->findAll();
            return view('back-office/prix-regime-form', [
                'prixRegime' => null,
                'regimes' => $regimes,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/prix-regimes')
            ->with('success', 'Prix régime créé avec succès');
    }

    /**
     * Mettre à jour un prix régime
     */
    public function update($id)
    {
        $prixRegime = $this->model->find($id);
        if (!$prixRegime) {
            return redirect()->to('/back-office/prix-regimes')
                ->with('error', 'Prix régime non trouvé');
        }

        $data = [
            'id' => $id,
            'id_regime' => $this->request->getPost('id_regime'),
            'jour_debut' => $this->request->getPost('jour_debut'),
            'jour_fin' => $this->request->getPost('jour_fin'),
            'prix_journalier' => $this->request->getPost('prix_journalier'),
        ];

        if (!$this->model->save($data)) {
            $regimes = $this->regimeModel->findAll();
            return view('back-office/prix-regime-form', [
                'prixRegime' => $prixRegime,
                'regimes' => $regimes,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/prix-regimes')
            ->with('success', 'Prix régime mis à jour avec succès');
    }

    /**
     * Supprimer un prix régime
     */
    public function delete($id)
    {
        $prixRegime = $this->model->find($id);
        if (!$prixRegime) {
            return redirect()->to('/back-office/prix-regimes')
                ->with('error', 'Prix régime non trouvé');
        }

        $this->model->delete($id);

        return redirect()->to('/back-office/prix-regimes')
            ->with('success', 'Prix régime supprimé avec succès');
    }
}
