<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-20
 * 
 * TransBeliPO Controller
 * 
 * Controller for managing purchase orders
 */

namespace App\Controllers;

use App\Models\TransBeliPOModel;
use App\Models\TransBeliPODetModel;
use App\Models\SupplierModel;
use App\Models\PengaturanModel;

class TransBeliPO extends BaseController
{
    protected $transBeliPOModel;
    protected $transBeliPODetModel;
    protected $supplierModel;
    protected $pengaturanModel;
    protected $validation;

    public function __construct()
    {
        $this->transBeliPOModel = new TransBeliPOModel();
        $this->transBeliPODetModel = new TransBeliPODetModel();
        $this->supplierModel = new SupplierModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Display list of purchase orders
     */
    public function index()
    {
        $filters = [
            'status'        => $this->request->getGet('status'),
            'supplier'      => $this->request->getGet('supplier'),
            'date_start'    => $this->request->getGet('date_start'),
            'date_end'      => $this->request->getGet('date_end'),
            'q'             => $this->request->getGet('q')
        ];

        $data = [
            'title'      => 'Data Purchase Order',
            'Pengaturan' => $this->pengaturan,
            'user'       => $this->ionAuth->user()->row(),
            'po_list'    => $this->transBeliPOModel->getWithRelations($filters)->paginate(10, 'po'),
            'pager'      => $this->transBeliPOModel->pager,
            'suppliers'  => $this->supplierModel->where('status_hps', '0')->findAll(),
            'filters'    => $filters,
            'validation' => $this->validation,
            'request'    => $this->request
        ];

        return view('admin-lte-3/transaksi/po/index', $data);
    }

    /**
     * Display purchase order creation form
     */
    public function create()
    {
        $data = [
            'title'      => 'Buat Purchase Order',
            'Pengaturan' => $this->pengaturan,
            'user'       => $this->ionAuth->user()->row(),
            'suppliers'  => $this->supplierModel->where('status_hps', '0')->findAll(),
            'validation' => $this->validation,
            'po_number'  => $this->transBeliPOModel->generateNoNota()
        ];

        return view('admin-lte-3/transaksi/po/trans_po', $data);
    }

    /**
     * Store new purchase order
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'supplier_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier harus dipilih'
                ]
            ],
            'tgl_po' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal PO harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'alamat_pengiriman' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Alamat pengiriman harus diisi',
                    'max_length' => 'Alamat pengiriman maksimal 160 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validation->getErrors());
        }

        try {
            $supplier = $this->supplierModel->find($this->request->getPost('supplier_id'));
            if (!$supplier) {
                throw new \RuntimeException('Supplier tidak ditemukan');
            }

            $data = [
                'id_supplier'   => $supplier->id,
                'id_user'       => $this->ionAuth->user()->row()->id,
                'tgl_masuk'     => $this->request->getPost('tgl_po'),
                'no_nota'       => $this->transBeliPOModel->generateNoNota(),
                'supplier'      => $supplier->nama,
                'keterangan'    => $this->request->getPost('keterangan'),
                'pengiriman'    => $this->request->getPost('alamat_pengiriman'),
                'status'        => 0 // Draft status
            ];

            $this->db->transStart();

            if (!$this->transBeliPOModel->insert($data)) {
                throw new \RuntimeException('Gagal menyimpan PO');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Gagal menyimpan PO');
            }

            return redirect()->to('transaksi/po')
                            ->with('success', 'Purchase Order berhasil dibuat');

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::store] ' . $e->getMessage());
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal membuat Purchase Order: ' . $e->getMessage());
        }
    }

    /**
     * Display purchase order edit form
     */
    public function edit($id)
    {
        try {
            $po = $this->transBeliPOModel->getWithRelations(['id' => $id])->get()->getRow();
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Only allow editing draft POs
            if ($po->status != 0) {
                return redirect()->back()
                               ->with('error', 'Hanya PO dengan status draft yang dapat diedit');
            }

            $data = [
                'title'      => 'Edit Purchase Order',
                'Pengaturan' => $this->pengaturan,
                'user'       => $this->ionAuth->user()->row(),
                'suppliers'  => $this->supplierModel->where('status_hps', '0')->findAll(),
                'validation' => $this->validation,
                'po'         => $po
            ];

            return view('admin-lte-3/transaksi/po/edit', $data);

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::edit] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal memuat form edit PO');
        }
    }

    /**
     * Update purchase order
     */
    public function update($id)
    {
        // Validation rules
        $rules = [
            'supplier_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier harus dipilih'
                ]
            ],
            'tgl_po' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal PO harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'alamat_pengiriman' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Alamat pengiriman harus diisi',
                    'max_length' => 'Alamat pengiriman maksimal 160 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validation->getErrors());
        }

        try {
            $po = $this->transBeliPOModel->find($id);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Only allow editing draft POs
            if ($po->status != 0) {
                throw new \RuntimeException('Hanya PO dengan status draft yang dapat diedit');
            }

            $supplier = $this->supplierModel->find($this->request->getPost('supplier_id'));
            if (!$supplier) {
                throw new \RuntimeException('Supplier tidak ditemukan');
            }

            $data = [
                'id_supplier'   => $supplier->id,
                'tgl_masuk'     => $this->request->getPost('tgl_po'),
                'supplier'      => $supplier->nama,
                'keterangan'    => $this->request->getPost('keterangan'),
                'pengiriman'    => $this->request->getPost('alamat_pengiriman')
            ];

            $this->db->transStart();

            if (!$this->transBeliPOModel->update($id, $data)) {
                throw new \RuntimeException('Gagal mengupdate PO');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Gagal mengupdate PO');
            }

            return redirect()->to('transaksi/po')
                            ->with('success', 'Purchase Order berhasil diupdate');

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::update] ' . $e->getMessage());
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal mengupdate Purchase Order: ' . $e->getMessage());
        }
    }
} 