<?php

namespace App\Controllers;

use CodeIgniter\Shield\Controllers\LoginController as ShieldLogin;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends ShieldLogin
{
    public function loginAction(): RedirectResponse
    {
         
        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
        if (! $result->isOK()) {
            return redirect()->route('login_failure')->withInput()->with('error', $result->reason());
        }

        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show')->withCookies();
        }

        return redirect()->to(config('Auth')->loginRedirect())->withCookies();
    }
    public function loginFailure(){
         
        return view('login_failure');
        
    }
}