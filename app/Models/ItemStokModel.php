<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemStokModel extends Model
{
    protected $table            = 'tbl_m_item_stok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_item',
        'id_satuan',
        'id_gudang',
        'id_user',
        'jml',
        'status',
        'status_hps'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'id_item'    => 'required|integer',
        'id_gudang'  => 'permit_empty|integer',
        'id_satuan'  => 'permit_empty|integer',
        'jml'        => 'permit_empty|numeric',
        'status'     => 'permit_empty|in_list[0,1,2]',
    ];

    /**
     * Get stock with relations (item, gudang, satuan)
     */
    public function getStockWithRelations($id = null)
    {
        $builder = $this->db->table($this->table . ' s')
            ->select('s.*, i.kode as item_kode, i.item, g.gudang, st.satuan')
            ->join('tbl_m_item i', 'i.id = s.id_item', 'left')
            ->join('tbl_m_gudang g', 'g.id = s.id_gudang', 'left')
            ->join('tbl_m_satuan st', 'st.id = s.id_satuan', 'left')
            ->where('s.status_hps', '0');

        if ($id !== null) {
            return $builder->where('s.id', $id)->get()->getRow();
        }

        return $builder->get()->getResult();
    }

    /**
     * Get stock by item ID
     */
    public function getStockByItem($itemId)
    {
        return $this->where('id_item', $itemId)->findAll();
    }

    /**
     * Get stock by gudang ID
     */
    public function getStockByGudang($gudangId)
    {
        return $this->where('id_gudang', $gudangId)->findAll();
    }

    /**
     * Get total stock by item ID
     */
    public function getTotalStockByItem($itemId)
    {
        return $this->selectSum('jml')
                    ->where('id_item', $itemId)
                    ->where('status', '1')
                    ->first()
                    ->jml ?? 0;
    }

    /**
     * Get stock by item ID and gudang ID
     */
    public function getStockByItemAndGudang($itemId, $gudangId)
    {
        return $this->where([
            'id_item'   => $itemId,
            'id_gudang' => $gudangId
        ])->first();
    }

    /**
     * Update or create stock
     */
    public function updateStock($itemId, $gudangId, $qty, $status = '1')
    {
        $existingStock = $this->getStockByItemAndGudang($itemId, $gudangId);

        if ($existingStock) {
            // Update existing stock
            $data = [
                'jml'    => $existingStock->jml + $qty,
                'status' => $status
            ];
            return $this->update($existingStock->id, $data);
        } else {
            // Create new stock
            $data = [
                'id_item'   => $itemId,
                'id_gudang' => $gudangId,
                'jml'       => $qty,
                'status'    => $status,
                'id_user'   => user_id() // Assuming you have a helper function to get current user ID
            ];
            return $this->insert($data);
        }
    }

    /**
     * Get low stock items (where jml <= jml_limit)
     */
    public function getLowStockItems()
    {
        return $this->db->table($this->table . ' s')
            ->select('s.*, i.kode as item_kode, i.item, i.jml_limit, g.gudang')
            ->join('tbl_m_item i', 'i.id = s.id_item')
            ->join('tbl_m_gudang g', 'g.id = s.id_gudang')
            ->where('s.jml <=', 'i.jml_limit', false)
            ->where('s.status', '1')
            ->get()
            ->getResult();
    }

    /**
     * Soft delete a stock record
     */
    public function delete($id = null, bool $purge = false)
    {
        if ($purge) {
            return parent::delete($id, true);
        }
        
        return $this->update($id, ['status_hps' => '1']);
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
} 