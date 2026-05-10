<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class Auth extends BaseController
{
    /**
     * Affiche la page d'inscription
     */
    public function inscription()
    {
        return view('front-office/inscription');
    }

    /**
     * Affiche la page de connexion
     */
    public function connection()
    {
        return view('front-office/connection');
    }

    /**
     * Affiche la page d'information sanitaire
     */
    public function information()
    {
        return view('front-office/information');
    }

    /**
     * Affiche la page de choix d'objectif
     */
    public function chooseObj()
    {
        $health = session()->get('user_health') ?? [];

        return view('front-office/choose_obj', [
            'imcAdjective' => $health['adjective'] ?? 'Corpulence normale',
            'imcValue' => $health['imc'] ?? 24.2,
            'weight' => $health['weight'] ?? 70,
            'height' => $health['height'] ?? 170,
        ]);
    }

    /**
     * Valide un champ a la fois (AJAX)
     */
    public function validerChamp()
    {
        // if (! $this->request->isAJAX()) {
        //     return $this->response->setStatusCode(400)->setJSON([
        //         'status' => 'error',
        //         'message' => 'Requete invalide.',
        //     ]);
        // }

        $data = $this->getRequestPayload();
        $field = $data['field'] ?? '';
        $value = $data['value'] ?? null;

        if ($field === 'confirm_password') {
            $password = (string) ($data['password'] ?? '');
            $confirmPassword = (string) ($data['confirm_password'] ?? '');

            if (! $this->passwordsMatch($password, $confirmPassword)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Les mots de passe ne correspondent pas.',
                ]);
            }

            return $this->response->setJSON([
                'status' => 'ok',
                'message' => 'Valide',
            ]);
        }

        $model = new UserModel();
        $rules = $model->getValidationRules();
        $messages = $model->getValidationMessages();

        if (! isset($rules[$field])) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Champ invalide.',
            ]);
        }

        $validation = Services::validation();
        $validation->setRules([
            $field => $rules[$field],
        ], [
            $field => $messages[$field] ?? [],
        ]);

        if (! $validation->run([$field => $value])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $validation->getError($field) ?? 'Champ invalide.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Valide',
        ]);
    }

    /**
     * Traite l'inscription et insere l'utilisateur (AJAX)
     */
    public function traiteInscription()
    {
        $data = $this->getRequestPayload();
        $userData = [
            'nom' => trim((string) ($data['nom'] ?? '')),
            'mail' => trim((string) ($data['mail'] ?? '')),
            'genre' => (string) ($data['genre'] ?? ''),
            'mdp' => (string) ($data['mdp'] ?? ''),
        ];
        $confirmPassword = (string) ($data['confirm_password'] ?? '');

        $model = new UserModel();

        if (! $model->validate($userData)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $model->errors(),
            ]);
        }

        if (! $this->passwordsMatch($userData['mdp'], $confirmPassword)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => [
                    'confirm_password' => 'Les mots de passe ne correspondent pas.',
                ],
            ]);
        }

        $insertData = [
            'nom' => $userData['nom'],
            'mail' => $userData['mail'],
            'genre' => $userData['genre'],
            'mdp' => password_hash($userData['mdp'], PASSWORD_DEFAULT),
            'role' => 'user',
        ];

        $userId = $model->insert($insertData);
        if (! $userId) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Impossible de creer le compte.',
            ]);
        }

        session()->set([
            'user' => [
                'id' => $userId,
                'nom' => $insertData['nom'],
                'mail' => $insertData['mail'],
                'genre' => $insertData['genre'],
                'role' => $insertData['role'],
            ],
        ]);

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Compte cree avec succes.',
            'redirect' => site_url('information'),
        ]);
    }

    private function passwordsMatch(string $password, string $confirmPassword): bool
    {
        return $password !== '' && $password === $confirmPassword;
    }

    private function getRequestPayload(): array
    {
        $json = $this->request->getJSON(true);
        if (is_array($json)) {
            return $json;
        }

        return $this->request->getPost();
    }

   
}
