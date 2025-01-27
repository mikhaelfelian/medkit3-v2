<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-19
 * 
 * Stock Controller
 * 
 * Controller for managing stock/inventory data
 */

namespace App\Controllers;

use App\Models\GudangModel;
use App\Models\ItemModel;
use App\Models\ItemRefModel;
use App\Models\ItemStokModel;
use App\Models\SatuanModel;
use App\Models\KategoriModel;
use App\Models\MerkModel;
use App\Models\PengaturanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stock extends BaseController
{
    protected $itemModel;
    protected $pengaturanModel;
    protected $validation;

    public function __construct()
    {
        $this->gudangModel      = new GudangModel();
        $this->itemModel        = new ItemModel();
        $this->itemRefModel     = new ItemRefModel();
        $this->itemStokModel    = new ItemStokModel();
        $this->satuanModel      = new SatuanModel(); 
        $this->kategoriModel    = new KategoriModel();
        $this->merkModel        = new MerkModel();
        $this->pengaturanModel  = new PengaturanModel();
        $this->validation       = \Config\Services::validation();
    }

    /**
     * Display list of stocked items
     */
    public function items()
    {
        $sql_merk       = $this->merkModel->where('status', '1')->findAll();
        $sql_kategori   = $this->kategoriModel->where('status', '1')->findAll();

        $filters = [
            'kategori' => $this->request->getGet('kategori'),
            'merk'     => $this->request->getGet('merk'),
            'item'     => $this->request->getGet('item'),
            'status'   => $this->request->getGet('status'),
            'q'        => $this->request->getGet('q')
        ];

        $data = [
            'title'           => 'Data Stok Item',
            'Pengaturan'      => $this->pengaturan,
            'user'            => $this->ionAuth->user()->row(),
            'items'           => $this->itemModel->getStockable($filters)->paginate(10, 'items'),
            'pager'           => $this->itemModel->pager,
            'validation'      => $this->validation,
            'request'         => $this->request,
            'kategoriList'    => $sql_kategori,
            'merkList'        => $sql_merk,
            'selectedKategori'=> $filters['kategori'],
            'selectedMerk'    => $filters['merk'],
            'selectedStatus'  => $filters['status']
        ];

        return view('admin-lte-3/gudang/item/index', $data);
    }
} 