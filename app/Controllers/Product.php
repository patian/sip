<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    protected $helpers = [];

	public function __construct()
    {
        helper(['form']);
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        //
        if($this->base_cek_login() == FALSE)
        {
            session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
            return redirect()->to('/auth/login');
        }

        $category   = $this->request->getGet('category');
        $keyword    = $this->request->getGet('keyword');

        $data['category']   = $category;
        $data['keyword']    = $keyword;

        $categories = $this->categoryModel->where('category_status', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');

        $where      = [];
        $like       = [];
        $or_like    = [];

        if (!empty($category))
        {
            $where = ['products.fk_category_id' => $category];
        }

        if (!empty($keyword))
        {
            $like       = ['products.product_name'  => $keyword];
            $or_like    = ['products.product_sku'  => $keyword, 'products.product_description'  => $keyword];
        }

        $paginate   = 2;
        $data['products']   = $this->productModel->join('categories', 'categories.category_id = products.fk_category_id')->where($where)->like($like)->orLike($or_like)->paginate($paginate, 'product');
        $data['pager']      = $this->productModel->pager;

        echo view('pages/product/index', $data);
        
    }

    public function create()
    {
        $categories = $this->categoryModel->where('category_status', 'Active')->findAll();

        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');

        return view('pages/product/create', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $image  = $this->request->getFile('product_image');

        $name   = $image->getRandomName();

        $data = array(
            'fk_category_id'        => $this->request->getPost('category_id'),
            'product_name'          => $this->request->getPost('product_name'),
            'product_price_base'    => $this->request->getPost('product_price_base'),
            'product_price_sell'    => $this->request->getPost('product_price_sell'),
            'product_sku'           => $this->request->getPost('product_sku'),
            'product_stok'          => $this->request->getPost('product_stok'),
            'product_status'        => $this->request->getPost('product_status'),
            'product_image'         => $name,
            'product_description'   => $this->request->getPost('product_description'),
        );

        if ($validation->run($data, 'product') == false)
        {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('product/create'));
        }
        else
        {
            $image->move(ROOTPATH . 'public/uploads', $name);

            $simpan = $this->productModel->insertProduct($data);
            if ($simpan)
            {
                session()->setFlashdata('success', 'Product created successfully');
				return redirect()->to(base_url('product')); 
            }
        }
    }
}
