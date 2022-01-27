<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        //
        $this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'product_id'            => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'fk_category_id'           => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
                'null'              => true,
            ],
            'product_name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'product_price_base'         => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'product_price_sell'         => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'product_stok'         => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'product_sku'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
            ],
            'product_status'        => [
                'type'              => 'status',
                'default'        => 'Active',
            ],
            'product_image'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'product_description'   => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
        ]);

        $this->forge->addKey('product_id', true);
        $this->forge->addForeignKey('fk_category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        //
        $this->forge->dropTable('products', true);
    }
}
