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
        <h3 class="card-title">
            <i class="fas fa-boxes mr-1"></i>
            Data Stok Item
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Item</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th width="100">Aksi</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <select name="kategori" class="form-control form-control-sm rounded-0">
                                <option value="">- Kategori -</option>
                                <?php foreach ($kategoriList as $value): ?>
                                    <option value="<?= $value->id ?>">
                                        <?= esc($value->kategori) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                        <th>
                            <select name="merk" class="form-control form-control-sm rounded-0">
                                <option value="">- Merk -</option>
                                <?php foreach ($merkList as $value): ?>
                                    <option value="<?= $value->id ?>">
                                        <?= esc($value->merk) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                        <th>
                            <?= form_input([
                                'name' => 'item',
                                'class' => 'form-control form-control-sm rounded-0',
                                'placeholder' => 'Filter item...'
                            ]) ?>
                        </th>
                        <th>
                            <?= form_input([
                                'name' => 'harga_beli',
                                'class' => 'form-control form-control-sm rounded-0',
                                'placeholder' => 'Filter harga...'
                            ]) ?>
                        </th>
                        <th></th>
                        <th>
                            <button type="submit" class="btn btn-sm btn-primary rounded-0">
                                <i class="fas fa-filter"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage() ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item->nama_kategori ?></td>
                                <td><?= $item->merk ?></td>
                                <td>
                                    <?= $item->item . br(); ?>
                                    <small><i><?= $item->kode ?></i></small><?= br(); ?>
                                    <small><b><?= format_angka_rp($item->harga_jual) ?></b></small>
                                    <?php if (!empty($item->item_alias)): ?>
                                        <?= br(); ?>
                                        <small class="text-muted"><i>Alias: <?= $item->item_alias ?></i></small>
                                    <?php endif ?>
                                    <?php if (!empty($item->item_kand)): ?>
                                        <?= br(); ?>
                                        <small class="text-muted"><i>Kandungan: <?= $item->item_kand ?></i></small>
                                    <?php endif ?>
                                </td>
                                <td><?= format_angka_rp($item->harga_beli) ?></td>
                                <td>
                                    
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url("stock/items/detail/{$item->id}") ?>"
                                            class="btn btn-primary btn-sm rounded-0" title="Detail">
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