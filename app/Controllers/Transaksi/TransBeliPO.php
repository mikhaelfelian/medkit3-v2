<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-29
 * 
 * TransBeliPO Controller
 * 
 * Controller for managing Purchase Orders
 */

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\TransBeliPOModel;
use App\Models\TransBeliPODetModel;
use App\Models\ItemModel;
use App\Models\SupplierModel;
use App\Models\PengaturanModel;
use App\Models\SatuanModel;
use FPDF;

class TransBeliPO extends BaseController
{
    protected $transBeliPOModel;
    protected $transBeliPODetModel;
    protected $itemModel;
    protected $supplierModel;
    protected $pengaturanModel;
    protected $satuanModel;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->transBeliPOModel = new TransBeliPOModel();
        $this->transBeliPODetModel = new TransBeliPODetModel();
        $this->itemModel = new ItemModel();
        $this->supplierModel = new SupplierModel();
        $this->pengaturanModel = new PengaturanModel();
        $this->satuanModel = new SatuanModel();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Display list of purchase orders
     */
    public function index()
    {
        $filters = [
            'supplier' => $this->request->getGet('supplier'),
            'status'   => $this->request->getGet('status'),
            'q'        => $this->request->getGet('q')
        ];

        $data = [
            'title'         => 'Data Purchase Order',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'po_list'       => $this->transBeliPOModel->getWithRelations($filters)->paginate(10, 'po'),
            'pager'         => $this->transBeliPOModel->pager,
            'suppliers'     => $this->supplierModel->where('status_hps', '0')->findAll(),
            'filters'       => $filters,
            'validation'    => $this->validation,
            'request'       => $this->request,
            'transBeliPOModel' => $this->transBeliPOModel
        ];

        return $this->view($this->theme->getThemePath() . '/transaksi/po/index', $data);
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

        return $this->view($this->theme->getThemePath() . '/transaksi/po/trans_po', $data);
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
    public function edit($id = null)
    {
        // try {
            // Get PO data
            $po = $this->transBeliPOModel->find($id);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Get PO items
            $items = $this->transBeliPODetModel->where('id_pembelian', $id)->findAll();

            $data = [
                'title'      => 'Edit Purchase Order',
                'Pengaturan' => $this->pengaturan,
                'user'       => $this->ionAuth->user()->row(),
                'po'         => $po,
                'po_details' => $items,
                'suppliers'  => $this->supplierModel->where('status_hps', '0')->findAll(),
                'satuans'    => $this->satuanModel->findAll(),
                'validation' => $this->validation
            ];

            return $this->view($this->theme->getThemePath() . '/transaksi/po/edit', $data);

        // } catch (\Exception $e) {
        //     log_message('error', '[TransBeliPO::edit] ' . $e->getMessage());
        //     return redirect()->back()
        //                    ->with('error', 'Gagal memuat form edit PO');
        // }
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

    /**
     * Display purchase order details
     */
    public function detail($id)
    {
        try {
            $po = $this->transBeliPOModel->getWithRelations(['tbl_trans_beli_po.id' => $id]);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Get PO items
            $items = $this->transBeliPODetModel->getWithRelations($id);

            $data = [
                'title'         => 'Detail Purchase Order',
                'Pengaturan'    => $this->pengaturan,
                'user'          => $this->ionAuth->user()->row(),
                'po'            => $po,
                'items'         => $items
            ];

            return $this->view($this->theme->getThemePath() . '/transaksi/po/detail', $data);

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::detail] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal memuat detail PO');
        }
    }

    /**
     * Add item to PO cart
     * 
     * @param int $po_id The PO ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function cart_add($po_id = null)
    {
        try {
            // Validate PO ID
            if (!$po_id) {
                throw new \RuntimeException('ID PO tidak valid');
            }

            // Check if PO exists and is editable
            $po = $this->transBeliPOModel->find($po_id);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }
            if ($po->status != 0) {
                throw new \RuntimeException('PO tidak dapat diubah');
            }

            // Validate input
            $rules = [
                'id_item' => [
                    'label' => 'Item',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ],
                'jumlah' => [
                    'label' => 'Jumlah',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} harus berupa angka',
                        'greater_than' => '{field} harus lebih dari 0'
                    ]
                ],
                'satuan' => [
                    'label' => 'Satuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                               ->withInput()
                               ->with('errors', $this->validator->getErrors());
            }

            // Get validated data
            $item_id    = $this->request->getPost('id_item');
            $jumlah     = $this->request->getPost('jumlah');
            $satuan     = $this->request->getPost('satuan');
            $keterangan = $this->request->getPost('keterangan');

            // Check if item exists
            $item = $this->itemModel->find($item_id);
            if (!$item) {
                throw new \RuntimeException('Item tidak ditemukan');
            }

            $satuan = $this->satuanModel->find($satuan);
            if (!$satuan) {
                throw new \RuntimeException('Satuan tidak ditemukan');
            }

            // Begin transaction
            $this->db->transBegin();

            // Add item to PO detail
            $data = [
                'id_pembelian' => $po_id,
                'id_item'      => $item_id,
                'id_satuan'    => $satuan->id,
                'id_user'      => $this->ionAuth->user()->row()->id,
                'tgl_masuk'    => $po->tgl_masuk,
                'kode'         => $item->kode,
                'item'         => $item->item,
                'jml'          => (int)$jumlah,
                'jml_satuan'   => (int)$satuan->jml,
                'satuan'       => $satuan->satuanBesar,
                'keterangan'   => $keterangan
            ];

            if (!$this->transBeliPODetModel->insert($data)) {
                throw new \RuntimeException('Gagal menambahkan item');
            }

            // Commit transaction
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                throw new \RuntimeException('Gagal menambahkan item');
            }
            $this->db->transCommit();

            return redirect()->back()
                           ->with('success', 'Item berhasil ditambahkan');
        } catch (\Exception $e) {
            // Log error
            log_message('error', '[TransBeliPO::cart_add] ' . $e->getMessage());
            
            // Rollback transaction if active
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
            }

            return redirect()->back()
                           ->withInput()
                           ->with('error', ENVIRONMENT === 'development' ? $e->getMessage() : 'Gagal menambahkan item');
        }
    }

    /**
     * Generate PDF for purchase order
     * 
     * @param int $id PO ID
     */
    public function pdf_po($id = null)
    {
        try {
            // Get PO data
            $po = $this->transBeliPOModel->getWithRelations(['tbl_trans_beli_po.id' => $id]);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Get PO items
            $items = $this->transBeliPODetModel->getWithRelations($id);

            // Create PDF instance
            $pdf = new \FPDF('P', 'mm', 'A4');
            $pdf->AddPage();
            
            // Set font
            $pdf->SetFont('Arial', 'B', 16);
            
            // Header
            $pdf->Cell(0, 10, 'PURCHASE ORDER', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'No: ' . $po->no_nota, 0, 1, 'C');
            $pdf->Ln(10);
            
            // PO Information
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 7, 'Tanggal PO', 0);
            $pdf->Cell(5, 7, ':', 0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 7, date('d/m/Y', strtotime($po->tgl_masuk)), 0);
            $pdf->Ln();
            
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 7, 'Supplier', 0);
            $pdf->Cell(5, 7, ':', 0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 7, $po->supplier_name, 0);
            $pdf->Ln();
            
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 7, 'Pengiriman', 0);
            $pdf->Cell(5, 7, ':', 0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 7, $po->pengiriman);
            $pdf->Ln(5);
            
            // Items Table Header
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 7, 'No', 1, 0, 'C');
            $pdf->Cell(80, 7, 'Item', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Satuan', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Keterangan', 1, 1, 'C');
            
            // Items Table Content
            $pdf->SetFont('Arial', '', 10);
            $no = 1;
            foreach ($items as $item) {
                $pdf->Cell(10, 7, $no++, 1, 0, 'C');
                $pdf->Cell(80, 7, $item->item_name, 1, 0, 'L');
                $pdf->Cell(30, 7, $item->jml, 1, 0, 'C');
                $pdf->Cell(30, 7, $item->satuan_name, 1, 0, 'C');
                $pdf->Cell(40, 7, $item->keterangan, 1, 1, 'L');
            }
            
            // Footer
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 7, 'Keterangan: ' . $po->keterangan, 0, 1);
            $pdf->Ln(10);
            
            // Signatures
            $pdf->Cell(63, 7, 'Dibuat Oleh,', 0, 0, 'C');
            $pdf->Cell(63, 7, 'Diperiksa Oleh,', 0, 0, 'C');
            $pdf->Cell(63, 7, 'Disetujui Oleh,', 0, 1, 'C');
            
            $pdf->Ln(20);
            
            $pdf->Cell(63, 7, '(________________)', 0, 0, 'C');
            $pdf->Cell(63, 7, '(________________)', 0, 0, 'C');
            $pdf->Cell(63, 7, '(________________)', 0, 1, 'C');
            
            // Set headers for PDF download
            $response = service('response');
            $response->setHeader('Content-Type', 'application/pdf');
            $response->setHeader('Content-Disposition', 'inline; filename="PO_' . $po->no_nota . '.pdf"');
            
            // Output PDF
            $pdf->Output('PO_' . $po->no_nota . '.pdf', 'I');
            exit();

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::pdf_po] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal membuat PDF Purchase Order');
        }
    }

    /**
     * Delete PO
     */
    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to('transaksi/po')
                           ->with('error', 'ID PO tidak ditemukan');
        }

        try {
            $po = $this->transBeliPOModel->find($id);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Only allow deletion of draft POs
            if ($po->status != 0) {
                throw new \RuntimeException('Hanya PO draft yang dapat dihapus');
            }

            // Start transaction
            $this->db->transStart();

            // Delete PO details first
            $this->transBeliPODetModel->where('id_pembelian', $id)->delete();

            // Delete PO
            $this->transBeliPOModel->delete($id);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Gagal menghapus PO');
            }

            return redirect()->to('transaksi/po')
                           ->with('success', 'PO berhasil dihapus');

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::delete] ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', $e->getMessage());
        }
    }

    /**
     * Update PO status
     */
    public function updateStatus($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID PO tidak ditemukan'
            ]);
        }

        try {
            $po = $this->transBeliPOModel->find($id);
            if (!$po) {
                throw new \RuntimeException('Data PO tidak ditemukan');
            }

            // Check if PO has items
            $itemCount = $this->transBeliPODetModel->where('id_pembelian', $id)->countAllResults();
            if ($itemCount === 0) {
                throw new \RuntimeException('PO tidak memiliki item');
            }

            // Update status
            $status = $this->request->getPost('status');
            if (!$this->transBeliPOModel->update($id, ['status' => $status])) {
                throw new \RuntimeException('Gagal mengupdate status PO');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status PO berhasil diupdate'
            ]);

        } catch (\Exception $e) {
            log_message('error', '[TransBeliPO::updateStatus] ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
} 