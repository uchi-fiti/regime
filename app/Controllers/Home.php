<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

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

            /*
            echo "Database connection successful!<br>";
            echo "Result: " . $result->test;
            */
            
            // Load the view
            return view('index');

        } catch (\Throwable $e) {
            echo "Database connection failed!<br>";
            echo $e->getMessage();
        }
    }
}