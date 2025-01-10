<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMKategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'    => "ENUM('0','1')",
                'default' => '0',
            ]
        ]);
        
        // Add Primary Key
        $this->forge->addPrimaryKey('id');
        
        // Create Table
        $this->forge->createTable('tbl_m_kategori', true);
    }

    public function down()
    {
        // Drop Table
        $this->forge->dropTable('tbl_m_kategori', true);
    }
} 