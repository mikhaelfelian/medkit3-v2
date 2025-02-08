<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * MedTrans Model
 * 
 * This model handles database operations for medical record transactions
 */

namespace App\Models;

use CodeIgniter\Model;

class MedTransModel extends Model
{
    protected $table            = 'tbl_trans_medrecs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user', 'id_dokter', 'id_nurse', 'id_analis', 'id_farmasi',
        'id_pasien', 'id_instansi', 'id_poli', 'id_dft', 'id_ant',
        'id_kasir', 'id_icd', 'id_encounter', 'id_condition', 'id_post_location',
        'created_at', 'updated_at', 'tgl_masuk', 'tgl_keluar',
        'no_rm', 'no_akun', 'no_nota', 'dokter', 'dokter_nik',
        'poli', 'pasien', 'pasien_alamat', 'pasien_nik', 'keluhan',
        'ttv', 'ttv_st', 'ttv_bb', 'ttv_tb', 'ttv_td',
        'ttv_sistole', 'ttv_diastole', 'ttv_nadi', 'ttv_laju', 'ttv_saturasi',
        'ttv_skala', 'ttd_obat', 'diagnosa', 'anamnesa', 'pemeriksaan',
        'program', 'alergi', 'metode', 'platform',
        'jml_total', 'jml_ongkir', 'jml_dp', 'jml_diskon', 'diskon',
        'jml_potongan', 'jml_potongan_poin', 'jml_subtotal', 'jml_ppn', 'ppn',
        'jml_gtotal', 'jml_bayar', 'jml_kembali', 'jml_kurang',
        'jml_poin', 'jml_poin_nom', 'tipe', 'tipe_bayar',
        'status', 'status_bayar', 'status_nota', 'status_hps',
        'status_pos', 'status_periksa', 'status_resep', 'sp'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
} 