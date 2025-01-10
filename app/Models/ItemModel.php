<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'tbl_m_item';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode', 'item', 'item_alias', 'item_kand', 'barcode',
        'id_satuan', 'id_kategori', 'id_merk', 'jml', 'jml_min',
        'jml_limit', 'harga_beli', 'harga_jual', 'status',
        'status_stok', 'status_racikan', 'status_item', 'id_user',
        'status_hps'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate unique kode for item
     * Format: OBT-001, OBT-002, etc
     */
    public function generateKode()
    {
        $prefix = 'OBT-';
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

    /**
     * Get item with all its relations
     */
    public function getItemWithRelations($id = null)
    {
        $builder = $this->db->table($this->table . ' i')
            ->select('i.*, s.satuan, k.kategori, m.merk')
            ->join('tbl_m_satuan s', 's.id = i.id_satuan', 'left')
            ->join('tbl_m_kategori k', 'k.id = i.id_kategori', 'left')
            ->join('tbl_m_merk m', 'm.id = i.id_merk', 'left');

        if ($id !== null) {
            return $builder->where('i.id', $id)->get()->getRow();
        }

        return $builder->get()->getResult();
    }

    /**
     * Soft delete an item
     */
    public function delete($id = null, bool $purge = false)
    {
        if ($purge) {
            return parent::delete($id, true);
        }
        
        return $this->update($id, ['status_hps' => '1','deleted_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Permanently delete an item
     * 
     * @param int|string|null $id The ID to delete
     * @return bool True on success, false on failure
     */
    public function delete_permanent($id = null)
    {
        return parent::delete($id, true);
    }

    /**
     * Override find methods to exclude soft deleted records
     */
    public function find($id = null)
    {
        $this->where('status_hps', '0');
        return parent::find($id);
    }

    /**
     * Override findAll to exclude soft deleted records
     * 
     * @param int|null $limit  The limit of records to return
     * @param int      $offset The record offset
     */
    public function findAll(?int $limit = null, int $offset = 0)
    {
        $this->where('status_hps', '0');
        return parent::findAll($limit, $offset);
    }

    /**
     * Get obat items only (status_item = 1)
     */
    public function getObat()
    {
        return $this->select('tbl_m_item.*, tbl_m_merk.merk, tbl_m_satuan.satuanBesar, tbl_m_satuan.satuanKecil, tbl_m_satuan.jml, tbl_m_kategori.kategori')
            ->join('tbl_m_merk', 'tbl_m_merk.id = tbl_m_item.id_merk', 'left')
            ->join('tbl_m_satuan', 'tbl_m_satuan.id = tbl_m_item.id_satuan', 'left')
            ->join('tbl_m_kategori', 'tbl_m_kategori.id = tbl_m_item.id_kategori', 'left')
            ->where('tbl_m_item.status_item', 1)
            ->where('tbl_m_item.status_hps', '0');
    }
} 