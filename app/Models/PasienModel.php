<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-14
 * 
 * PasienModel
 * 
 * Model for managing patient data
 */
class PasienModel extends Model
{
    protected $table            = 'tbl_m_pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'id_gelar', 'id_pekerjaan', 'id_user', 'kode', 'nik', 
        'nama', 'nama_pgl', 'tgl_lahir', 'tmp_lahir', 'jns_klm',
        'no_hp', 'alamat', 'alamat_domisili', 'rt', 'rw',
        'kelurahan', 'kecamatan', 'kota', 'pekerjaan',
        'file_ktp', 'file_foto', 'status', 'status_hps',
        'deleted_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Get base query with gelar join
     */
    protected function getBaseQuery()
    {
        return $this->select('tbl_m_pasien.*, tbl_m_gelar.gelar')
                    ->join('tbl_m_gelar', 'tbl_m_gelar.id = tbl_m_pasien.id_gelar', 'left');
    }

    /**
     * Override find to include gelar data
     */
    public function find($id = null)
    {
        if ($id === null) {
            return null;
        }

        // Reset any existing query
        $this->builder()->resetQuery();
        
        return $this->db->table($this->table . ' p')
                       ->select('p.*, g.gelar')
                       ->join('tbl_m_gelar g', 'g.id = p.id_gelar', 'left')
                       ->where('p.id', $id)
                       ->get()
                       ->getRow();
    }

    /**
     * Override findAll to exclude soft deleted records
     */
    public function findAll(?int $limit = null, int $offset = 0)
    {
        // Reset any existing query
        $this->builder()->resetQuery();
        
        return $this->db->table($this->table . ' p')
                       ->select('p.*, g.gelar')
                       ->join('tbl_m_gelar g', 'g.id = p.id_gelar', 'left')
                       ->where('p.status_hps', '0')
                       ->get($limit, $offset)
                       ->getResult();
    }

    /**
     * Implement soft delete
     */
    public function delete($id = null, bool $purge = false)
    {
        if ($id === null) {
            return false;
        }

        // Use raw SQL to avoid Time class
        $sql = "UPDATE {$this->table} 
                SET status_hps = '1', 
                    deleted_at = NOW() 
                WHERE id = ?";
                
        return $this->db->query($sql, [$id]);
    }

    /**
     * Count trashed records
     */
    public function countTrash(): int
    {
        return $this->where('status_hps', '1')->countAllResults();
    }

    /**
     * Get paginated trashed records
     */
    public function paginateTrash(int $perPage, int $currentPage = 1)
    {
        // Reset any existing query
        $this->builder()->resetQuery();

        // Initialize pager
        $this->pager = service('pager');
        
        $builder = $this->db->table($this->table . ' p')
                           ->select('p.*, g.gelar')
                           ->join('tbl_m_gelar g', 'g.id = p.id_gelar', 'left')
                           ->where('p.status_hps', '1')
                           ->orderBy('p.id', 'DESC');

        // Get total count
        $total = $builder->countAllResults(false);

        // Calculate offset
        $offset = ($currentPage - 1) * $perPage;

        // Get paginated results
        $data = $builder->get($perPage, $offset)->getResult();

        // Set up pagination
        $this->pager->makeLinks($currentPage, $perPage, $total, 'adminlte_pagination', 0, 'pasien');

        return $data;
    }

    /**
     * Generate new patient code
     */
    public function generateKode()
    {
        $lastKode = $this->select('kode')
                        ->orderBy('id', 'DESC')
                        ->first();

        if (!$lastKode) {
            return '000001';
        }

        return str_pad((int)$lastKode->kode + 1, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Restore trashed record
     */
    public function restore($id)
    {
        if ($id === null) {
            return false;
        }

        // Use raw SQL to avoid Time class
        $sql = "UPDATE {$this->table} 
                SET status_hps = '0', 
                    deleted_at = NULL 
                WHERE id = ?";
                
        return $this->db->query($sql, [$id]);
    }

    /**
     * Check if patient has associated user account
     */
    public function hasUserAccount($id_user)
    {
        if (!$id_user) {
            return false;
        }

        $db = \Config\Database::connect();
        return $db->table('tbl_ion_users')
                 ->where('id', $id_user)
                 ->countAllResults() > 0;
    }
} 