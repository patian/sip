<?php

namespace App\Controllers;

use App\Models\AuthModel;

class OAuth extends BaseController
{

    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        $this->base_cek_login();
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        //return view('welcome_message');
        if ($this->base_cek_login() == true)
        {
            return redirect()->to('/dashboard');
        }

        echo view('pages/auth/login');
    }

    public function proses_login()
    {
        $validation = \Config\Services::validation();

        $email  = $this->request->getPost('email');
        $pass   = $this->request->getPost('password');

        $data   = [
            'email'     => $email,
            'password'  => $pass,
        ];

        if ($validation->run($data, 'authlogin') == false)
        {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to('/pages/auth/login');
        }
        else
        {
            $cek_login = $this->authModel->cek_login($email);

            if ($cek_login == true)
            {
                if (password_verify($pass, $cek_login['password']))
                {
                    session()->set('email', $cek_login['email']);
                    session()->set('name', $cek_login['name']);
                    session()->set('level', $cek_login['level']);
                    session()->set('status', $cek_login['status']);

                    return redirect()->to('/dashboard');
                }
                else
                {
                    session()->setFlashdata('errors', ['' => 'Username atau Password yang masukkan salah']);
                    return redirect()->to('/pages/auth/login');
                }
            }
            else
            {
                session()->setFlashdata('errors', ['' => 'Username tidak terdaftar']);
                return redirect()->to('/pages/auth/login');
            }
        }
    }

    public function register()
    {
        //return view('welcome_message');
        if ($this->base_cek_login() == true)
        {
            return redirect()->to('/dashboard');
        }

        echo view('pages/auth/register');
    }
}
