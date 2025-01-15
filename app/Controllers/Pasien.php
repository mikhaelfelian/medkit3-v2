<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-14
 * 
 * Pasien Controller
 * 
 * Controller for managing patient data
 */

namespace App\Controllers;

use App\Models\PasienModel;
use App\Models\GelarModel;
use App\Models\PengaturanModel;
use App\Helpers\image_helper;

class Pasien extends BaseController
{
    protected $pasienModel;
    protected $validation;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->gelar = new GelarModel();
        $this->pengaturan = new PengaturanModel();
        $this->validation = \Config\Services::validation();
        
        helper(['image', 'tanggalan']);
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_pasien') ?? 1;

        // Get pagination limit from settings 
        $perPage = $this->pengaturan->pagination_limit ?? 10;

        // Start with the model query
        $query = $this->pasienModel;

        // Filter by name/code/nik
        $search = $this->request->getVar('search');
        if ($search) {
            $query->groupStart()
                ->like('nama', $search)
                ->orLike('kode', $search)
                ->orLike('nik', $search)
                ->groupEnd();
        }

        // Filter by status
        $selectedStatus = $this->request->getVar('status');
        if ($selectedStatus !== null && $selectedStatus !== '') {
            $query->where('status', $selectedStatus);
        }

        $data = [
            'title' => 'Data Pasien',
            'Pengaturan' => $this->pengaturan,
            'pasiens' => $query->paginate($perPage, 'pasien'),
            'pager' => $this->pasienModel->pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'search' => $search,
            'selectedStatus' => $selectedStatus,
            'trashCount' => $this->pasienModel->getTrashCount(),
            'user' => $this->ionAuth->user()->row(),
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Pasien</li>
            ',
            'page' => $currentPage
        ];

        return view($this->theme->getThemePath() . '/master/pasien/index', $data);
    }

    /**
     * Show create form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pasien',
            'Pengaturan' => $this->pengaturan,
            'user' => $this->ionAuth->user()->row(),
            'validation' => $this->validation,
            'gelars' => $this->gelar->findAll(),
            'pasien' => $this->pasienModel->generateKode(),
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/pasien') . '">Pasien</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/pasien/create', $data);
    }

    /**
     * Store new patient data
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'id_gelar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gelar harus dipilih'
                ]
            ],
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIK harus diisi',
                ]
            ],
            'nama' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Nama maksimal 160 karakter'
                ]
            ],
            'jns_klm' => [
                'rules' => 'required|in_list[L,P]',
                'errors' => [
                    'required' => 'Jenis kelamin harus dipilih',
                    'in_list' => 'Jenis kelamin tidak valid'
                ]
            ],
            'tmp_lahir' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi',
                    'max_length' => 'Tempat lahir maksimal 100 karakter'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal lahir harus diisi',
                    'valid_date' => 'Format tanggal lahir tidak valid'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|min_length[10]|max_length[15]|numeric',
                'errors' => [
                    'required' => 'No HP harus diisi',
                    'min_length' => 'No HP minimal 10 digit',
                    'max_length' => 'No HP maksimal 15 digit',
                    'numeric' => 'No HP harus berupa angka'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation_errors', $this->validator->getErrors())
                ->with('error', 'Validasi gagal. Silakan periksa kembali input Anda.');
        }

        $this->db->transStart();
        
        try {
            // Get fullname with title
            $gelar      = $this->gelar->find($this->request->getPost('id_gelar'));
            $nama_pgl   = strtoupper($gelar->gelar . ' ' . $this->request->getPost('nama'));
            $no_rm      = $this->pasienModel->generateKode();

            // Base paths
            $base_path      = FCPATH . '/file/pasien';
            $patient_path   = $base_path . '/' . strtolower($no_rm);

            $data = [
                'kode'             => $no_rm,
                'id_gelar'         => $this->request->getPost('id_gelar'),
                'id_user'          => $this->ionAuth->user()->row()->id,
                'nik'              => $this->request->getPost('nik'),
                'nama'             => strtoupper($this->request->getPost('nama')),
                'nama_pgl'         => $nama_pgl,
                'jns_klm'          => $this->request->getPost('jns_klm'),
                'tmp_lahir'        => $this->request->getPost('tmp_lahir'),
                'tgl_lahir'        => tgl_indo_sys($this->request->getPost('tgl_lahir')),
                'no_hp'            => $this->request->getPost('no_hp'),
                'alamat'           => $this->request->getPost('alamat'),
                'alamat_domisili'  => $this->request->getPost('alamat_domisili'),
                'rt'               => $this->request->getPost('rt'),
                'rw'               => $this->request->getPost('rw'),
                'kelurahan'        => $this->request->getPost('kelurahan'),
                'kecamatan'        => $this->request->getPost('kecamatan'),
                'kota'             => $this->request->getPost('kota'),
                'pekerjaan'        => $this->request->getPost('pekerjaan'),
                'status'           => '1',
                'status_hps'       => '0'
            ];

            // Process patient photo
            if ($foto_pasien = $this->request->getPost('foto_pasien')) {
                if (strpos($foto_pasien, 'data:image') === false) {
                    throw new \Exception('Invalid patient photo format');
                }

                $prefix_foto = 'profile_';

                $filename = base64_to_image(
                    $foto_pasien,
                    $patient_path,
                    $prefix_foto,
                    strtolower($no_rm)
                );

                if (!$filename) {
                    throw new \Exception('Failed to save patient photo');
                }

                $filePath = 'public/file/pasien/'.$no_rm.'/' . $prefix_foto . $no_rm.'.png';
                // if (file_exists($filePath)) {
                    $data['file_foto'] = $filePath;
                // }
            }

            // Process KTP photo
            if ($foto_ktp = $this->request->getPost('foto_ktp')) {
                if (strpos($foto_ktp, 'data:image') === false) {
                    throw new \Exception('Invalid KTP photo format');
                }

                $prefix_ktp = 'ktp_';

                $filename = base64_to_image(
                    $foto_ktp,
                    $patient_path,
                    $prefix_ktp,
                    strtolower($no_rm)
                );

                if (!$filename) {
                    throw new \Exception('Failed to save KTP photo');
                }

                $filePath = 'public/file/pasien/'.$no_rm.'/' . $prefix_ktp . $no_rm . '.png';
                // if (file_exists($filePath)) {
                    $data['file_ktp'] = $filePath;
                // }
            }

            if (!$this->pasienModel->insert($data)) {
                throw new \Exception('Failed to save patient data');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return redirect()->to(base_url('master/pasien'))
                ->with('success', 'Patient data added successfully');
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[Pasien::store] ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', ENVIRONMENT === 'development' ? $e->getMessage() : 'Failed to save patient data');
        }
    }

    /**
     * Show edit form
     * 
     * @param int $id Patient ID
     */
    public function edit($id)
    {
        $pasien = $this->pasienModel->find($id);
        if (!$pasien) {
            return redirect()->to(base_url('master/pasien'))
                ->with('error', 'Data pasien tidak ditemukan');
        }

        $data = [
            'title'         => 'Edit Data Pasien',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'validation'    => $this->validation,
            'gelars'        => $this->gelar->findAll(),
            'pasien'        => $pasien,
            'breadcrumbs'   => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item"><a href="' . base_url('master/pasien') . '">Pasien</a></li>
                <li class="breadcrumb-item active">Edit</li>
            '
        ];

        return view($this->theme->getThemePath() . '/master/pasien/edit', $data);
    }

    /**
     * Update patient data
     * 
     * @param int $id Patient ID
     */
    public function update($id)
    {
        // Validation rules
        $rules = [
            'id_gelar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gelar harus dipilih'
                ]
            ],
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIK harus diisi',
                ]
            ],
            'nama' => [
                'rules' => 'required|max_length[160]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Nama maksimal 160 karakter'
                ]
            ],
            'jns_klm' => [
                'rules' => 'required|in_list[L,P]',
                'errors' => [
                    'required' => 'Jenis kelamin harus dipilih',
                    'in_list' => 'Jenis kelamin tidak valid'
                ]
            ],
            'tmp_lahir' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi',
                    'max_length' => 'Tempat lahir maksimal 100 karakter'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal lahir harus diisi',
                    'valid_date' => 'Format tanggal lahir tidak valid'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|min_length[10]|max_length[15]|numeric',
                'errors' => [
                    'required' => 'No HP harus diisi',
                    'min_length' => 'No HP minimal 10 digit',
                    'max_length' => 'No HP maksimal 15 digit',
                    'numeric' => 'No HP harus berupa angka'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation_errors', $this->validator->getErrors())
                ->with('error', 'Validasi gagal. Silakan periksa kembali input Anda.');
        }

        $this->db->transStart();
        
        try {
            $pasien = $this->pasienModel->find($id);
            if (!$pasien) {
                throw new \Exception('Data pasien tidak ditemukan');
            }

            // Get fullname with title
            $gelar      = $this->gelar->find($this->request->getPost('id_gelar'));
            $nama_pgl   = strtoupper($gelar->gelar . ' ' . $this->request->getPost('nama'));

            // Base paths
            $base_path      = FCPATH . '/file/pasien';
            $patient_path   = $base_path . '/' . strtolower($pasien->kode);

            $data = [
                'id_gelar'         => $this->request->getPost('id_gelar'),
                'id_user'          => $this->ionAuth->user()->row()->id,
                'nik'              => $this->request->getPost('nik'),
                'nama'             => strtoupper($this->request->getPost('nama')),
                'nama_pgl'         => $nama_pgl,
                'jns_klm'          => $this->request->getPost('jns_klm'),
                'tmp_lahir'        => $this->request->getPost('tmp_lahir'),
                'tgl_lahir'        => tgl_indo_sys($this->request->getPost('tgl_lahir')),
                'no_hp'            => $this->request->getPost('no_hp'),
                'alamat'           => $this->request->getPost('alamat'),
                'alamat_domisili'  => $this->request->getPost('alamat_domisili'),
                'rt'               => $this->request->getPost('rt'),
                'rw'               => $this->request->getPost('rw'),
                'kelurahan'        => $this->request->getPost('kelurahan'),
                'kecamatan'        => $this->request->getPost('kecamatan'),
                'kota'             => $this->request->getPost('kota'),
                'pekerjaan'        => $this->request->getPost('pekerjaan')
            ];

            // Process patient photo
            if ($foto_pasien = $this->request->getPost('foto_pasien')) {
                if (strpos($foto_pasien, 'data:image') === false) {
                    throw new \Exception('Invalid patient photo format');
                }

                $prefix_foto = 'profile_';
                $filename = base64_to_image(
                    $foto_pasien,
                    $patient_path,
                    $prefix_foto,
                    strtolower($pasien->kode)
                );

                if (!$filename) {
                    throw new \Exception('Failed to save patient photo');
                }

                $data['file_foto'] = 'public/file/pasien/'.$pasien->kode.'/' . $prefix_foto . $pasien->kode . '.png';
            }

            // Process KTP photo
            if ($foto_ktp = $this->request->getPost('foto_ktp')) {
                if (strpos($foto_ktp, 'data:image') === false) {
                    throw new \Exception('Invalid KTP photo format');
                }

                $prefix_ktp = 'ktp_';
                $filename = base64_to_image(
                    $foto_ktp,
                    $patient_path,
                    $prefix_ktp,
                    strtolower($pasien->kode)
                );

                if (!$filename) {
                    throw new \Exception('Failed to save KTP photo');
                }

                $data['file_ktp'] = 'public/file/pasien/'.$pasien->kode.'/' . $prefix_ktp . $pasien->kode . '.png';
            }

            if (!$this->pasienModel->update($id, $data)) {
                throw new \Exception('Failed to update patient data');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return redirect()->to(base_url('master/pasien'))
                ->with('success', 'Data pasien berhasil diperbarui');

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[Pasien::update] ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', ENVIRONMENT === 'development' ? $e->getMessage() : 'Failed to update patient data');
        }
    }
}