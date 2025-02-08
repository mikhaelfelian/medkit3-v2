<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-06
 * 
 * Migration for tbl_pendaftaran
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPendaftaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'id_gelar' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_pasien' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_poli' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_platform' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_dokter' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_pekerjaan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_ant' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'id_instansi' => [
                'type'       => 'INT',
                'constraint' => 11,
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
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tgl_masuk' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'tgl_keluar' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'no_urut' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'no_antrian' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'nama_pgl' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'tmp_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'tgl_lahir' => [
                'type'    => 'DATE',
                'null'    => true,
            ],
            'jns_klm' => [
                'type'       => 'ENUM',
                'constraint' => ['L','P'],
                'default'    => 'L',
            ],
            'kontak' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'kontak_rmh' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alamat_dom' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alamat_domisili' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'rt' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'null'       => true,
                'default'    => null,
            ],
            'rw' => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'null'       => true,
                'default'    => null,
            ],
            'kelurahan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null,
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null,
            ],
            'instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => 160,
                'null'       => true,
            ],
            'instansi_alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alergi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'file_base64' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'file_base64_id' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'tipe_bayar' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
                'comment'    => '0 = tidak ada;\r\n1 = UMUM;\r\n2 = ASURANSI;\r\n3 = BPJS;',
            ],
            'tipe_rawat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'tipe' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['1','2'],
                'default'    => '1',
            ],
            'status_akt' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1','2'],
                'default'    => '1',
                'comment'    => '0=pend\r\n1=konfirm\r\n2=selesai',
            ],
            'status_hdr' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1'],
                'default'    => '1',
            ],
            'status_gc' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1'],
                'default'    => '0',
            ],
            'status_dft' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1','2'],
                'default'    => '1',
                'comment'    => '0=pend\r\n1=Offline\r\n2=Online',
            ],
            'status_hps' => [
                'type'       => 'ENUM',
                'constraint' => ['0','1','2'],
                'default'    => '0',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_pendaftaran', true, [
            'COMMENT' => 'Table untuk menyimpan data pendaftaran pasien'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pendaftaran');
    }
} 