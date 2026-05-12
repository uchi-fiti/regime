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
        $fromSignup = (bool) session()->get('from_signup');
        return view('front-office/information', [
            'fromSignup' => $fromSignup,
        ]);
    }

    /**
     * Affiche la page de choix d'objectif
     */
    public function chooseObj()
    {
        $health = session()->get('user_health') ?? [];
        $fromSignup = (bool) session()->get('from_signup');
        session()->remove('from_signup');

        $imcValue = $health['imc'] ?? 24.2;
        $height = $health['height'] ?? 170;

        return view('front-office/choose_obj', [
            'imcAdjective' => $health['adjective'] ?? 'Corpulence normale',
            'imcValue' => $imcValue,
            'weight' => $health['weight'] ?? 70,
            'height' => $height,
            'recommendedWeight' => $health['recommended_weight'] ?? $this->calculateRecommendedWeight($imcValue, $height),
            'fromSignup' => $fromSignup,
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

    public function verifierEmail()
    {
        $data = $this->getRequestPayload();
        $email = trim((string) ($data['email'] ?? ''));

        if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Email invalide.',
            ]);
        }

        $model = new UserModel();
        $user = $model->where('mail', $email)->first();
        if (! $user) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Email introuvable.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Email valide.',
        ]);
    }

    public function login()
    {
        $data = $this->getRequestPayload();
        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');

        if ($email === '' || $password === '') {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Email et mot de passe requis.',
            ]);
        }

        $user = $this->attemptLogin($email, $password);
        if (! $user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Email ou mot de passe incorrect.',
            ]);
        }

        session()->set([
            'user' => [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'mail' => $user['mail'],
                'genre' => $user['genre'],
                'role' => $user['role'],
            ],
        ]);

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Connexion reussie.',
            'redirect' => site_url('model?page=home'),
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
            'mdp' => $userData['mdp'],
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
        session()->set('from_signup', true);

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

    private function calculateRecommendedWeight(float $imc, float $heightCm): float
    {
        $heightM = $heightCm / 100;
        if ($heightM <= 0.0) {
            return 0.0;
        }

        $idealImc = $imc;
        if ($idealImc < 18.0) {
            $idealImc = 18.0;
        } elseif ($idealImc > 25.0) {
            $idealImc = 25.0;
        }

        return round($idealImc * ($heightM * $heightM), 1);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function attemptLogin(string $email, string $password): ?array
    {
        $model = new UserModel();
        $user = $model->where('mail', $email)->first();
        if (! $user) {
            return null;
        }

        if ($password !== $user['mdp']) {
            return null;
        }

        return $user;
    }

   
}
