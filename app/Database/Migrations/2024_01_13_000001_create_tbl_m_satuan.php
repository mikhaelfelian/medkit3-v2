<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblMSatuan extends Migration
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
            'satuanKecil' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'satuanBesar' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type'       => 'CHAR',
                'constraint' => 1,
                'default'    => '1',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_m_satuan', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_m_satuan');
    }
} 