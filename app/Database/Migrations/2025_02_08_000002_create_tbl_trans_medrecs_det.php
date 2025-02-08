<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * Migration for tbl_trans_medrecs_det
 */
class CreateTblTransMedrecsDet extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_medrecs' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0
            ],
            'id_resep' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_resep_det' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_resep_det_rc' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_lab' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_lab_kat' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_rad' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_mcu' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'id_item' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_item_kat' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_item_sat' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_perawat' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_analis' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_radiografer' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'tgl_simpan' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'tgl_modif' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'tgl_masuk' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'tgl_baca' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'item' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'jml' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_resep' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_satuan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'file_rad' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],
            'resep' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],
            'kesan_rad' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],
            'hasil_rad' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],
            'hasil_lab' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'dosis' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'dosis_ket' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'disk1' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'disk2' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'disk3' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'diskon' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'potongan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'potongan_poin' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '0=null\r\n1=obat\r\n2=lab\r\n3=tindakan\r\n4=radiologi'
            ],
            'status_ctk' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_hsl' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_hsl_lab' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_hsl_rad' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_baca' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0',
                'comment' => '0=belum;\r\n1=sudah;'
            ],
            'status_post' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0',
                'comment' => '0=pend\r\n1=posted\r\n2=canceled'
            ],
            'status_remun' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
            'status_pj' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0',
                'comment' => 'Status Penjamin (UMUM, BPJS, dll)\r\n0=tidak\r\n1=ya'
            ],
            'status_rc' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
            'status_rf' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_pkt' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'sp' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_medrecs', 'tbl_trans_medrecs', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('tbl_trans_medrecs_det', true, [
            'COMMENT' => 'Table untuk menyimpan detail transaksi medical records'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_trans_medrecs_det');
    }
} 