<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;
use App\Models\SportModel;
use App\Models\RegimeModel;


class Home extends BaseController
{
    public function index()
    {
        try {
            // Connect to database
            $db = Database::connect();

            // Simple test query
            $query = $db->query("SELECT 1 AS test");

            // Get result
            $result = $query->getRow();

            $sm = new SportModel();
            $rm = new RegimeModel();

            $sports = $sm->findAll();
            $regimes = $rm->findAll();
            return view('front-office/index', [
                'sports' => $sports,
                'regimes' => $regimes
            ]);

        } catch (\Throwable $e) {
            echo "Database connection failed!<br>";
            echo $e->getMessage();
        }
    }
}