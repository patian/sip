<?php

namespace App\Controllers;

use App\Models\AuthModel;

class OAuth extends BaseController
{

    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        $this->baseCekLogin();
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        //return view('welcome_message');
        if ($this->baseCekLogin() == true)
        {
            return redirect()->to('/dashboard');
        }

        echo view('auth/login');
    }

    public function register()
    {
        //return view('welcome_message');
        if ($this->baseCekLogin() == true)
        {
            return redirect()->to('/dashboard');
        }

        echo view('auth/register');
    }
}
