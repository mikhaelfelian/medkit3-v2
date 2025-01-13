<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-12
 * 
 * Radiologi Trash View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card rounded-0">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?= base_url('master/radiologi') ?>" class="btn btn-sm btn-primary rounded-0">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <?= form_open(base_url('master/radiologi/trash'), ['method' => 'get']) ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Dihapus pada</th>
                            <th width="100">Aksi</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                <?= form_input([
                                    'name' => 'item',
                                    'class' => 'form-control form-control-sm rounded-0',
                                    'placeholder' => 'Filter item...',
                                    'value' => service('request')->getGet('item')
                                ]) ?>
                            </th>
                            <th></th>
                            <th></th>
                            <th>
                                <button type="submit" class="btn btn-sm btn-primary rounded-0">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($radiologi as $key => $row): ?>
                            <tr>
                                <td><?= (($currentPage - 1) * $perPage) + $key + 1 ?></td>
                                <td>
                                    <?= $row->item.br(); ?>
                                    <small><i><?= $row->kode ?></i></small>
                                    <?php if (!empty($row->item_alias)): ?>
                                        <?=br();?>
                                        <small class="text-muted"><i>Alias: <?= $row->item_alias ?></i></small>
                                    <?php endif ?>
                                </td>
                                <td><?= format_angka_rp($row->harga_jual) ?></td>
                                <td><?= $row->deleted_at ? date('d/m/Y H:i', strtotime($row->deleted_at)) : '' ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url("master/radiologi/restore/$row->id") ?>"
                                            class="btn btn-success btn-sm rounded-0"
                                            onclick="return confirm('Pulihkan data ini?')">
                                            <i class="fas fa-undo"></i>
                                        </a>
                                        <a href="<?= base_url("master/radiologi/delete_permanent/$row->id") ?>"
                                            class="btn btn-danger btn-sm rounded-0"
                                            onclick="return confirm('Hapus permanen data ini? Data yang dihapus tidak dapat dipulihkan.')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <?php if (empty($radiologi)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?= form_close() ?>
            </div>
            <?php if ($pager): ?>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        <?= $pager->links('radiologi', 'adminlte_pagination') ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>