<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-18
 * 
 * Supplier Controller
 * 
 * Controller for managing supplier data
 */

namespace App\Controllers;

use App\Models\SupplierModel;
use App\Models\PengaturanModel;

class Supplier extends BaseController
{
    protected $supplierModel;
    protected $validation;
    protected $pengaturan;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->pengaturan = new PengaturanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_supplier') ?? 1;
        $perPage = $this->pengaturan->pagination_limit ?? 10;

        // Start with the model query
        $query = $this->supplierModel;

        // Only show non-deleted suppliers
        $query->where('status_hps', '0');

        // Filter by name/code/npwp
        $search = $this->request->getVar('search');
        if ($search) {
            $query->groupStart()
                ->like('nama', $search)
                ->orLike('kode', $search)
                ->orLike('npwp', $search)
                ->groupEnd();
        }

        // Filter by type
        $selectedTipe = $this->request->getVar('tipe');
        if ($selectedTipe !== null && $selectedTipe !== '') {
            $query->where('tipe', $selectedTipe);
        }

        $data = [
            'title'          => 'Data Supplier',
            'suppliers'      => $query->paginate($perPage, 'supplier'),
            'pager'          => $this->supplierModel->pager,
            'currentPage'    => $currentPage,
            'perPage'        => $perPage,
            'search'         => $search,
            'selectedTipe'   => $selectedTipe,
            'getTipeLabel'   => function($tipe) {
                return $this->supplierModel->getTipeLabel($tipe);
            },
            'getStatusLabel' => function($status) {
                return $this->supplierModel->getStatusLabel($status);
            },
            'breadcrumbs'    => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Supplier</li>
            '
        ];

        return $this->view($this->theme->getThemePath() . '/master/supplier/index', $data);
    }

    /**
     * Display create form
     */
    public function create()
    {
        $data = [
            'title'       => 'Tambah Supplier',
            'validation'  => $this->validation,
            'kode'        => $this->supplierModel->generateKode(),
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item"><a href="' . base_url('master/supplier') . '">Supplier</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            '
        ];

        return $this->view($this->theme->getThemePath() . '/master/supplier/create', $data);
    }

    /**
     * Store new supplier data
     */
    public function store()
    {
        try {
            $data = [
                'kode'       => $this->supplierModel->generateKode(),
                'nama'       => $this->request->getPost('nama'),
                'npwp'       => $this->request->getPost('npwp'),
                'alamat'     => $this->request->getPost('alamat'),
                'rt'         => $this->request->getPost('rt'),
                'rw'         => $this->request->getPost('rw'),
                'kelurahan'  => $this->request->getPost('kelurahan'),
                'kecamatan'  => $this->request->getPost('kecamatan'),
                'kota'       => $this->request->getPost('kota'),
                'no_tlp'     => $this->request->getPost('no_tlp'),
                'no_hp'      => $this->request->getPost('no_hp'),
                'tipe'       => $this->request->getPost('tipe'),
                'status'     => '1',
                'status_hps' => '0'
            ];

            if (!$this->supplierModel->insert($data)) {
                throw new \RuntimeException('Gagal menyimpan data supplier');
            }

            return redirect()->to(base_url('master/supplier'))
                           ->with('success', 'Data supplier berhasil ditambahkan');

        } catch (\Exception $e) {
            log_message('error', '[Supplier::store] ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal menyimpan data supplier');
        }
    }

    /**
     * Display edit form
     */
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->to('master/supplier')
                           ->with('error', 'ID supplier tidak ditemukan');
        }

        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            return redirect()->to('master/supplier')
                           ->with('error', 'Data supplier tidak ditemukan');
        }

        $data = [
            'title'       => 'Edit Supplier',
            'validation'  => $this->validation,
            'supplier'    => $supplier,
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item"><a href="' . base_url('master/supplier') . '">Supplier</a></li>
                <li class="breadcrumb-item active">Edit</li>
            '
        ];

        return $this->view($this->theme->getThemePath() . '/master/supplier/edit', $data);
    }

    /**
     * Update supplier data
     */
    public function update($id = null)
    {
        if (!$id) {
            return redirect()->to('master/supplier')
                           ->with('error', 'ID supplier tidak ditemukan');
        }

        try {
            $data = [
                'nama'       => $this->request->getPost('nama'),
                'npwp'       => $this->request->getPost('npwp'),
                'alamat'     => $this->request->getPost('alamat'),
                'rt'         => $this->request->getPost('rt'),
                'rw'         => $this->request->getPost('rw'),
                'kelurahan'  => $this->request->getPost('kelurahan'),
                'kecamatan'  => $this->request->getPost('kecamatan'),
                'kota'       => $this->request->getPost('kota'),
                'no_tlp'     => $this->request->getPost('no_tlp'),
                'no_hp'      => $this->request->getPost('no_hp'),
                'tipe'       => $this->request->getPost('tipe')
            ];

            if (!$this->supplierModel->update($id, $data)) {
                throw new \RuntimeException('Gagal mengupdate data supplier');
            }

            return redirect()->to(base_url('master/supplier'))
                           ->with('success', 'Data supplier berhasil diupdate');

        } catch (\Exception $e) {
            log_message('error', '[Supplier::update] ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal mengupdate data supplier');
        }
    }

    /**
     * Display supplier details
     */
    public function detail($id = null)
    {
        if (!$id) {
            return redirect()->to('master/supplier')
                           ->with('error', 'ID supplier tidak ditemukan');
        }

        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            return redirect()->to('master/supplier')
                           ->with('error', 'Data supplier tidak ditemukan');
        }

        $data = [
            'title'       => 'Detail Supplier',
            'supplier'    => $supplier,
            'getTipeLabel'   => function($tipe) {
                return $this->supplierModel->getTipeLabel($tipe);
            },
            'getStatusLabel' => function($status) {
                return $this->supplierModel->getStatusLabel($status);
            },
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item"><a href="' . base_url('master/supplier') . '">Supplier</a></li>
                <li class="breadcrumb-item active">Detail</li>
            '
        ];

        return $this->view($this->theme->getThemePath() . '/master/supplier/detail', $data);
    }

    /**
     * Delete supplier data
     */
    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to('master/supplier')
                           ->with('error', 'ID supplier tidak ditemukan');
        }

        try {
            $supplier = $this->supplierModel->find($id);
            if (!$supplier) {
                throw new \RuntimeException('Data supplier tidak ditemukan');
            }

            // Soft delete by updating status_hps
            if (!$this->supplierModel->update($id, ['status_hps' => '1'])) {
                throw new \RuntimeException('Gagal menghapus data supplier');
            }

            return redirect()->to(base_url('master/supplier'))
                           ->with('success', 'Data supplier berhasil dihapus');

        } catch (\Exception $e) {
            log_message('error', '[Supplier::delete] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal menghapus data supplier');
        }
    }
} 