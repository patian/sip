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
                'type'          => 'status',
                'default'       => 'Active',
            ],
            'level'     => [
                'type'          => 'level',
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
