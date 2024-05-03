<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LogoutController extends BaseController
{
    public function index()
    {
        $url = "/";

        auth()->logout();
        return redirect()->to($url)->with('message', lang('Auth.successLogout'));
        
    }
}
