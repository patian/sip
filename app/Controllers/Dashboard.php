<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->base_cek_login();
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
    {
        //
        if($this->base_cek_login() == FALSE){
            session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
            return redirect()->to('/auth/login');
        }

        $data['total_transaction']  = "";
        $data['total_product']      = "";
        $data['total_category']     = $this->dashboardModel->getCountCategory();
        $data['total_user']         = $this->dashboardModel->getCountUser();
        $data['latest_trx']         = "{}";

        
        echo view('pages/dash/dashboard', $data);
    }
}
