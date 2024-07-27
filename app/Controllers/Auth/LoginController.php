<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Validation\ValidationRules;

class LoginController extends BaseController
{
    public function loginView()
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }
        $data['title'] = "Login";

        return view('auth/login', $data);
    }

    public function loginAction()
    {
        $response['token'] = csrf_hash();
        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            // return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
              
            return $this->setRespon($response,false,$this->validator->listErrors());
        }

        /** @var array $credentials */
        $credentials             = $this->request->getPost(setting('Auth.validFields')) ?? [];
        $credentials             = array_filter($credentials);
        $credentials['password'] = $this->request->getPost('password');
        $remember                = (bool) $this->request->getPost('remember');

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Attempt to login
        $result = $authenticator->remember($remember)->attempt($credentials);
        if (!$result->isOK()) {
            return $this->setRespon($response,false,$result->reason());
            // return redirect()->route('login')->withInput()->with('error', $result->reason());
        }

        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
            // return redirect()->route('auth-action-show')->withCookies();
            return $this->setRespon($response,false,$result->reason());
        }

        // return redirect()->to(config('Auth')->loginRedirect())->withCookies();
        return $this->setRespon($response,true,$result->reason());
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, list<string>|string>>
     */
    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getLoginRules();
    }
}
