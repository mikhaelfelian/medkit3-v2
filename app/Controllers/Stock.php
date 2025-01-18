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

use App\Models\ItemModel;
use App\Models\PengaturanModel;

class Stock extends BaseController
{
    protected $itemModel;
    protected $pengaturan;
    protected $validation;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->pengaturan = new PengaturanModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Display list of stocked items
     */
    public function items()
    {
        $data = [
            'title'      => 'Data Stok Item',
            'Pengaturan' => $this->pengaturan->first(),
            'items'      => $this->itemModel->where('status_stok', '1')
                                          ->paginate(10, 'items'),
            'pager'      => $this->itemModel->pager,
            'validation' => $this->validation
        ];

        return view('admin-lte-3/gudang/item/index', $data);
    }
} 