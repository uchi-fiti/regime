<?php

namespace App\Controllers;
use App\Models\UserModel;

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

        return redirect()->to('/back-office/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('back-office/login');
    }
   
}
