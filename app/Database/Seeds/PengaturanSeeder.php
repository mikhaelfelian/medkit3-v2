<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'judul'            => 'MEDKIT 3',
            'judul_app'        => 'MEDKIT 3',
            'alamat'           => 'Jl. Example No. 123',
            'deskripsi'        => 'Sistem Informasi Apotek',
            'kota'             => 'Jakarta',
            'url'              => 'http://localhost/medkit3-v2',
            'theme'            => 'admin-lte-3',
            'pagination_limit' => 10,
            'favicon'          => 'favicon.ico',
            'logo'            => 'logo.png',
            'logo_header'     => 'logo_header.png',
            'apt_apa'         => 'APA123456',
            'apt_sipa'        => 'SIPA123456',
            'ppn'             => 11,
        ];

        $this->db->table('tbl_pengaturan')->insert($data);
    }
} 