<?php

namespace App\Controllers;

use App\Models\CodeModel;

class CodeController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CodeModel();
    }

    /**
     * Afficher la liste de tous les codes
     */
    public function index()
    {
        $codes = $this->model->findAll();
        
        return view('back-office/code-list', [
            'codes' => $codes
        ]);
    }

    /**
     * Afficher le formulaire de création/édition
     */
    public function form($id = null)
    {
        $code = null;
        
        if ($id) {
            $code = $this->model->find($id);
            if (!$code) {
                return redirect()->to('/back-office/codes')
                    ->with('error', 'Code non trouvé');
            }
        }

        return view('back-office/code-form', [
            'code' => $code,
            'validation' => null
        ]);
    }

    /**
     * Créer un nouveau code
     */
    public function create()
    {
        $data = [
            'code' => $this->request->getPost('code'),
            'valeur' => $this->request->getPost('valeur'),
            'statut' => $this->request->getPost('statut'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/code-form', [
                'code' => null,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/codes')
            ->with('success', 'Code créé avec succès');
    }

    /**
     * Mettre à jour un code
     */
    public function update($id)
    {
        $code = $this->model->find($id);
        if (!$code) {
            return redirect()->to('/back-office/codes')
                ->with('error', 'Code non trouvé');
        }

        $data = [
            'id' => $id,
            'code' => $this->request->getPost('code'),
            'valeur' => $this->request->getPost('valeur'),
            'statut' => $this->request->getPost('statut'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/code-form', [
                'code' => $code,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/codes')
            ->with('success', 'Code mis à jour avec succès');
    }

    /**
     * Supprimer un code
     */
    public function delete($id)
    {
        $code = $this->model->find($id);
        if (!$code) {
            return redirect()->to('/back-office/codes')
                ->with('error', 'Code non trouvé');
        }

        $this->model->delete($id);

        return redirect()->to('/back-office/codes')
            ->with('success', 'Code supprimé avec succès');
    }
}
