<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\MvtPortemonnaieModel;

class WalletController extends BaseController
{
    public function redeem()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Utilisateur non connecte.',
            ]);
        }

        $data = $this->request->getJSON(true);
        if (! is_array($data)) {
            $data = $this->request->getPost();
        }

        $code = strtoupper(trim((string) ($data['code'] ?? '')));
        if ($code === '') {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Code requis.',
            ]);
        }

        $result = $this->applyCode((int) $user['id'], $code);

        if (! $result['ok']) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => $result['message'],
            ]);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => $result['message'],
            'balance' => $result['balance'],
            'movement' => $result['movement'],
        ]);
    }

    private function applyCode(int $userId, string $code): array
    {
        $db = \Config\Database::connect();
        $codeModel = new CodeModel();
        $mvtModel = new MvtPortemonnaieModel();

        $db->transStart();

        $row = $codeModel->where('code', $code)->first();
        if (! $row) {
            $db->transComplete();
            return ['ok' => false, 'message' => 'Code invalide.'];
        }

        if ((int) $row['statut'] !== 0) {
            $db->transComplete();
            return ['ok' => false, 'message' => 'Ce code est deja utilise ou invalide.'];
        }

        $updated = $codeModel->update($row['id'], ['statut' => 1]);
        if (! $updated) {
            $db->transComplete();
            return ['ok' => false, 'message' => 'Impossible de valider le code.'];
        }

        $now = date('Y-m-d H:i:s');
        $mvtModel->insert([
            'id_user' => $userId,
            'montant' => (float) $row['valeur'],
            'type_mvt' => 'credit',
            'date_mvt' => $now,
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return ['ok' => false, 'message' => 'Erreur lors de la validation du code.'];
        }

        return [
            'ok' => true,
            'message' => 'Code valide. Porte-monnaie credite.',
            'balance' => $this->getBalance($userId),
            'movement' => [
                'code' => $code,
                'amount' => (float) $row['valeur'],
                'date' => date('d/m/Y'),
            ],
        ];
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
