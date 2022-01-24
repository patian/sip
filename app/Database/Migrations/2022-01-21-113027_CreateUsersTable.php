<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'        => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'username'  => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'name'      => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'email'     => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'password'  => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'status'    => [
                'type'          => 'ENUM',
                'constraint'    => "'Active','Inactive'",
                'default'       => 'Active',
            ],
            'level'     => [
                'type'          => 'ENUM',
                'constraint'    => "'Admin','User'",
                'default'       => 'Admin',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
        $this->forge->dropTable('users', true);
    }
}
