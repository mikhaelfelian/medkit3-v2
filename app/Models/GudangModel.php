<?php

namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
    protected $table            = 'tbl_m_gudang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'gudang', 'keterangan', 'status', 'status_gd', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'gudang'     => 'required|max_length[160]',
        'kode'       => 'permit_empty|max_length[160]',
        'status'     => 'permit_empty|in_list[0,1]',
        'status_gd'  => 'permit_empty|in_list[0,1]',
    ];

    /**
     * Generate unique kode for gudang
     * Format: GDG-001, GDG-002, etc
     */
    public function generateKode()
    {
        $prefix = 'GDG-';
        $lastKode = $this->select('kode')
                        ->like('kode', $prefix, 'after')
                        ->orderBy('kode', 'DESC')
                        ->first();

        if (!$lastKode) {
            return $prefix . '001';
        }

        $lastNumber = (int) substr($lastKode->kode, strlen($prefix));
        $newNumber = $lastNumber + 1;
        
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
} 