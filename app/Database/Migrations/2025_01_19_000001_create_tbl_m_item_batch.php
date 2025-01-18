<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-19
 * 
 * Migration for tbl_m_item_batch
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMItemBatch extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'          => false,
            ],
            'id_gudang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => 1,
            ],
            'id_pembelian' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => null
            ],
            'id_pembelian_det' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => null
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'tgl_terima' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'tgl_ed' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true
            ],
            'kode_batch' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true
            ],
            'item' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
                'null'       => true
            ],
            'jml' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'jml_keluar' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'jml_sisa' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1'],
                'null'       => true,
                'default'    => '1'
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('id_item', 'tbl_m_item', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_gudang', 'tbl_m_gudang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_m_item_batch');
        
        $this->db->query("ALTER TABLE `tbl_m_item_batch` COMMENT 'Table untuk menyimpan item batch'");
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_item_batch');
    }
} 