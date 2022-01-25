<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            'username'  => 'Admin',
            'name'      => 'Santo',
            'email'     => 'admin@example.com',
            'password'  => '$2y$10$sOKww3LkoNzBtuW5SKxcJOVcY5eN3L1UsTMZpzgWLDd5MfiZ2mmNe',
            'status'    => 'Active',
            'level'     => 'Admin',
        ];
        
        $this->db->table('users')->insert($data);
    }
}
