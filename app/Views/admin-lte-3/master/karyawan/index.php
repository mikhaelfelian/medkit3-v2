<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-17
 * 
 * Karyawan Index View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url('master/karyawan/create') ?>" class="btn btn-sm btn-primary rounded-0">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="<?= base_url('master/karyawan/export') ?>?<?= $_SERVER['QUERY_STRING'] ?>"
                    class="btn btn-sm btn-success rounded-0">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?= form_open('master/karyawan', ['method' => 'get']) ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-left">Kode</th>
                        <th class="text-left">Nama</th>
                        <th class="text-center">L/P</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <?= form_input([
                                'name' => 'search',
                                'value' => $search,
                                'class' => 'form-control form-control-sm rounded-0',
                                'placeholder' => 'Cari...'
                            ]) ?>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-center">
                            <?= form_dropdown(
                                'status',
                                [
                                    '' => '- Semua -',
                                    '1' => 'Perawat',
                                    '2' => 'Dokter',
                                    '3' => 'Kasir',
                                    '4' => 'Analis',
                                    '5' => 'Radiografer',
                                    '6' => 'Farmasi'
                                ],
                                $selectedStatus,
                                'class="form-control form-control-sm rounded-0"'
                            ) ?>
                        </th>
                        <th class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary rounded-0">
                                <i class="fas fa-filter"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($karyawans)): ?>
                        <?php
                        $no = ($perPage * ($currentPage - 1)) + 1;
                        foreach ($karyawans as $karyawan):
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?>.</td>
                                <td><?= esc($karyawan->kode) ?></td>
                                <td>
                                    <?= esc($karyawan->nama) ?><br>
                                    <small><?= esc($karyawan->nik) ?></small>
                                </td>
                                <td class="text-center"><?= esc($karyawan->jns_klm) ?></td>
                                <td class="text-center"><?= esc($karyawan->jabatan) ?></td>
                                <td class="text-center">
                                    <?php
                                    $status_labels = [
                                        1 => 'Perawat',
                                        2 => 'Dokter',
                                        3 => 'Kasir',
                                        4 => 'Analis',
                                        5 => 'Radiografer',
                                        6 => 'Farmasi'
                                    ];
                                    echo $status_labels[$karyawan->status] ?? '-';
                                    ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="<?= base_url("master/karyawan/detail/{$karyawan->id}") ?>"
                                            class="btn btn-info btn-sm rounded-0">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url("master/karyawan/edit/{$karyawan->id}") ?>"
                                            class="btn btn-warning btn-sm rounded-0">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url("master/karyawan/delete/{$karyawan->id}") ?>"
                                            class="btn btn-danger btn-sm rounded-0"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?= form_close() ?>
        </div>
    </div>
    <div class="card-footer">
        <?= $pager->links('karyawan', 'adminlte_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?>