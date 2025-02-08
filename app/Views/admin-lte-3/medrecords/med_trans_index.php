<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-02-08
 * 
 * Medical Record Transaction List View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <h3 class="card-title">Data Medical Records</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Tgl</th>
                        <th>Antrian</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($medrecs)): ?>
                        <?php
                        $no = ($perPage * ($currentPage - 1)) + 1;
                        foreach ($medrecs as $med):
                            ?>
                            <tr>
                                <td></td>
                                <td class="text-center"><?php echo $no++ ?>.</td>
                                <td>
                                    <span class="mailbox-read-time float-left"><?php echo tgl_indo8($med->tgl_masuk) ?></span>
                                </td>
                                <td><?php echo format_nomor(3, $med->no_urut) ?></td>
                                <td>
                                    <b><?php echo $med->pasien ?></b><br />
                                    <small><?php echo strtoupper($med->pasien_alamat) ?></small>
                                </td>
                                <td><?php echo $med->dokter ?></td>
                                <td><?php echo $med->poli ?></td>
                                <td>
                                    <?php
                                    switch ($med->status) {
                                        case '1':
                                            echo '<span class="badge badge-info">Anamnesa</span>';
                                            break;
                                        case '2':
                                            echo '<span class="badge badge-primary">Tindakan</span>';
                                            break;
                                        case '3':
                                            echo '<span class="badge badge-warning">Obat</span>';
                                            break;
                                        case '4':
                                            echo '<span class="badge badge-success">Laborat</span>';
                                            break;
                                        case '5':
                                            echo '<span class="badge badge-danger">Dokter</span>';
                                            break;
                                        case '6':
                                            echo '<span class="badge badge-secondary">Pembayaran</span>';
                                            break;
                                        case '7':
                                            echo '<span class="badge badge-dark">Finish</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-light">Pending</span>';
                                    }
                                    ?>
                                </td>
                                <td style="width: 150px;">
                                    <?= anchor(
                                        base_url('medrecords/trans/detail/' . $med->id),
                                        '<i class="fa fa-eye"></i> Detail »',
                                        [
                                            'class' => 'btn btn-info btn-flat btn-xs',
                                            'style' => 'width: 80px;'
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <?= $pager->links('default', 'adminlte_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?> 