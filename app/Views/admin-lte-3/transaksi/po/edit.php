<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-23
 * 
 * Purchase Order Edit View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <h3 class="card-title">Form Edit Purchase Order</h3>
    </div>
    <?= form_open('transaksi/po/update/' . $po->id, ['id' => 'form-po']) ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <!-- No PO -->
                <div class="form-group">
                    <label>No PO</label>
                    <input type="text" class="form-control rounded-0" value="<?= esc($po->no_nota) ?>" readonly>
                </div>

                <!-- Supplier -->
                <div class="form-group">
                    <label>Nama Supplier<span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-control rounded-0 select2 <?= validation_show_error('supplier_id') ? 'is-invalid' : '' ?>">
                        <option value="">Pilih Nama Supplier</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier->id ?>" <?= old('supplier_id', $po->id_supplier) == $supplier->id ? 'selected' : '' ?>>
                                <?= esc($supplier->nama) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('supplier_id') ?>
                    </div>
                </div>

                <!-- Tanggal PO -->
                <div class="form-group">
                    <label>Tgl PO</label>
                    <input type="date" name="tgl_po" class="form-control rounded-0<?= validation_show_error('tgl_po') ? ' is-invalid' : '' ?>" 
                           value="<?= old('tgl_po', $po->tgl_masuk) ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('tgl_po') ?>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control rounded-0" rows="3" 
                              placeholder="Masukkan keterangan..."><?= old('keterangan', $po->keterangan) ?></textarea>
                </div>

                <!-- Alamat Pengiriman -->
                <div class="form-group">
                    <label>Alamat Pengiriman<span class="text-danger">*</span></label>
                    <?= form_textarea(['name' => 'alamat_pengiriman', 'class' => 'form-control rounded-0' . (validation_show_error('alamat_pengiriman') ? ' is-invalid' : ''), 'rows' => 3, 'placeholder' => 'Masukkan alamat pengiriman...', 'value' => old('alamat_pengiriman', $po->pengiriman)]) ?>
                    <div class="invalid-feedback">
                        <?= validation_show_error('alamat_pengiriman') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?= base_url('transaksi/po') ?>" class="btn btn-default rounded-0">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary rounded-0 float-right">
            <i class="fas fa-save"></i> Update
        </button>
    </div>
    <?= form_close() ?>
</div>

<?= $this->section('js') ?>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?> 