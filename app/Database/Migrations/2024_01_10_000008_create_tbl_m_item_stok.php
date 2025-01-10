<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMItemStok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'          => false,
            ],
            'id_satuan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_gudang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => 1,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => 1,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'jml' => [
                'type'       => 'FLOAT',
                'null'       => true,
                'default'    => 0,
            ],
            'status' => [
                'type'       => "ENUM('0','1','2')",
                'null'       => true,
                'default'    => '0',
            ],
        ]);
        
        $this->forge->addKey('id', true);
        
        // Add foreign keys
        $this->forge->addForeignKey('id_item', 'tbl_m_item', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_gudang', 'tbl_m_gudang', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('tbl_m_item_stok');
    }

    public function down()
    {
        $this->forge->dropForeignKey('tbl_m_item_stok', 'tbl_m_item_stok_id_item_foreign');
        $this->forge->dropForeignKey('tbl_m_item_stok', 'tbl_m_item_stok_id_gudang_foreign');
        $this->forge->dropTable('tbl_m_item_stok');
    }
} 