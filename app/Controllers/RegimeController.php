<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\UserHealthInfoModel;

class RegimeController extends BaseController {
    public function form() {
        return view('back-office/regime-form');
    }

    public function create()
    {
        $model = new RegimeModel();

        // $photo = $this->request->getFile('photo');
        // $nomPhoto = null;

        // if ($photo && $photo->isValid()) {
        //     $nomPhoto = $photo->getRandomName();
        //     $photo->move('uploads/regimes', $nomPhoto);
        // }

        $data = [

            'label' => $this->request->getPost('label'),
            // 'photo' => $nomPhoto
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
            'variation_poids_journalier' => $this->request->getPost('variation_poids_journalier'),
        ];

        if (!$model->save($data)) {

            return view('back-office/regime/form', [
                'validation' => $model->validator
            ]);
        }

        return redirect()->to('/back-office/dashboard');
    }
}