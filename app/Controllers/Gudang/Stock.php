<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-30
 * 
 * Stock Controller
 * 
 * Controller for managing stock/inventory data
 */

namespace App\Controllers\Gudang;

use App\Controllers\BaseController;
use App\Models\GudangModel;
use App\Models\ItemModel;
use App\Models\ItemStokModel;
use App\Models\ItemBatchModel;
use App\Models\ItemHistModel;
use App\Models\PengaturanModel;
use App\Models\MerkModel;
use App\Models\KategoriModel;

class Stock extends BaseController
{
    protected $itemModel;
    protected $gudangModel;
    protected $itemBatchModel;
    protected $itemHistModel;
    protected $pengaturanModel;
    protected $merkModel;
    protected $kategoriModel;
    protected $itemStokModel;
    protected $validation;

    public function __construct()
    {
        $this->gudangModel      = new GudangModel();
        $this->itemModel        = new ItemModel();
        $this->itemStokModel    = new ItemStokModel();
        $this->itemBatchModel   = new ItemBatchModel();
        $this->itemHistModel    = new ItemHistModel();
        $this->pengaturanModel  = new PengaturanModel();
        $this->merkModel        = new MerkModel();
        $this->kategoriModel    = new KategoriModel();
        $this->validation       = \Config\Services::validation();
    }

    /**
     * Display stockable items
     * 
     * @return string
     */
    public function items()
    {
        try {
            $kategori = $this->kategoriModel->where('status', '1')->findAll();
            $merk     = $this->merkModel->where('status', '1')->findAll();

            // Get filters from URL
            $filters = [
                'kategori' => $this->request->getGet('filter_kategori'),
                'merk'     => $this->request->getGet('filter_merk'),
                'item'     => $this->request->getGet('filter_item'),
                'harga'    => $this->request->getGet('filter_harga')
            ];

            // Pagination config
            $page = $this->request->getGet('page') ?? 1;
            $perPage = 10;

            // Get total rows for pagination
            $total = $this->itemModel->getStockable($filters, true);

            // Get paginated data
            $items = $this->itemModel->getStockable($filters, false, $perPage, ($page - 1) * $perPage);

            // Create pager
            $pager = service('pager');
            $pager->setPath('stock/items'); // Set the path for pagination links
            $pager->makeLinks($page, $perPage, $total, 'default_full');

            $data = [
                'title'       => 'Data Item Stok',
                'kategoris'   => $kategori,
                'merks'       => $merk,
                'items'       => $items,
                'pager'       => $pager,
                'Pengaturan'  => $this->pengaturan,
                'user'        => $this->ionAuth->user()->row()
            ];
            
            return $this->view($this->theme->getThemePath() . '/gudang/item/index', $data);

        } catch (\Exception $e) {
            log_message('error', '[Stock::items] ' . $e->getMessage());
            return redirect()->back()
                            ->with('error', 'Gagal memuat data item');
        }
    }

    /**
     * Display item detail
     */
    public function detail($id = null)
    {
        try {
            // Get item data with relations
            $item = $this->itemModel->getItemDetail($id);
            if (!$item) {
                throw new \RuntimeException('Item tidak ditemukan');
            }

            // Get stock details with relations (includes gudang info)
            $stockDetails   = $this->itemStokModel->getStockByItem($id);

            // Get total stock
            $totalStock     = $this->itemStokModel->getTotalStockByItem($id);

            // Get batch data
            $batches        = $this->itemBatchModel->where('id_item', $id)
                                          ->orderBy('tgl_ed', 'ASC')
                                          ->findAll();

            // Riwayat stok
            $itemHists      = $this->itemHistModel->getWithRelations($id);
            // Data Gudang
            $gudangs        = $this->gudangModel->findAll();

            $data = [
                'title'        => 'Data Stok Detail',
                'Pengaturan'   => $this->pengaturan,
                'user'         => $this->ionAuth->user()->row(),
                'item'         => $item,
                'itemHists'    => $itemHists,
                'stockDetails' => $stockDetails,
                'gudangs'      => $gudangs,
                'batches'      => $batches,
                'totalStock'   => $totalStock
            ];

            return $this->view($this->theme->getThemePath() . '/gudang/item/detail', $data);
            
        } catch (\Exception $e) {
            log_message('error', '[Stock::detail] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal memuat detail item');
        }
    }

    /**
     * Update stock quantity and record history
     */
    public function update($id = null)
    {
        try {
            if (!$id) {
                throw new \RuntimeException('ID stok tidak valid');
            }

            // Get stock data
            $stock = $this->itemStokModel->find($id);
            if (!$stock) {
                throw new \RuntimeException('Data stok tidak ditemukan');
            }

            // Get item data
            $item = $this->itemModel->getItemDetail($stock->id_item);
            if (!$item) {
                throw new \RuntimeException('Data item tidak ditemukan');
            }

            // Validate input
            $rules = [
                'jumlah' => [
                    'rules' => 'required|numeric|greater_than_equal_to[0]',
                    'errors' => [
                        'required' => 'Jumlah harus diisi',
                        'numeric' => 'Jumlah harus berupa angka',
                        'greater_than_equal_to' => 'Jumlah tidak boleh negatif'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                               ->with('errors', $this->validator->getErrors());
            }

            $newQty = $this->request->getPost('jumlah');
            
            // Begin transaction
            $this->db->transBegin();

            try {
                // Update stock
                $updateData = ['jml' => $newQty];
                if (!$this->itemStokModel->update($id, $updateData)) {
                    throw new \RuntimeException('Gagal mengupdate stok');
                }

                // Record history
                $historyData = [
                    'id_item'    => $item->id,
                    'id_gudang'  => $stock->id_gudang,
                    'id_satuan'  => $item->id_satuan,
                    'id_user'    => $this->ionAuth->user()->row()->id,
                    'tgl_masuk'  => date('Y-m-d H:i:s'),
                    'kode'       => $item->kode,
                    'item'       => $item->item,
                    'keterangan' => 'Ubah stok manual oleh <b>' . $this->ionAuth->user()->row()->username . '</b>',
                    'jml'        => $newQty,
                    'jml_satuan' => $item->jml_satuan ?? 1,
                    'satuan'     => $item->satuan,
                    'status'     => '2'
                ];

                if (!$this->itemHistModel->insert($historyData)) {
                    throw new \RuntimeException('Gagal menyimpan riwayat stok');
                }

                $this->db->transCommit();
                return redirect()->back()
                                 ->with('success', 'Stok berhasil diupdate');

            } catch (\Exception $e) {
                $this->db->transRollback();
                throw $e;
            }
        } catch (\Exception $e) {
            log_message('error', '[Stock::update] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal mengupdate stok: ' . $e->getMessage());
        }
    }
} 