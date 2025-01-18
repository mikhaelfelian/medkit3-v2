<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-19
 * 
 * Migration for tbl_m_item_hist
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_Create_tbl_m_item_hist extends Migration
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
                'null'           => true
            ],
            'id_satuan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_gudang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_supplier' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_penjualan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_pembelian' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_pembelian_det' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'id_so' => [
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
            'tgl_masuk' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'tgl_ed' => [
                'type'    => 'DATE',
                'null'    => true
            ],
            'no_nota' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],
            'kode_batch' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],
            'item' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],
            'keterangan' => [
                'type'       => 'LONGTEXT',
                'null'       => true
            ],
            'nominal' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'default'    => 0.00
            ],
            'jml' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'jml_satuan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 1
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['1','2','3','4','5','6','7','8'],
                'null'       => true,
                'comment'    => '1 = Stok Masuk Pembelian\r\n2 = Stok Masuk\r\n3 = Stok Masuk Retur Jual\r\n4 = Stok Keluar Penjualan\r\n5 = Stok Keluar Retur Beli\r\n6 = SO\r\n7 = Stok Keluar\r\n8 = Mutasi Antar Gd'
            ],
            'sp' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1'],
                'null'       => true,
                'default'    => '0'
            ]
        ]);

        $this->forge->addKey('id', true);
        
        // Add Foreign Keys
        $this->forge->addForeignKey('id_item', 'tbl_m_item', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_gudang', 'tbl_m_gudang', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('tbl_m_item_hist');
        
        $this->db->query("ALTER TABLE `tbl_m_item_hist` COMMENT 'Table untuk menyimpan item stok histories'");
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_item_hist');
    }
} 