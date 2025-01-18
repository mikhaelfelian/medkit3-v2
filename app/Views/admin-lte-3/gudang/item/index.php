<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-19
 * 
 * Stock Items Index View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control rounded-0" placeholder="Cari item..." 
                               value="<?= esc($request->getGet('q')) ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary rounded-0">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Item</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Min. Stok</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage() ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($item->kode) ?></td>
                                <td><?= esc($item->item) ?></td>
                                <td><?= esc($item->kategori) ?></td>
                                <td><?= esc($item->satuan) ?></td>
                                <td><?= esc($item->stok) ?></td>
                                <td><?= esc($item->min_stok) ?></td>
                                <td>
                                    <?php if ($item->stok <= $item->min_stok): ?>
                                        <span class="badge badge-danger">Stok Minimum</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">Stok Tersedia</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url("stock/items/history/{$item->id}") ?>" 
                                           class="btn btn-info btn-sm rounded-0" 
                                           title="Riwayat Stok">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <a href="<?= base_url("stock/items/detail/{$item->id}") ?>" 
                                           class="btn btn-primary btn-sm rounded-0" 
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
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
        <?= $pager->links('items', 'adminlte_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?> 