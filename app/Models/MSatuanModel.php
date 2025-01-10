<?php

namespace App\Models;

use CodeIgniter\Model;

class MSatuanModel extends Model
{
    protected $table            = 'tbl_m_satuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'satuanKecil',
        'satuanBesar',
        'jml',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'satuanKecil' => 'required|min_length[1]|max_length[100]',
        'jml'         => 'required|integer',
        'status'      => 'permit_empty|in_list[1,0]'
    ];
    protected $validationMessages = [
        'satuanKecil' => [
            'required'   => 'Satuan Kecil harus diisi',
            'min_length' => 'Satuan Kecil minimal 1 karakter',
            'max_length' => 'Satuan Kecil maksimal 100 karakter'
        ],
        'jml' => [
            'required' => 'Jumlah harus diisi',
            'integer'  => 'Jumlah harus berupa angka'
        ],
        'status' => [
            'in_list' => 'Status harus 1 atau 0'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Flag to allow empty inserts
     *
     * @var bool
     */
    protected bool $allowEmptyInserts = true;

    /**
     * Get total records with optional conditions
     *
     * @param array|null $conditions
     * @return int
     */
    public function getTotal(?array $conditions = null): int
    {
        if ($conditions) {
            return $this->where($conditions)->countAllResults();
        }
        return $this->countAllResults();
    }

    protected $useCache = true;
    protected $cacheTimeout = 300;
} 