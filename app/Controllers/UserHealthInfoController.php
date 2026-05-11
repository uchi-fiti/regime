<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\TableImcModel;
use App\Models\UserHealthInfoModel;

class UserHealthInfoController extends BaseController
{
    public function submitHealthInfo()
    {
        $data = $this->getRequestPayload();
        $height = isset($data['height']) ? (float) $data['height'] : 0.0;
        $weight = isset($data['weight']) ? (float) $data['weight'] : 0.0;

        // Convertir la taille de mètres en centimètres si nécessaire
        if ($height > 0 && $height < 10) {
            $height = $height * 100;
        }

        $errors = $this->validateHealthInputs($height, $weight);
        if ($errors !== []) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'errors' => $errors,
            ]);
        }

        $imc = $this->calculateImc($height, $weight);
        $adjective = $this->getImcAdjective($imc);
        $recommendedWeight = $this->calculateRecommendedWeight($imc, $height);

        session()->set([
            'user_health' => [
                'height' => $height,
                'weight' => $weight,
                'imc' => $imc,
                'adjective' => $adjective,
                'recommended_weight' => $recommendedWeight,
            ],
        ]);

        return $this->response->setJSON([
            'status' => 'ok',
            'redirect' => site_url('choose-obj'),
        ]);
    }

    public function storeObjective()
    {
        $data = $this->getRequestPayload();
        $objectiveLabel = trim((string) ($data['objective_label'] ?? ''));
        $objectiveKey = trim((string) ($data['objective_key'] ?? ''));
        $targetValue = isset($data['target_value']) ? (float) $data['target_value'] : 0.0;

        $user = session()->get('user');
        if (! $user || empty($user['id'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Utilisateur non connecte.',
            ]);
        }

        $health = session()->get('user_health') ?? [];
        $height = $health['height'] ?? null;
        $weight = $health['weight'] ?? null;

        $errors = [];
        if ($height === null || $weight === null) {
            $errors['health'] = 'Informations sante manquantes.';
        }
        
        // Validation stricte seulement pour l'objectif "maintain"
        if ($objectiveKey === 'maintain' && ($targetValue < 20 || $targetValue > 300)) {
            $errors['target_value'] = 'Veuillez entrer une valeur valide (20-300 kg).';
        } elseif ($objectiveKey !== 'maintain' && $targetValue <= 0) {
            $errors['target_value'] = 'Veuillez entrer une valeur positive.';
        }

        $objectiveId = $this->resolveObjectiveId($objectiveLabel, $objectiveKey);
        if ($objectiveId <= 0) {
            $errors['objective'] = 'Objectif invalide.';
        }

        if ($errors !== []) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'errors' => $errors,
            ]);
        }

        $model = new UserHealthInfoModel();
        $objectiveDelta = (float) $targetValue - $weight;
        $insertData = [
            'id_user' => (int) $user['id'],
            'taille' => (float) $height,
            'poids' => (float) $weight,
            'id_objectif' => $objectiveId,
            'valeur_objectif' => $objectiveDelta,
            'date_info' => date('Y-m-d'),
        ];

        if (! $model->insert($insertData)) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Impossible d\'enregistrer vos informations.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'redirect' => site_url('recommandation'),
        ]);
    }

    private function calculateImc(float $heightCm, float $weightKg): float
    {
        $heightM = $heightCm / 100;
        if ($heightM <= 0.0) {
            return 0.0;
        }

        return $weightKg / ($heightM * $heightM);
    }

    private function getImcAdjective(float $imc): string
    {
        $model = new TableImcModel();
        $row = $model
            ->where('valeur_debut <=', $imc)
            ->where('valeur_fin >=', $imc)
            ->orderBy('valeur_debut', 'desc')
            ->first();

        if (is_array($row) && isset($row['label'])) {
            return (string) $row['label'];
        }

        return 'Corpulence normale';
    }

    private function resolveObjectiveId(string $objectiveLabel, string $objectiveKey): int
    {
        $labelMap = [
            'gain' => 'Augmenter son poids',
            'loss' => 'Réduire son poids',
            'maintain' => 'Atteindre son IMC idéal',
        ];

        $label = $labelMap[$objectiveKey] ?? $objectiveLabel;

        if ($label === '') {
            return 0;
        }

        $model = new ObjectifModel();
        $row = $model->where('label', $label)->first();

        if (is_array($row) && isset($row['id'])) {
            return (int) $row['id'];
        }

        return 0;
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

    private function validateHealthInputs(float $height, float $weight): array
    {
        $errors = [];

        if ($height < 100 || $height > 250) {
            $errors['height'] = 'Veuillez entrer une taille valide (100-250 cm).';
        }

        if ($weight < 20 || $weight > 300) {
            $errors['weight'] = 'Veuillez entrer un poids valide (20-300 kg).';
        }

        return $errors;
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
