<?php

namespace App\Controllers;

use App\Models\SportModel;

class SportController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SportModel();
    }

    /**
     * Afficher la liste de tous les sports
     */
    public function index()
    {
        $sports = $this->model->findAll();
        
        return view('back-office/sport-list', [
            'sports' => $sports
        ]);
    }

    /**
     * Afficher le formulaire de création/édition
     */
    public function form($id = null)
    {
        $sport = null;
        
        if ($id) {
            $sport = $this->model->find($id);
            if (!$sport) {
                return redirect()->to('/back-office/sports')
                    ->with('error', 'Sport non trouvé');
            }
        }

        return view('back-office/sport-form', [
            'sport' => $sport,
            'validation' => null
        ]);
    }

    /**
     * Créer un nouveau sport
     */
    public function create()
    {
        $data = [
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/sport-form', [
                'sport' => null,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/sports')
            ->with('success', 'Sport créé avec succès');
    }

    /**
     * Mettre à jour un sport
     */
    public function update($id)
    {
        $sport = $this->model->find($id);
        if (!$sport) {
            return redirect()->to('/back-office/sports')
                ->with('error', 'Sport non trouvé');
        }

        $data = [
            'id' => $id,
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description'),
            'calories_par_heure' => $this->request->getPost('calories_par_heure'),
        ];

        if (!$this->model->save($data)) {
            return view('back-office/sport-form', [
                'sport' => $sport,
                'validation' => $this->model->errors()
            ]);
        }

        return redirect()->to('/back-office/sports')
            ->with('success', 'Sport mis à jour avec succès');
    }

    /**
     * Supprimer un sport
     */
    public function delete($id)
    {
        $sport = $this->model->find($id);
        if (!$sport) {
            return redirect()->to('/back-office/sports')
                ->with('error', 'Sport non trouvé');
        }

        $this->model->delete($id);

        return redirect()->to('/back-office/sports')
            ->with('success', 'Sport supprimé avec succès');
    }
}
