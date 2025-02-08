<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * MedTrans Controller
 * Handles medical record transaction operations
 */

namespace App\Controllers\Medrecords;

use App\Controllers\BaseController;
use App\Models\MedTransModel;
use App\Models\MedTransDetModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\MedDaftarModel;

class MedTrans extends BaseController
{
    protected $medTransModel;
    protected $medTransDetModel;
    protected $pasienModel;
    protected $poliModel;
    protected $medDaftarModel;

    public function __construct()
    {
        $this->medTransModel = new MedTransModel();
        $this->medTransDetModel = new MedTransDetModel();
        $this->pasienModel = new PasienModel();
        $this->poliModel = new PoliModel();
        $this->medDaftarModel = new MedDaftarModel();
        
        helper(['form', 'url', 'tanggalan', 'general']);
    }

    public function create($id = null)
    {
        if ($id === null) {
            return redirect()->to('medrecords/antrian')->with('error', 'Data pendaftaran tidak ditemukan');
        }

        // Get registration data
        $daftar = $this->medDaftarModel->find($id);
        if (!$daftar) {
            return redirect()->to('medrecords/antrian')->with('error', 'Data pendaftaran tidak ditemukan');
        }

        // Get patient data
        $pasien = $this->pasienModel->find($daftar->id_pasien);
        if (!$pasien) {
            return redirect()->to('medrecords/antrian')->with('error', 'Data pasien tidak ditemukan');
        }

        $data = [
            'title' => 'Form Medical Checkup',
            'Pengaturan'    => $this->pengaturan,
            'user' => $this->ionAuth->user()->row(),
            'daftar' => $daftar,
            'pasien' => $pasien,
            'poliModel' => $this->poliModel,
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Medical Records</li>
                <li class="breadcrumb-item active">Form Medical Checkup</li>
            '
        ];

        return view($this->theme->getThemePath() . '/medrecords/med_trans', $data);
    }

    /**
     * Display list of medical record transactions
     */
    public function index()
    {
        $currentPage = $this->request->getVar('page') ?? 1;
        $perPage = $this->pengaturan->pagination_limit ?? 10;

        // Get transactions with joins
        $query = $this->medTransModel
            ->select('tbl_trans_medrecs.*, tbl_m_poli.poli, tbl_pendaftaran.no_urut')
            ->join('tbl_m_poli', 'tbl_m_poli.id = tbl_trans_medrecs.id_poli', 'left')
            ->join('tbl_pendaftaran', 'tbl_pendaftaran.id = tbl_trans_medrecs.id_dft', 'left')
            ->orderBy('tbl_trans_medrecs.created_at', 'DESC');

        $data = [
            'title' => 'Data Medical Records',
            'Pengaturan' => $this->pengaturan,
            'user' => $this->ionAuth->user()->row(),
            'medrecs' => $query->paginate($perPage),
            'pager' => $this->medTransModel->pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'breadcrumbs' => '
                <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                <li class="breadcrumb-item">Medical Records</li>
                <li class="breadcrumb-item active">Data Medical Records</li>
            '
        ];

        return view($this->theme->getThemePath() . '/medrecords/med_trans_index', $data);
    }

    /**
     * Store medical record transaction
     */
    public function store()
    {
        try {
            $this->medTransModel->db->transBegin();

            // Get form data
            $data = [
                'id_user' => $this->ionAuth->user()->row()->id,
                'id_dokter' => $this->request->getPost('id_dokter'),
                'id_pasien' => $this->request->getPost('id_pasien'),
                'id_poli' => $this->request->getPost('id_poli'),
                'id_dft' => $this->request->getPost('id_dft'),
                'tgl_masuk' => date('Y-m-d H:i:s'),
                'keluhan' => $this->request->getPost('keluhan'),
                'ttv_st' => $this->request->getPost('ttv_st'),
                'ttv_bb' => $this->request->getPost('ttv_bb'), 
                'ttv_tb' => $this->request->getPost('ttv_tb'),
                'ttv_sistole' => $this->request->getPost('ttv_sistole'),
                'ttv_diastole' => $this->request->getPost('ttv_diastole'),
                'ttv_nadi' => $this->request->getPost('ttv_nadi'),
                'ttv_laju' => $this->request->getPost('ttv_laju'),
                'ttv_saturasi' => $this->request->getPost('ttv_saturasi'),
                'ttv_skala' => $this->request->getPost('ttv_skala'),
                'tipe' => $this->request->getPost('tipe'),
                'status' => '1' // Set initial status to anamnesa
            ];

            // Get registration data
            $daftar = $this->medDaftarModel->find($data['id_dft']);
            if ($daftar) {
                $data['no_rm'] = $daftar->no_rm;
                $data['pasien'] = $daftar->nama_pgl;
                $data['pasien_alamat'] = $daftar->alamat;
                $data['pasien_nik'] = $daftar->nik;
                $data['tipe_bayar'] = $daftar->tipe_bayar;
            }

            // Get poli data
            $poli = $this->poliModel->find($data['id_poli']);
            if ($poli) {
                $data['poli'] = $poli->poli;
            }

            // Handle file upload if any
            $file = $this->request->getFile('upload_foto');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/medrecs', $newName);
                $data['pemeriksaan'] = 'uploads/medrecs/' . $newName;
            }

            // Insert data
            $this->medTransModel->insert($data);

            // Update registration status
            $this->medDaftarModel->update($data['id_dft'], [
                'status_periksa' => '1'
            ]);

            $this->medTransModel->db->transCommit();

            return redirect()->to('medrecords/trans')
                ->with('success', 'Data pemeriksaan berhasil disimpan');

        } catch (\Exception $e) {
            $this->medTransModel->db->transRollback();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
} 