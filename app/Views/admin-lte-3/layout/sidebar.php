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
                    <img src="<?php echo base_url((!empty($Pengaturan->logo) ? $Pengaturan->logo_header : 'public/assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" class="brand-image img-rounded-0 elevation-0"
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
                                <p>Data Tindakan</p>
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