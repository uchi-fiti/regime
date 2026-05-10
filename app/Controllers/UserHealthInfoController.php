<?php

namespace App\Controllers;

use App\Models\TableImcModel;

class UserHealthInfoController extends BaseController
{
    public function submitHealthInfo()
    {
        $data = $this->getRequestPayload();
        $height = isset($data['height']) ? (float) $data['height'] : 0.0;
        $weight = isset($data['weight']) ? (float) $data['weight'] : 0.0;

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
