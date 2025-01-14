<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-13
 * 
 * Migration for creating the tbl_m_item_ref_input table
 */
class CreateTblMItemRefInput extends Migration
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
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'item_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_value_l1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_value_l2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_value_p1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_value_p2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'item_satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);
        
        // Add foreign key with proper unsigned attribute
        $this->forge->addForeignKey('id_item', 'tbl_m_item', 'id', 'CASCADE', 'CASCADE', 'fk_item_ref_input_item');
        
        // Create table with proper charset
        $attributes = ['ENGINE' => 'InnoDB', 'CHARACTER SET' => 'latin1', 'COLLATE' => 'latin1_swedish_ci'];
        $this->forge->createTable('tbl_m_item_ref_input', true, $attributes);
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('tbl_m_item_ref_input', 'fk_item_ref_input_item');
        
        // Then drop the table
        $this->forge->dropTable('tbl_m_item_ref_input', true);
    }
} 