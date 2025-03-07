<aside class="main-sidebar sidebar-light-primary elevation-0">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= $Pengaturan->logo ? base_url($Pengaturan->logo) : base_url('public/assets/theme/admin-lte-3/dist/img/AdminLTELogo.png') ?>"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-0" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $Pengaturan ? $Pengaturan->judul_app : env('app.name') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url((!empty($Pengaturan->logo) ? $Pengaturan->logo_header : 'public/assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>"
                        class="brand-image img-rounded-0 elevation-0"
                        style="width: 209px; height: 85px; background-color: transparent;" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"></a>
                </div>
            </div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>"
                        class="nav-link <?= isMenuActive('dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Data -->
                <li class="nav-item has-treeview <?= isMenuActive(['master', 'satuan']) ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= isMenuActive(['master', 'satuan']) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('master/gudang') ?>"
                                class="nav-link <?= isMenuActive('master/gudang') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-warehouse nav-icon"></i>
                                <p>Data Gudang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/satuan') ?>"
                                class="nav-link <?= isMenuActive('master/satuan') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-ruler nav-icon"></i>
                                <p>Data Satuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/kategori') ?>"
                                class="nav-link <?= isMenuActive('master/kategori') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Data Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/jenis') ?>"
                                class="nav-link <?= isMenuActive('master/jenis') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-capsules nav-icon"></i>
                                <p>Jenis Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/merk') ?>"
                                class="nav-link <?= isMenuActive('master/merk') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-trademark nav-icon"></i>
                                <p>Data Merk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/obat') ?>"
                                class="nav-link <?= isMenuActive('master/obat') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-pills nav-icon"></i>
                                <p>Data Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/tindakan') ?>"
                                class="nav-link <?= isMenuActive('master/tindakan') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-procedures nav-icon"></i>
                                <p>Data Jasa & Tindakan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/lab') ?>"
                                class="nav-link <?= isMenuActive('master/lab') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-flask nav-icon"></i>
                                <p>Data Laboratorium</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/radiologi') ?>"
                                class="nav-link <?= isMenuActive('master/radiologi') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-x-ray nav-icon"></i>
                                <p>Data Radiologi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/bhp') ?>"
                                class="nav-link <?= isMenuActive('master/bhp') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-box-open nav-icon"></i>
                                <p>Data BHP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/poli') ?>"
                                class="nav-link <?= isMenuActive('master/poli') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>Data Klinik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/gelar') ?>"
                                class="nav-link <?= isMenuActive('master/gelar') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Data Gelar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/pasien') ?>"
                                class="nav-link <?= isMenuActive('master/pasien') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-user-injured"></i>
                                <p>
                                    Data Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/karyawan') ?>"
                                class="nav-link <?= isMenuActive('master/karyawan') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Data Karyawan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/supplier') ?>"
                                class="nav-link <?= isMenuActive('master/supplier') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Data Supplier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/icd') ?>"
                                class="nav-link <?= isMenuActive('master/icd') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>
                                    Data ICD
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/kamar') ?>"
                                class="nav-link <?= isMenuActive('master/kamar') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="nav-icon fas fa-bed"></i>
                                <p>
                                    Data Kamar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/penjamin') ?>"
                                class="nav-link <?= isMenuActive('master/penjamin') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-shield-alt nav-icon"></i>
                                <p>Data Penjamin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('master/platform') ?>"
                                class="nav-link <?= isMenuActive('master/platform') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-credit-card nav-icon"></i>
                                <p>Data Platform</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Transaksi -->
                <li class="nav-item has-treeview <?= isMenuActive('transaksi') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= isMenuActive('transaksi') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('transaksi/po/create') ?>"
                                class="nav-link <?= isMenuActive('transaksi/purchase_order') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Purchase Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('transaksi/beli/create') ?>"
                                class="nav-link <?= isMenuActive('transaksi/beli/create') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-cart-plus nav-icon"></i>
                                <p>Faktur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('transaksi/po') ?>"
                                class="nav-link <?= isMenuActive('transaksi/po') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-list nav-icon"></i>
                                <p>Data Purchase Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('transaksi/beli') ?>"
                                class="nav-link <?= isMenuActive('transaksi/beli') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-list nav-icon"></i>
                                <p>Data Pembelian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Gudang -->
                <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'stock') !== false ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'stock') !== false ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Gudang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-header"><?= nbs() ?>PENERIMAAN</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('stock/penerimaan'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'stock/penerimaan') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-file-invoice nav-icon"></i>
                                <p>Stok Masuk</p>
                            </a>
                        </li>
                        <li class="nav-header"><?= nbs() ?>INVENTORI</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('stock/items'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'stock/items') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-boxes nav-icon"></i>
                                <p>Data Stok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('stock/transfer'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'stock/transfer') !== false && strpos($_SERVER['REQUEST_URI'], 'stock/transfer_lists') === false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-exchange-alt nav-icon"></i>
                                <p>Mutasi Stok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('stock/transfer_lists'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'stock/transfer_lists') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-history nav-icon"></i>
                                <p>Riwayat Mutasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo strpos($_SERVER['REQUEST_URI'], 'medrecords') !== false ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'medrecords') !== false ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-hospital"></i>
                        <p>
                            Medical Records
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-header"><?= nbs() ?>PELAYANAN</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/daftar'); ?>" 
                                class="nav-link <?= isMenuActive('medrecords/daftar') ? 'active' : '' ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/antrian'); ?>" 
                                class="nav-link <?= isMenuActive('medrecords/antrian') ? 'active' : '' ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-users nav-icon"></i>
                                <p>Antrian</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/rawat_jalan'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'medrecords/rawat_jalan') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-procedures nav-icon"></i>
                                <p>Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/rawat_inap'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'medrecords/rawat_inap') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-bed nav-icon"></i>
                                <p>Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-header"><?= nbs() ?>PENUNJANG</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/radiologi'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'medical/radiologi') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-x-ray nav-icon"></i>
                                <p>Radiologi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('medrecords/laboratorium'); ?>" 
                                class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'medical/laboratorium') !== false ? 'active' : ''; ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-vial nav-icon"></i>
                                <p>Laboratorium</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SDM -->
                <li class="nav-item has-treeview <?= isMenuActive('sdm') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= isMenuActive('sdm') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            SDM
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('sdm/kepegawaian') ?>" 
                                class="nav-link <?= isMenuActive('sdm/kepegawaian') ? 'active' : '' ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>Kepegawaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sdm/absensi') ?>" 
                                class="nav-link <?= isMenuActive('sdm/absensi') ? 'active' : '' ?>">
                                <?= nbs(2) ?>
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Absensi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item has-treeview <?= isMenuActive('pengaturan') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= isMenuActive('pengaturan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pengaturan/app') ?>"
                                class="nav-link <?= isMenuActive('pengaturan/app') ? 'active' : '' ?>">
                                <?= nbs(3) ?>
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>Aplikasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>