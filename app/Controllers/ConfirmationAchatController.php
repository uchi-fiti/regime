<?php

namespace App\Controllers;

use App\Models\MvtPortemonnaieModel;
use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\UserHealthInfoModel;

class ConfirmationAchatController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return redirect()->to('/connection');
        }

        $regimeId = (int) $this->request->getGet('regime');
        $sportId = (int) $this->request->getGet('sport');

        if ($regimeId <= 0) {
            return redirect()->to('/recommandation');
        }

        $data = $this->buildViewData($user['id'], $regimeId, $sportId);
        if ($data === null) {
            return redirect()->to('/recommandation');
        }

        return view('front-office/confirmation_achat', $data);
    }

    public function confirmer()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return redirect()->to('/connection');
        }

        $regimeId = (int) $this->request->getPost('regime_id');
        $sportId = (int) $this->request->getPost('sport_id');

        $data = $this->buildViewData($user['id'], $regimeId, $sportId);
        if ($data === null) {
            return redirect()->to('/recommandation');
        }

        $balance = $data['balance'];
        $prix = $data['prix'];
        $isFirstPurchase = $data['isFirstPurchase'];

        if (! $isFirstPurchase && $balance < $prix) {
            $data['error'] = 'Solde insuffisant pour confirmer cet achat.';
            return view('front-office/confirmation_achat', $data);
        }

        $model = new MvtPortemonnaieModel();
        $now = date('Y-m-d H:i:s');

        if ($isFirstPurchase) {
            $model->insert([
                'id_user' => (int) $user['id'],
                'montant' => 0,
                'type_mvt' => 'credit',
                'date_mvt' => $now,
            ]);
            $model->insert([
                'id_user' => (int) $user['id'],
                'montant' => 0,
                'type_mvt' => 'debit',
                'date_mvt' => $now,
            ]);
        } else {
            $model->insert([
                'id_user' => (int) $user['id'],
                'montant' => $prix,
                'type_mvt' => 'debit',
                'date_mvt' => $now,
            ]);
        }

        $data = $this->buildViewData($user['id'], $regimeId, $sportId);
        if ($data === null) {
            return redirect()->to('/recommandation');
        }
        $data['success'] = 'Achat confirme avec succes.';

        return view('front-office/confirmation_achat', $data);
    }

    public function exportPdf()
    {
        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return redirect()->to('/connection');
        }

        $regimeId = (int) $this->request->getGet('regime');
        $sportId = (int) $this->request->getGet('sport');

        $data = $this->buildViewData($user['id'], $regimeId, $sportId);
        if ($data === null) {
            return redirect()->to('/recommandation');
        }

        $fpdfPath = APPPATH . 'ThirdParty/fpdf186/fpdf.php';
        if (! file_exists($fpdfPath)) {
            return $this->response->setStatusCode(500)->setBody('FPDF introuvable.');
        }

        require_once $fpdfPath;

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Confirmation achat regime', 0, 1);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Regime: ' . $data['regime']['label'], 0, 1);
        $pdf->Cell(0, 8, 'Duree: ' . $data['duree_jours'] . ' jours', 0, 1);
        $pdf->Cell(0, 8, 'Prix: ' . number_format($data['prix'], 0, ',', ' ') . ' Ar', 0, 1);
        $pdf->Ln(2);

        if (! empty($data['sport'])) {
            $pdf->Cell(0, 8, 'Sport: ' . $data['sport']['label'], 0, 1);
        }

        $pdf->Output('D', 'programme.pdf');
        return $this->response;
    }

    private function buildViewData(int $userId, int $regimeId, int $sportId): ?array
    {
        if ($regimeId <= 0) {
            return null;
        }

        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $healthModel = new UserHealthInfoModel();

        $regime = $regimeModel->find($regimeId);
        if (! $regime) {
            return null;
        }

        $sport = null;
        if ($sportId > 0) {
            $sport = $sportModel->find($sportId);
        }

        $info = $healthModel
            ->where('id_user', $userId)
            ->orderBy('date_info', 'desc')
            ->first();

        if (! $info) {
            return null;
        }

        $objectif = (float) $info['valeur_objectif'];
        $duree = $regimeModel->calcDureeRegime($regime, $objectif);
        $prix = $regimeModel->calcPrixRegime($regime['id'], $duree, $userId);

        $balance = $this->getBalance($userId);
        $isFirstPurchase = $this->isFirstPurchase($userId);

        return [
            'regime' => $regime,
            'sport' => $sport,
            'duree_jours' => $duree,
            'prix' => $prix,
            'balance' => $balance,
            'isFirstPurchase' => $isFirstPurchase,
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

    private function isFirstPurchase(int $userId): bool
    {
        $model = new MvtPortemonnaieModel();
        return $model->where('id_user', $userId)->countAllResults() === 0;
    }
}
