<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'tbl_m_item';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'kode',
        'item',
        'item_alias',
        'item_kand',
        'barcode',
        'id_satuan',
        'id_kategori',
        'id_merk',
        'jml',
        'jml_min',
        'jml_limit',
        'harga_beli',
        'harga_jual',
        'remun_tipe',
        'remun_perc',
        'remun_nom',
        'apres_tipe',
        'apres_perc',
        'apres_nom',
        'status',
        'status_stok',
        'status_racikan',
        'status_item',
        'id_user',
        'status_hps'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Generate unique kode for item
     * Format: OBT-001, OBT-002, etc
     */
    public function generateKode($status_item = null)
    {
        switch ($status_item) {
            case 1:
                $prefix = 'OBT' . date('ym') . rand(10, 99);
                break;

            case 2:
                $prefix = 'TND' . date('ym') . rand(10, 99);
                break;

            case 3:
                $prefix = 'LAB' . date('ym') . rand(10, 99);
                break;

            case 4:
                $prefix = 'RAD' . date('ym') . rand(10, 99);
                break;

            case 5:
                $prefix = 'BHP' . date('ym') . rand(10, 99);
                break;

            default:
                $prefix = '-';
                break;
        }

        $lastKode = $this->select('kode')
            ->where('status_item', $status_item)
            ->orderBy('kode', 'DESC')
            ->first();

        if (!$lastKode) {
            return $prefix . '00001';
        }

        $lastNumber = (int) substr($lastKode->kode, strlen($prefix));
        $newNumber  = $lastNumber + 1;

        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Get item with all its relations
     */
    public function getItemWithRelations($id = null)
    {
        $builder = $this->db->table($this->table . ' i')
            ->select('i.*, s.satuanBesar as satuan, k.kategori, m.merk')
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

        $data = [
            'status_hps' => '1',
            'deleted_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Use the query builder to ensure timestamps are updated
        return $this->db->table($this->table)
            ->where($this->primaryKey, $id)
            ->update($data);
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

    /**
     * Count soft deleted records
     */
    public function countDeleted($status_item = 1)  // Default to OBAT (1)
    {
        return $this->db->table($this->table)
            ->where('status_hps', '1')
            ->where('status_item', $status_item)
            ->countAllResults();
    }

    /**
     * Get deleted obat items
     */
    public function getObatTrash()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
                tbl_m_item.*,
                tbl_m_satuan.satuanBesar,
                tbl_m_kategori.kategori,
                tbl_m_merk.merk
            ')
            ->join('tbl_m_satuan', 'tbl_m_satuan.id = tbl_m_item.id_satuan', 'left')
            ->join('tbl_m_kategori', 'tbl_m_kategori.id = tbl_m_item.id_kategori', 'left')
            ->join('tbl_m_merk', 'tbl_m_merk.id = tbl_m_item.id_merk', 'left')
            ->where('tbl_m_item.status_item', 1)
            ->where('tbl_m_item.status_hps', '1');

        return $builder;
    }

    public function getTindakan()
    {
        return $this->select('
                tbl_m_item.id,
                tbl_m_item.kode,
                tbl_m_item.item,
                tbl_m_item.item_alias,
                tbl_m_item.item_kand,
                tbl_m_item.harga_jual,
                tbl_m_item.status,
                tbl_m_item.status_item
            ')
            ->where('tbl_m_item.status_item', 2)
            ->where('tbl_m_item.status_hps', '0');
    }

    public function getTindakanTrash()
    {
        $builder = $this->db->table($this->table);
        return $builder->select('
                tbl_m_item.id,
                tbl_m_item.kode,
                tbl_m_item.item,
                tbl_m_item.item_alias,
                tbl_m_item.item_kand,
                tbl_m_item.harga_jual,
                tbl_m_item.status,
                tbl_m_item.status_item,
                tbl_m_item.deleted_at
            ')
            ->where('tbl_m_item.status_item', 2)
            ->where('tbl_m_item.status_hps', '1');
    }
}