<?php

namespace App\Controllers\LandingPage;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        $date['title'] = "Home";

        return view('landing_page/home');
    }
}
