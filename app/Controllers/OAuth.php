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
            return redirect()->to('/auth/login');
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
                    return redirect()->to('/auth/login');
                }
            }
            else
            {
                session()->setFlashdata('errors', ['' => 'Username tidak terdaftar']);
                return redirect()->to('/auth/login');
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

    public function proses_register()
    {
        $validation = \Config\Services::validation();

        $data = [
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password'),
        ];

        if ($validation->run($data, 'authregister') == false)
        {
            session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('inputs', $this->request->getPost());
            return redirect()->to('/auth/register');
        }
        else
        {
            $datalagi = [
                'email'     => $this->request->getPost('email'),
                'name'      => $this->request->getPost('name'),
                'username'  => $this->request->getPost('username'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status'    => "Active",
                'level'     => "Admin",
            ];

            $simpan = $this->authModel->register($datalagi);

            if ($simpan)
            {
                session()->setFlashdata('success_register', 'Register Successfully');
                return redirect()->to('/auth/login');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
