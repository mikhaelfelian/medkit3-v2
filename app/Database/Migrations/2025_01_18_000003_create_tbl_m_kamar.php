<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-18
 * 
 * Migration for tbl_m_kamar
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMKamar extends Migration
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
                'null'    => true
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null
            ],
            'kamar' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null
            ],
            'jml' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'jml_max' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'null'       => true,
                'default'    => '0'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_m_kamar');
        $this->db->query("ALTER TABLE `tbl_m_kamar` COMMENT 'Untuk menyimpan data kamar/ruangan'");
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_kamar');
    }
} 