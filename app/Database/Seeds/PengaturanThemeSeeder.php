<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengaturanThemeSeeder extends Seeder
{
    public function run()
    {
        // Get the first pengaturan id
        $pengaturan = $this->db->table('tbl_pengaturan')->get()->getRow();
        
        if ($pengaturan) {
            $data = [
                'id_pengaturan' => $pengaturan->id,
                'nama'          => 'AdminLTE 3',
                'path'          => 'admin-lte-3',
                'status'        => 1,
            ];

            $this->db->table('tbl_pengaturan_theme')->insert($data);
        }
    }
} 