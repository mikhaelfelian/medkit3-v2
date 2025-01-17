<?php
/**
 * Created by:
 * Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * 2025-01-17
 * 
 * Karyawan Create View
 */
?>
<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <?= form_open('master/karyawan/store') ?>
        <div class="card rounded-0">
            <div class="card-header">
                <h3 class="card-title">Form Data Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Kode -->
                        <div class="form-group">
                            <label>Kode</label>
                            <?= form_input([
                                'name' => 'kode',
                                'type' => 'text', 
                                'class' => 'form-control rounded-0',
                                'value' => $kode,
                                'readonly' => true
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- NIK -->
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <?= form_input([
                                    'name' => 'nik',
                                    'id' => 'nik',
                                    'type' => 'text',
                                    'class' => 'form-control rounded-0 ' . ($validation->hasError('nik') ? 'is-invalid' : ''),
                                    'placeholder' => 'Nomor Identitas...',
                                    'value' => old('nik')
                                ]) ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nik') ?>
                                </div>
                            </div>
                            <small class="text-muted">*Bisa diisi dengan NIK</small>
                        </div>

                        <!-- SIP -->
                        <div class="form-group">
                            <label>SIP</label>
                            <?= form_input([
                                'name' => 'sip',
                                'type' => 'text',
                                'class' => 'form-control rounded-0',
                                'placeholder' => 'Nomor SIP...',
                                'value' => old('sip')
                            ]) ?>
                        </div>

                        <!-- STR -->
                        <div class="form-group">
                            <label>STR</label>
                            <?= form_input([
                                'name' => 'str',
                                'type' => 'text',
                                'class' => 'form-control rounded-0',
                                'placeholder' => 'Nomor STR...',
                                'value' => old('str')
                            ]) ?>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Gelar Depan</label>
                                    <?= form_input([
                                        'name' => 'nama_dpn',
                                        'type' => 'text',
                                        'class' => 'form-control rounded-0',
                                        'placeholder' => 'dr.',
                                        'value' => old('nama_dpn')
                                    ]) ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <?= form_input([
                                        'name' => 'nama',
                                        'type' => 'text',
                                        'class' => 'form-control rounded-0 ' . ($validation->hasError('nama') ? 'is-invalid' : ''),
                                        'placeholder' => 'John Doe...',
                                        'value' => old('nama')
                                    ]) ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gelar Belakang</label>
                                    <?= form_input([
                                        'name' => 'nama_blk',
                                        'type' => 'text',
                                        'class' => 'form-control rounded-0',
                                        'placeholder' => 'Sp.PD',
                                        'value' => old('nama_blk')
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Tempat & Tanggal Lahir -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <?= form_input([
                                        'name' => 'tmp_lahir',
                                        'type' => 'text',
                                        'class' => 'form-control rounded-0 ' . ($validation->hasError('tmp_lahir') ? 'is-invalid' : ''),
                                        'placeholder' => 'Semarang...',
                                        'value' => old('tmp_lahir')
                                    ]) ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tmp_lahir') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <?= form_input([
                                        'name' => 'tgl_lahir',
                                        'type' => 'date',
                                        'class' => 'form-control rounded-0 ' . ($validation->hasError('tgl_lahir') ? 'is-invalid' : ''),
                                        'value' => old('tgl_lahir')
                                    ]) ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tgl_lahir') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Jenis Kelamin -->
                                <div class="form-group">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <?= form_dropdown(
                                        'jns_klm',
                                        [
                                            '' => '- Pilih -',
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan'
                                        ],
                                        old('jns_klm'),
                                        'class="form-control rounded-0 ' . ($validation->hasError('jns_klm') ? 'is-invalid' : '') . '"'
                                    ) ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jns_klm') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Alamat KTP -->
                        <div class="form-group">
                            <label>Alamat KTP</label>
                            <?= form_textarea([
                                'name' => 'alamat',
                                'class' => 'form-control rounded-0',
                                'rows' => 3,
                                'placeholder' => 'Mohon diisi alamat lengkap sesuai ktp...',
                                'value' => old('alamat')
                            ]) ?>
                        </div>

                        <!-- Alamat Domisili -->
                        <div class="form-group">
                            <label>Alamat Domisili</label>
                            <?= form_textarea([
                                'name' => 'alamat_domisili',
                                'class' => 'form-control rounded-0',
                                'rows' => 3,
                                'placeholder' => 'Mohon diisi alamat lengkap sesuai domisili...',
                                'value' => old('alamat_domisili')
                            ]) ?>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-group">
                            <label>Jabatan <span class="text-danger">*</span></label>
                            <?= form_input([
                                'name' => 'jabatan',
                                'type' => 'text',
                                'class' => 'form-control rounded-0 ' . ($validation->hasError('jabatan') ? 'is-invalid' : ''),
                                'placeholder' => 'Isikan Jabatan...',
                                'value' => old('jabatan')
                            ]) ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan') ?>
                            </div>
                        </div>

                        <!-- No HP -->
                        <div class="form-group">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <?= form_input([
                                'name' => 'no_hp',
                                'type' => 'text',
                                'class' => 'form-control rounded-0 ' . ($validation->hasError('no_hp') ? 'is-invalid' : ''),
                                'placeholder' => 'Nomor kontak WA karyawan / keluarga terdekat...',
                                'value' => old('no_hp')
                            ]) ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_hp') ?>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <?= form_dropdown(
                                'status',
                                [
                                    '' => '- Pilih -',
                                    '1' => 'Perawat',
                                    '2' => 'Dokter',
                                    '3' => 'Kasir',
                                    '4' => 'Analis',
                                    '5' => 'Radiografer',
                                    '6' => 'Farmasi'
                                ],
                                old('status'),
                                'class="form-control rounded-0 ' . ($validation->hasError('status') ? 'is-invalid' : '') . '"'
                            ) ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('status') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="<?= base_url('master/karyawan') ?>" class="btn btn-default rounded-0">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary rounded-0 float-right">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>