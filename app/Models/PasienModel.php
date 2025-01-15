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
        'file_ktp', 'file_foto', 'status', 'status_hps'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Soft Deletes
    protected $softDelete = true;

    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table($this->table);
        $this->builder->select('tbl_m_pasien.*, tbl_m_gelar.gelar')
            ->join('tbl_m_gelar', 'tbl_m_gelar.id = tbl_m_pasien.id_gelar', 'left')
            ->where('tbl_m_pasien.status_hps', '0') // Only show non-deleted records
            ->orderBy('tbl_m_pasien.id', 'DESC');
    }

    /**
     * Override delete method to handle both status_hps and deleted_at
     */
    public function delete($id = null, bool $purge = false)
    {
        $this->db->transBegin();

        try {
            $data = [
                'status_hps' => '1',
                'deleted_at' => date('Y-m-d H:i:s')
            ];

            $this->update($id, $data);
            
            $this->db->transCommit();
            return true;

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[PasienModel::delete] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Restore a soft deleted record
     */
    public function restore($id)
    {
        $this->db->transBegin();

        try {
            $data = [
                'status_hps' => '0',
                'deleted_at' => null
            ];

            $this->update($id, $data);
            
            $this->db->transCommit();
            return true;

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[PasienModel::restore] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get only trashed records
     */
    public function onlyDeleted()
    {
        return $this->where('status_hps', '1')
                    ->where('deleted_at IS NOT NULL');
    }

    /**
     * Get patient with related data
     * 
     * @param int|null $id The ID of the patient
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getPasien($id = null)
    {
        $builder = $this->db->table($this->table)
            ->select('tbl_m_pasien.*, tbl_m_gelar.gelar')
            ->join('tbl_m_gelar', 'tbl_m_gelar.id = tbl_m_pasien.id_gelar', 'left')
            ->where('tbl_m_pasien.status_hps', '0')
            ->orderBy('tbl_m_pasien.id', 'DESC');

        if ($id !== null) {
            return $builder->where('tbl_m_pasien.id', $id)
                         ->get()
                         ->getRow();
        }

        return $builder;
    }

    /**
     * Generate unique patient code
     * Format: <prefix><YM><order5><random4>
     * Example: ES25014560046 where:
     * ES   = prefix
     * 2501 = year and month (2025-01)
     * 456 = random 3 digits
     * 046 = order number (resets every month)
     * 
     * @return string
     */
    public function generateKode()
    {
        $prefix     = '';
        $yearMonth  = date('ym'); // Get current year and month (2501 for 2025-01)
        $random     = sprintf('%02d', rand(1, 99)); // Generate 4 digit random number

        // Get last order number for current month
        $lastKode = $this->db->table($this->table)
            ->select('COUNT(created_at) AS kode')
            ->where('YEAR(created_at)', date('Y')) // Match year part
            ->where('MONTH(created_at)', date('m')) // Match month part
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        if ($lastKode) {
            // Extract the last 3 digits (order number)
            $lastOrder  = $lastKode->kode; // (int) substr($lastKode->kode, -2);
            $newOrder   = $lastOrder + 1;
        } else {
            $newOrder   = 1;
        }

        // Format order number to 3 digits with leading zeros
        $orderNumber = str_pad($newOrder, 3, '0', STR_PAD_LEFT);

        // Combine all parts
        return $prefix . $yearMonth . $orderNumber . $random;
    }

    /**
     * Get count of trashed records
     * 
     * @return int
     */
    public function getTrashCount()
    {
        return $this->db->table($this->table)
                       ->where('status_hps', '1')
                       ->where('deleted_at IS NOT NULL')
                       ->countAllResults();
    }
} 