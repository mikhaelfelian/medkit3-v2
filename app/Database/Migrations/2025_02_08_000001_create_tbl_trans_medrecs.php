<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * Migration for tbl_trans_medrecs
 */
class CreateTblTransMedrecs extends Migration
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
            'id_nurse' => [
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
            'id_farmasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_instansi' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_poli' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_dft' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => 'ID yang diambil dari tbl_pendaftaran kolom id'
            ],
            'id_ant' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_kasir' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_icd' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'id_encounter' => [
                'type' => 'TEXT',
                'null' => true,
                'default' => null
            ],
            'id_condition' => [
                'type' => 'TEXT',
                'null' => true,
                'default' => null
            ],
            'id_post_location' => [
                'type' => 'TEXT',
                'null' => true,
                'default' => null
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'tgl_masuk' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'tgl_keluar' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'no_rm' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'no_akun' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'no_nota' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'dokter' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'dokter_nik' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'poli' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'pasien_alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'pasien_nik' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'keluhan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'ttv' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'ttv_st' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_bb' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_tb' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_td' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_sistole' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_diastole' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_nadi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_laju' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_saturasi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttv_skala' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'ttd_obat' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true
            ],
            'diagnosa' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'anamnesa' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'pemeriksaan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'program' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'alergi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'metode' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'platform' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0
            ],
            'jml_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_ongkir' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_dp' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_diskon' => [
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
            'jml_potongan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_potongan_poin' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_ppn' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'ppn' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_gtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_bayar' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_kembali' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_kurang' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_poin' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'jml_poin_nom' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0.00
            ],
            'tipe' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '2=rajal;3=ranap;'
            ],
            'tipe_bayar' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '0 = tidak ada;\r\n1 = UMUM;\r\n2 = ASURANSI;\r\n3 = BPJS;'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '1=anamnesa;\r\n2=tindakan;\r\n3=obat;\r\n4=laborat;\r\n5=dokter;\r\n6=pembayaran;\r\n7=finish'
            ],
            'status_bayar' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '0=belum;\r\n1=lunas;\r\n2=kurang;'
            ],
            'status_nota' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 0,
                'comment' => '0=pend;\r\n1=proses;\r\n2=finish;\r\n3=batal'
            ],
            'status_hps' => [
                'type' => 'ENUM',
                'constraint' => ['0','1'],
                'default' => '0'
            ],
            'status_pos' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
            'status_periksa' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
            'status_resep' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0',
                'comment' => '1=Non-racikan\r\n2=Racikan'
            ],
            'sp' => [
                'type' => 'ENUM',
                'constraint' => ['0','1','2'],
                'default' => '0'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_trans_medrecs', true, [
            'COMMENT' => 'Table untuk menyimpan transaksi medical records'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_trans_medrecs');
    }
} 