<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <?= form_open('master/obat/update/' . $obat->id) ?>
        <div class="card rounded-0">
            <div class="card-header">
                <h3 class="card-title">Form Edit Obat</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <select name="id_kategori" class="form-control select2 rounded-0 <?= validation_show_error('id_kategori') ? 'is-invalid' : '' ?>">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k->id ?>" <?= old('id_kategori', $obat->id_kategori) == $k->id ? 'selected' : '' ?>>
                                <?= $k->kategori ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('id_kategori') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Merk <span class="text-danger">*</span></label>
                    <select name="id_merk" class="form-control select2 rounded-0 <?= validation_show_error('id_merk') ? 'is-invalid' : '' ?>">
                        <option value="">Pilih Merk</option>
                        <?php foreach($merk as $m): ?>
                            <option value="<?= $m->id ?>" <?= old('id_merk', $obat->id_merk) == $m->id ? 'selected' : '' ?>>
                                <?= $m->merk ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('id_merk') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Obat <span class="text-danger">*</span></label>
                    <?= form_input([
                        'type' => 'text',
                        'name' => 'item',
                        'class' => 'form-control rounded-0 ' . (validation_show_error('item') ? 'is-invalid' : ''),
                        'placeholder' => 'Masukkan nama obat',
                        'value' => old('item', $obat->item)
                    ]) ?>
                    <div class="invalid-feedback">
                        <?= validation_show_error('item') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alias</label>
                    <?= form_input([
                        'type' => 'text',
                        'name' => 'item_alias',
                        'class' => 'form-control rounded-0 ' . (validation_show_error('item_alias') ? 'is-invalid' : ''),
                        'placeholder' => 'Masukkan nama alias obat',
                        'value' => old('item_alias', $obat->item_alias)
                    ]) ?>
                    <div class="invalid-feedback">
                        <?= validation_show_error('item_alias') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Kandungan</label>
                    <?= form_textarea([
                        'name' => 'item_kand',
                        'class' => 'form-control rounded-0 ' . (validation_show_error('item_kand') ? 'is-invalid' : ''),
                        'placeholder' => 'Masukkan kandungan obat',
                        'value' => old('item_kand', $obat->item_kand),
                        'rows' => 3
                    ]) ?>
                    <div class="invalid-feedback">
                        <?= validation_show_error('item_kand') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Satuan <span class="text-danger">*</span></label>
                    <select name="id_satuan" class="form-control rounded-0 <?= validation_show_error('id_satuan') ? 'is-invalid' : '' ?>">
                        <option value="">Pilih Satuan</option>
                        <?php foreach($satuan as $s): ?>
                            <option value="<?= $s->id ?>" <?= old('id_satuan', $obat->id_satuan) == $s->id ? 'selected' : '' ?>>
                                <?= $s->satuanBesar ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('id_satuan') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Harga Beli <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-0">Rp</span>
                        </div>
                        <?= form_input([
                            'type' => 'text',
                            'id' => 'harga',
                            'name' => 'harga_beli',
                            'class' => 'form-control rounded-0 autonumeric ' . (validation_show_error('harga_beli') ? 'is-invalid' : ''),
                            'placeholder' => 'Masukkan harga beli',
                            'value' => old('harga_beli', $obat->harga_beli)
                        ]) ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('harga_beli') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Harga Jual <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-0">Rp</span>
                        </div>
                        <?= form_input([
                            'type' => 'text',
                            'name' => 'harga_jual',
                            'id' => 'harga',
                            'class' => 'form-control rounded-0 autonumeric ' . (validation_show_error('harga_jual') ? 'is-invalid' : ''),
                            'placeholder' => 'Masukkan harga jual',
                            'value' => old('harga_jual', $obat->harga_jual)
                        ]) ?>
                        <div class="invalid-feedback">
                            <?= validation_show_error('harga_jual') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Stok</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="status_stok" name="status_stok" value="1" <?= old('status_stok', $obat->status_stok) == '1' ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="status_stok">Stockable</label>
                    </div>
                    <small class="form-text text-muted">Aktifkan jika di centang maka akan mengurangi stok.</small>
                </div>

                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="status" value="1" id="statusAktif" <?= old('status', $obat->status) == '1' ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="statusAktif">
                            Aktif
                        </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="status" value="0" id="statusNonaktif" <?= old('status', $obat->status) == '0' ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="statusNonaktif">
                            Non Aktif
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="<?= base_url('master/obat') ?>" class="btn btn-default rounded-0">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary rounded-0 float-right">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Initialize AutoNumeric for currency inputs
    $(document).ready(function() {
        $('input[id=harga]').autoNumeric({aSep: '.', aDec: ',', aPad: false});

        // Handle form submission
        $('form').on('submit', function() {
            // Get unformatted values before submit
            var harga_beli = $('#harga_beli').autoNumeric('get');
            var harga_jual = $('#harga_jual').autoNumeric('get');
            
            // Update hidden fields with unformatted values
            $('#harga_beli_real').val(harga_beli);
            $('#harga_jual_real').val(harga_jual);
        });
    });
</script>
<?= $this->endSection() ?> 