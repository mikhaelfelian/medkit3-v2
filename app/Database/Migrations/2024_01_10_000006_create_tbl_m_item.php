<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMItem extends Migration
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
            'id_satuan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_kategori' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_kategori_lab' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_kategori_gol' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_lokasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_merk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 65,
                'null'       => true,
                'comment'    => 'Kode Item',
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 65,
                'null'       => true,
            ],
            'item' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
                'comment'    => 'Nama Item',
            ],
            'item_alias' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'Nama Alias Obat',
            ],
            'item_kand' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'Nama Kandungan Obat',
            ],
            'jml' => [
                'type'       => 'FLOAT',
                'null'       => true,
                'comment'    => 'Jumlah Stok',
            ],
            'jml_limit' => [
                'type'       => 'FLOAT',
                'null'       => true,
                'default'    => 0,
                'comment'    => 'Jumlah Limit untuk warning',
            ],
            'jml_min' => [
                'type'       => 'FLOAT',
                'null'       => true,
                'default'    => 0,
                'comment'    => 'Jumlah Minimum',
            ],
            'harga_beli' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'harga_jual' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'remun_tipe' => [
                'type'       => "ENUM('0','1','2')",
                'null'       => true,
                'default'    => '0',
            ],
            'remun_perc' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'default'    => 0.00,
            ],
            'remun_nom' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'default'    => 0.00,
            ],
            'apres_tipe' => [
                'type'       => "ENUM('0','1','2')",
                'null'       => true,
                'default'    => '0',
            ],
            'apres_perc' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'default'    => 0.00,
            ],
            'apres_nom' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'unsigned'   => true,
                'null'       => true,
                'default'    => 0.00,
            ],
            'status' => [
                'type'       => "ENUM('0','1')",
                'null'       => true,
                'default'    => '0',
                'comment'    => 'Status item aktif / tidak',
            ],
            'status_stok' => [
                'type'       => "ENUM('0','1')",
                'null'       => true,
                'default'    => '0',
                'comment'    => 'Status Stok, mengurangi stok / tidak',
            ],
            'status_racikan' => [
                'type'       => "ENUM('0','1')",
                'null'       => true,
                'default'    => '0',
                'comment'    => 'Status Obat Racikan',
            ],
            'status_hps' => [
                'type'       => "ENUM('0','1')",
                'null'       => true,
                'default'    => '0',
                'comment'    => 'Status Item terhapus (soft deleted)',
            ],
            'status_item' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
                'comment'    => '1=obat;2=tindakan;3=lab;4=radiologi;5=bhp;',
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_m_item', true);

        $this->db->query("ALTER TABLE tbl_m_item COMMENT = 'Table untuk menyimpan semua item'");
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_item');
    }
} 