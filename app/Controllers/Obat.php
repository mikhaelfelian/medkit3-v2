<?php

namespace App\Controllers;

use App\Models\GudangModel;
use App\Models\ItemModel;
use App\Models\ItemStokModel;
use App\Models\SatuanModel;
use App\Models\KategoriModel;
use App\Models\MerkModel;

class Obat extends BaseController
{
    protected $itemModel;
    protected $satuanModel;
    protected $kategoriModel;
    protected $merkModel;
    protected $validation;

    public function __construct()
    {
        $this->gudangModel   = new GudangModel();
        $this->itemModel     = new ItemModel();
        $this->itemStokModel = new ItemStokModel();
        $this->satuanModel   = new SatuanModel(); 
        $this->kategoriModel = new KategoriModel();
        $this->merkModel     = new MerkModel();
        $this->validation    = \Config\Services::validation();
    }

    public function index()
    {
        $currentPage    = $this->request->getVar('page_obat') ?? 1;
        $perPage        = 10;
        $query          = $this->itemModel->getObat();

        // Get active kategori list for dropdown
        $kategoriList = [];
        $activeKategori = $this->kategoriModel->where('status', '1')->findAll();
        foreach ($activeKategori as $kategori) {
            $kategoriList[$kategori->id] = $kategori->kategori;
        }

        // Get active merk list for dropdown
        $merkList = [];
        $activeMerks = $this->merkModel->where('status', '1')->findAll();
        foreach ($activeMerks as $merk) {
            $merkList[$merk->id] = $merk->merk;
        }

        // Filter by kategori
        $selectedKategori = $this->request->getVar('kategori');
        if ($selectedKategori) {
            $query->where('tbl_m_item.id_kategori', $selectedKategori);
        }

        // Filter by merk
        $selectedMerk = $this->request->getVar('merk');
        if ($selectedMerk) {
            $query->where('tbl_m_item.id_merk', $selectedMerk);
        }

        // Filter by item name/code/alias
        $item = $this->request->getVar('item');
        if ($item) {
            $query->groupStart()
                ->like('tbl_m_item.item', $item)
                ->orLike('tbl_m_item.kode', $item)
                ->orLike('tbl_m_item.item_alias', $item)
                ->groupEnd();
        }

        // Filter by harga_beli
        $hargaBeli = $this->request->getVar('harga_beli');
        if ($hargaBeli) {
            $hargaBeli = format_angka_db($hargaBeli);
            $query->where('tbl_m_item.harga_beli', $hargaBeli);
        }

        // Filter by status
        $selectedStatus = $this->request->getVar('status');
        if ($selectedStatus !== null && $selectedStatus !== '') {
            $query->where('tbl_m_item.status', $selectedStatus);
        }

        $data = [
            'title'           => 'Data Obat',
            'Pengaturan'      => $this->pengaturan,
            'user'            => $this->ionAuth->user()->row(),
            'obat'            => $query->paginate($perPage, 'obat'),
            'pager'           => $this->itemModel->pager,
            'currentPage'     => $currentPage,
            'perPage'         => $perPage,
            'kategoriList'    => $kategoriList,
            'selectedKategori'=> $selectedKategori,
            'merkList'        => $merkList,
            'selectedMerk'    => $selectedMerk,
            'selectedStatus'  => $selectedStatus,
            'trashCount'      => $this->itemModel->countDeleted(),
            'breadcrumbs'     => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Obat</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/obat/index', $data);
    }

    public function create()
    {
        $satuan = $this->satuanModel->where('status', '1')->findAll();

        $data = [
            'title'         => 'Form Obat',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'validation'    => $this->validation,
            'satuan'        => $satuan,
            'kategori'      => $this->kategoriModel->where('status', '1')->findAll(),
            'merk'          => $this->merkModel->where('status', '1')->findAll(),
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/obat') . '">Obat</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/obat/create', $data);
    }

    public function store()
    {
        // Validation rules
        $rules = [
            env('security.tokenName') => [
                'rules' => 'required',
                'errors' => [
                    'required' => env('csrf.name') . ' harus diisi'
                ]
            ],
            'item' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Nama obat harus diisi',
                    'max_length' => 'Nama obat maksimal 160 karakter'
                ]
            ],
            'id_satuan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Satuan harus dipilih',
                    'integer' => 'Satuan tidak valid'
                ]
            ],
            'id_kategori' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Kategori harus dipilih',
                    'integer' => 'Kategori tidak valid'
                ]
            ],
            'id_merk' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Merk harus dipilih',
                    'integer' => 'Merk tidak valid'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Harga beli harus diisi',
                    'numeric' => 'Harga beli harus berupa angka',
                    'greater_than_equal_to' => 'Harga beli tidak boleh negatif'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Harga jual harus diisi',
                    'numeric' => 'Harga jual harus berupa angka',
                    'greater_than_equal_to' => 'Harga jual tidak boleh negatif'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Validasi gagal');
        }

        $data = [
            'kode'          => $this->itemModel->generateKode(),
            'item'          => $this->request->getPost('item'),
            'item_alias'    => $this->request->getPost('item_alias'),
            'item_kand'     => $this->request->getPost('item_kand'),
            'barcode'       => $this->request->getPost('barcode'),
            'id_satuan'     => $this->request->getPost('id_satuan'),
            'id_kategori'   => $this->request->getPost('id_kategori'),
            'id_merk'       => $this->request->getPost('id_merk'),
            'jml'           => $this->request->getPost('jml') ?? 0,
            'harga_beli'    => format_angka_db($this->request->getPost('harga_beli')) ?? 0,
            'harga_jual'    => format_angka_db($this->request->getPost('harga_jual')) ?? 0,
            'status'        => $this->request->getPost('status'),
            'status_stok'   => $this->request->getPost('status_stok') ?? '0',
            'status_racikan'=> $this->request->getPost('status_racikan') ?? '0',
            'status_item'   => 1, // 1 = Obat
            'id_user'       => $this->ionAuth->user()->row()->id
        ];

        if ($this->itemModel->insert($data)) {
            $lastInsertId = $this->itemModel->getInsertID();

            // If stockable, create initial stock entries for active warehouses
            if ($data['status_stok'] == '1') {
                $gudangAktif = $this->gudangModel->where('status', '1')->findAll();

                foreach ($gudangAktif as $gudang) {
                    // Check if stock entry already exists for this warehouse and item
                    $existingStok = $this->itemStokModel->where([
                        'id_gudang' => $gudang->id,
                        'id_item'   => $lastInsertId
                    ])->first();

                    // Only create new stock entry if it doesn't exist
                    if (!$existingStok) {
                        $stokData = [
                            'id_gudang'  => $gudang->id,
                            'id_item'    => $lastInsertId,
                            'id_satuan'  => $data['id_satuan'],
                            'jml'        => 0,
                            'status'     => $gudang->status
                        ];

                        $this->itemStokModel->insert($stokData);
                    }
                }
            }
            
            return redirect()->to(base_url('master/obat'))
                ->with('success', 'Data obat berhasil ditambahkan');
        }

        return redirect()->back()
            ->with('error', 'Gagal menambahkan data obat')
            ->withInput();
    }

    public function edit($id)
    {
        $data = [
            'title'         => 'Form Obat',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'validation'    => $this->validation,
            'satuan'        => $this->satuanModel->findAll(),
            'kategori'      => $this->kategoriModel->findAll(),
            'merk'          => $this->merkModel->findAll(),
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/obat') . '">Obat</a></li>
                <li class="breadcrumb-item active">Edit</li>
            '
        ];

        $data['obat'] = $this->itemModel->getItemWithRelations($id);

        if (empty($data['obat'])) {
            return redirect()->to(base_url('master/obat'))
                ->with('error', 'Data obat tidak ditemukan');
        }

        return view($this->theme->getThemePath() . '/master/obat/edit', $data);
    }

    public function update($id)
    {
        // Validation rules
        $rules = [
            'item' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Nama obat harus diisi',
                    'max_length' => 'Nama obat maksimal 160 karakter'
                ]
            ],
            'id_satuan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Satuan harus dipilih',
                    'integer' => 'Satuan tidak valid'
                ]
            ],
            env('security.tokenName', 'csrf_test_name') => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'CSRF token tidak valid'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Validasi gagal');
        }

        $data = [
            'item'          => $this->request->getPost('item'),
            'item_alias'    => $this->request->getPost('item_alias'),
            'item_kand'     => $this->request->getPost('item_kand'),
            'barcode'       => $this->request->getPost('barcode'),
            'id_satuan'     => $this->request->getPost('id_satuan'),
            'id_kategori'   => $this->request->getPost('id_kategori'),
            'id_merk'       => $this->request->getPost('id_merk'),
            'jml_min'       => $this->request->getPost('jml_min') ?? 0,
            'jml_limit'     => $this->request->getPost('jml_limit') ?? 0,
            'harga_beli'    => format_angka_db($this->request->getPost('harga_beli')) ?? 0,
            'harga_jual'    => format_angka_db($this->request->getPost('harga_jual')) ?? 0,
            'status'        => $this->request->getPost('status'),
            'status_stok'   => $this->request->getPost('status_stok') ?? '0',
            'status_racikan'=> $this->request->getPost('status_racikan') ?? '0'
        ];

        $lastInsertId = $id;

        if ($this->itemModel->update($id, $data)) {
            // If stockable, create initial stock entries for active warehouses
            if ($data['status_stok'] == '1') {
                $gudangAktif = $this->gudangModel->where('status', '1')->findAll();

                foreach ($gudangAktif as $gudang) {
                    // Check if stock entry already exists for this warehouse and item
                    $existingStok = $this->itemStokModel->where([
                        'id_gudang' => $gudang->id,
                        'id_item'   => $lastInsertId
                    ])->first();

                    // Only create new stock entry if it doesn't exist
                    if (!$existingStok) {
                        $stokData = [
                            'id_gudang'  => $gudang->id,
                            'id_item'    => $lastInsertId,
                            'id_satuan'  => $data['id_satuan'],
                            'jml'        => 0,
                            'status'     => $gudang->status
                        ];

                        $this->itemStokModel->insert($stokData);
                    }
                }
            }

            return redirect()->to(base_url('master/obat'))
                ->with('success', 'Data obat berhasil diubah');
        }

        return redirect()->back()
            ->with('error', 'Gagal mengupdate data obat')
            ->withInput();
    }

    public function delete($id)
    {
        // Start transaction
        $this->db->transStart();

        try {
            // Soft delete the item
            $this->itemModel->delete($id);

            $this->db->transCommit();
            
            return redirect()->to(base_url('master/obat'))
                ->with('success', 'Data obat berhasil dihapus');
        } catch (\Exception $e) {
            $this->db->transRollback();
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus data obat');
        }
    }

    public function delete_permanent($id)
    {
        // Start transaction
        $this->db->transStart();

        try {
            // Permanently delete the item
            $this->itemModel->delete($id, true);
            $this->db->transCommit();
            
            return redirect()->to(base_url('master/obat/trash'))
                ->with('success', 'Data obat berhasil dihapus permanen');
        } catch (\Exception $e) {
            $this->db->transRollback();
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus permanen data obat');
        }
    }

    public function trash()
    {
        $currentPage = $this->request->getVar('page_obat') ?? 1;
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;
        $keyword = $this->request->getVar('keyword');
        $builder = $this->itemModel->getDeletedObat();

        if ($keyword) {
            $builder->groupStart()
                ->like('tbl_m_item.item', $keyword)
                ->orLike('tbl_m_item.kode', $keyword)
                ->orLike('tbl_m_item.barcode', $keyword)
                ->orLike('tbl_m_item.item_alias', $keyword)
                ->groupEnd();
        }

        // Get total rows for pagination
        $total = $builder->countAllResults(false);  // false to not reset the query builder

        // Get paginated results
        $obat = $builder->limit($perPage, $offset)->get()->getResult();

        // Create pager
        $pager = service('pager');
        $pager->setPath('master/obat/trash');
        $pager->makeLinks($currentPage, $perPage, $total, 'adminlte_pagination');

        $data = [
            'title'         => 'Data Obat Terhapus',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'obat'          => $obat,
            'pager'         => $pager,
            'currentPage'   => $currentPage,
            'perPage'       => $perPage,
            'total'         => $total,
            'keyword'       => $keyword,
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/obat') . '">Obat</a></li>
                <li class="breadcrumb-item active">Sampah</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/obat/trash', $data);
    }

    public function restore($id)
    {
        // Start transaction
        $this->db->transStart();

        try {            
            // Restore the item
            $this->itemModel->update($id, [
                'status_hps' => '0',
                'deleted_at' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->db->transCommit();
            
            return redirect()->to(base_url('master/obat/trash'))
                ->with('success', 'Data obat berhasil dipulihkan');
        } catch (\Exception $e) {
            $this->db->transRollback();
            
            return redirect()->back()
                ->with('error', 'Gagal memulihkan data obat');
        }
    }
} 