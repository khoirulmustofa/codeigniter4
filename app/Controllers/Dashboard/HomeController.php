<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        try {
            $data['title'] = "Home";
            return view('dashboard/home', $data);
        } catch (\Exception $ex) {
        }
    }
}
