<?php

namespace App\Controllers;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        dd(session()->get('user'));
        return view('back-office/dashboard.php');

    }
}