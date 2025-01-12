<?php
/**
 * Satuan Controller
 * 
 * Controller for managing units (satuan)
 * Handles CRUD operations and other related functionalities
 * 
 * @author    Mikhael Felian Waskito <mikhaelfelian@gmail.com>
 * @date      2025-01-12
 */

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    protected $satuanModel;
    protected $validation;

    public function __construct()
    {
        $this->satuanModel = new SatuanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_satuan') ?? 1;
        $perPage = 10;
        $keyword = $this->request->getVar('keyword');

        // Use query builder caching
        $this->satuanModel->builder()->select('id, satuanKecil, satuanBesar, jml, status');

        if ($keyword) {
            $this->satuanModel->groupStart()
                ->like('satuanKecil', $keyword)
                ->orLike('satuanBesar', $keyword)
                ->groupEnd();
        }

        // Cache the results
        $cacheKey = "satuan_page_{$currentPage}_search_{$keyword}";
        if (!$results = cache($cacheKey)) {
            $results = [
                'total' => $this->satuanModel->countAllResults(false),
                'data' => $this->satuanModel->paginate($perPage, 'satuan')
            ];
            cache()->save($cacheKey, $results, 300); // Cache for 5 minutes
        }

        $data = [
            'title'         => 'Data Satuan',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'satuan'        => $results['data'],
            'pager'         => $this->satuanModel->pager,
            'currentPage'   => $currentPage,
            'perPage'       => $perPage,
            'total'         => $results['total'],
            'keyword'       => $keyword,
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Satuan</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/satuan/index', $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Form Satuan',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'validation'    => $this->validation,
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/satuan') . '">Satuan</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/satuan/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            env('security.tokenName', 'csrf_test_name') => 'required',
            'satuanKecil' => [
                'rules'  => 'required|min_length[1]|max_length[100]',
                'errors' => [
                    'required'   => 'Satuan Kecil harus diisi',
                    'min_length' => 'Satuan Kecil minimal 1 karakter',
                    'max_length' => 'Satuan Kecil maksimal 100 karakter'
                ]
            ],
            'satuanBesar' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Satuan Besar maksimal 100 karakter'
                ]
            ],
            'jml' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'integer'  => 'Jumlah harus berupa angka'
                ]
            ],
            'status' => [
                'rules'  => 'permit_empty|in_list[0,1]',
                'errors' => [
                    'in_list' => 'Status harus 0 atau 1'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('toastr', [
                'type' => 'error',
                'message' => 'Invalid CSRF token'
            ]);
        }

        $data = [
            'satuanKecil' => $this->request->getPost('satuanKecil'),
            'satuanBesar' => $this->request->getPost('satuanBesar'),
            'jml'         => $this->request->getPost('jml'),
            'status'      => $this->request->getPost('status') ?? '1'
        ];

        if ($this->satuanModel->insert($data)) {
            return redirect()->to('satuan')->with('toast_show', [
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ]);
        }

        return redirect()->back()->withInput()->with('toast_show', [
            'type' => 'error',
            'message' => 'Gagal menambahkan data'
        ]);
    }

    public function edit($id = null)
    {
        $satuan = $this->satuanModel->find($id);
        if (!$satuan) {
            return redirect()->to('satuan')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title'         => 'Form Satuan',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'validation'    => $this->validation,
            'satuan'        => $satuan,
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/satuan') . '">Satuan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/satuan/edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            env('security.tokenName', 'csrf_test_name') => 'required',
            'satuanKecil' => [
                'rules'  => 'required|min_length[1]|max_length[100]',
                'errors' => [
                    'required'   => 'Satuan Kecil harus diisi',
                    'min_length' => 'Satuan Kecil minimal 1 karakter',
                    'max_length' => 'Satuan Kecil maksimal 100 karakter'
                ]
            ],
            'satuanBesar' => [
                'rules'  => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => 'Satuan Besar maksimal 100 karakter'
                ]
            ],
            'jml' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'integer'  => 'Jumlah harus berupa angka'
                ]
            ],
            'status' => [
                'rules'  => 'permit_empty|in_list[0,1]',
                'errors' => [
                    'in_list' => 'Status harus 0 atau 1'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('toastr', [
                'type' => 'error',
                'message' => 'Invalid CSRF token'
            ]);
        }

        $data = [
            'satuanKecil' => $this->request->getPost('satuanKecil'),
            'satuanBesar' => $this->request->getPost('satuanBesar'),
            'jml'         => $this->request->getPost('jml'),
            'status'      => $this->request->getPost('status') ?? '1'
        ];

        if ($this->satuanModel->update($id, $data)) {
            return redirect()->to('satuan')->with('toast_show', [
                'type' => 'success',
                'message' => 'Data berhasil diupdate'
            ]);
        }

        return redirect()->back()->withInput()->with('toastr', [
            'type' => 'error',
            'message' => 'Gagal mengupdate data'
        ]);
    }

    public function delete($id = null)
    {
        // Check if ID exists
        $satuan = $this->satuanModel->find($id);
        if (!$satuan) {
            return redirect()->to('satuan')->with('toastr', [
                'type' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // Try to delete
        if ($this->satuanModel->delete($id)) {
            return redirect()->to('satuan')->with('toastr', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }

        return redirect()->to('satuan')->with('toastr', [
            'type' => 'error',
            'message' => 'Gagal menghapus data'
        ]);
    }
} 