<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-18
 * 
 * Migration for tbl_m_icd
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMIcd extends Migration
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
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'default'    => null
            ],
            'icd' => [
                'type'       => 'TEXT',
                'null'       => true,
                'default'    => null
            ],
            'diagnosa_en' => [
                'type'       => 'TEXT',
                'null'       => true,
                'default'    => null
            ],
            'diagnosa_id' => [
                'type'       => 'TEXT',
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_m_icd');
        $this->db->query("ALTER TABLE `tbl_m_icd` COMMENT 'Untuk menyimpan data tentang ICD 10 (Daftar Penyakit) sesuai satu sehat'");
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_icd');
    }
} 