<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    
    public $authlogin = [
        'email'     => 'required|valid_email',
        'password'  => 'required',
    ];

    public $authlogin_errors = [
        'email'     => [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Email tidak valid',
        ],
        'password'  => [
            'required'      => 'Password wajib diisi',
        ],
    ];

    public $authregister = [
        'email'             => 'required|valid_email|is_unique[users.email]',
        'username'          => 'required|alpha_numeric|is_unique[users.username]|min_length[8]|max_length[35]',
        'name'              => 'required|alpha_numeric_space|min_length[3]|max_length[35]',
        'password'          => 'required|string|min_length[8]|max_length[35]',
        'confirm_password'  => 'required|string|matches[password]|min_length[8]|max_length[35]',
    ];

    public $authregister_errors = [
		'email'=> [
			'required'      => 'Email wajib diisi',
			'valid_email'   => 'Email tidak valid',
			'is_unique'     => 'Email sudah terdaftar'
		],
		'username'=> [
			'required'      => 'Username wajib diisi',
			'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
			'is_unique'     => 'Username sudah terdaftar',
			'min_length'    => 'Username minimal 3 karakter',
			'max_length'    => 'Username maksimal 35 karakter'
		],
		'name'=> [
			'required'              => 'Name wajib diisi',
			'alpha_numeric_spaces'  => 'Name hanya boleh berisi huruf, angka dan spasi',
			'min_length'            => 'Name minimal 3 karakter',
			'max_length'            => 'Name maksimal 35 karakter'
		],
		'password'=> [
			'required'      => 'Password wajib diisi',
			'string'        => 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'min_length'    => 'Password minimal 8 karakter',
			'max_length'    => 'Password maksimal 35 karakter'
		],
		'confirm_password'=> [
			'required'      => 'Konfirmasi password wajib diisi',
			'string'        => 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'matches'       => 'Konfirmasi password tidak sama dengan password',
			'min_length'    => 'Konfirmasi password minimal 8 karakter',
			'max_length'    => 'Konfirmasi password maksimal 35 karakter'
		]
	];

    public $category = [
        'category_name'     => 'required',
        'category_status'   => 'required',
    ];

    public $category_errors = [
        'category_name'     => [
            'required'  => 'Nama kategori wajib diisi',
        ],
        'category_status'   => [
            'required'  => 'Status kategori wajib diisi',
        ],
    ];

    public $product = [
        'fk_category_id'           => 'required',
		'product_name'          => 'required',
		'product_price_base'    => 'required',
        'product_price_sell'    => 'required',
		'product_sku'           => 'required',
        'product_stok'          => 'required',
		'product_status'        => 'required',
		'product_image'         => 'uploaded[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,1000]',
		'product_description'   => 'required'
    ];

    public $product_errors = [
		'fk_category_id'   => [
			'required'  => 'Nama category wajib diisi.',
		],
		'product_name'  => [
			'required'  => 'Nama product wajib diisi.'
		],
		'product_price_base' => [
			'required'  => 'Harga modal product wajib diisi.'
		],
        'product_price_sell' => [
			'required'  => 'Harga jual product wajib diisi.'
		],
		'product_sku'   => [
			'required'  => 'Kode product wajib diisi.'
		],
        'product_stok'   => [
			'required'  => 'Stok product wajib diisi.'
		],
		'product_status'=> [
			'required'  => 'Status product wajib diisi.'
		],
		'product_image'=> [
			'mime_in'   => 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
			'max_size'  => 'Gambar product maksimal 1mb',
			'uploaded'  => 'Gambar product wajib diisi'
		],
		'product_description'   => [
			'required'          => 'Description product wajib diisi.'
		]
	];
}
