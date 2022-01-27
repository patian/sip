<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        //
        $data['categories'] = $this->categoryModel->getCategory();

        echo view('pages/category/index', $data);
    }

    public function create()
    {
        return view('pages/category/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );

        if ($validation->run($data, 'category') == false)
        {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
        }
        else
        {
            $simpan = $this->categoryModel->insertCategory($data);
            if ($simpan)
            {
                session()->setFlashdata('success', 'Category created successfully');
                return redirect()->to(base_url('category'));
            }
        }
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->getCategory($id)->getRowArray();

        echo view('pages/category/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('category_id');

        $validation = \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );

        if ($validation->run($data, 'category') == false)
        {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
        }
        else
        {
            $ubah = $this->categoryModel->updateCategory($data, $id);
            if ($ubah)
            {
                session()->setFlashdata('info', 'Category updated successfully');
				return redirect()->to(base_url('category'));
            }
        }
    }

    public function delete($id)
    {
        $data = array(
            'category_status'   => 'Deleted',
        );

        $hapus = $this->categoryModel->deleteCategory($data, $id);
        if ($hapus)
        {
            session()->setFlashdata('warning', 'Category has been successfully deleted');
            return redirect()->to(base_url('category'));
        }
    }
}
