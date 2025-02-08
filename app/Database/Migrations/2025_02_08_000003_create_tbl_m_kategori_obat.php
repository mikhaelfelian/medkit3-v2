<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * Migration for tbl_m_kategori_obat
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMKategoriObat extends Migration
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
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1'],
                'default'    => '1',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_m_kategori_obat', true, [
            'COMMENT' => 'Table untuk menyimpan jenis obat. Cth : Obat batuk, Obat Ngelu, Obat Sarap'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_kategori_obat');
    }
} 