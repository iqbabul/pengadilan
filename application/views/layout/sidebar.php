<?php
  $p = $this->uri->segment('2');
  $s = $this->uri->segment('3');
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('admin/dashboard')?>">
                <div class="sidebar-brand-icon">
                    <img src="https://babul.diaplikasi.com/sawc/assets/images/logo.ico" width="40" class="rounded-circle mb-2" alt="">                </div>
                <div class="sidebar-brand-text mx-3">SPK - SAW</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($p=='dashboard') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/dashboard');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php if($user->id_access == 1): ?>
                <li class="nav-item <?php if($p=='data') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/data')?>">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Pegawai</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data</span>
                </a>
                <div id="collapseTwo" class="collapse <?php if($p=='data') echo 'show' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($s=='alternatif') echo 'active' ?>" href="<?=base_url('admin/data/alternatif');?>">Kandidat</a>
                        <a class="collapse-item <?php if($s=='kriteria') echo 'active' ?>" href="<?=base_url('admin/data/kriteria');?>">Kriteria</a>
                    </div>
                </div>
            </li> -->
            <?php elseif($user->id_access == 2): ?>
            <li class="nav-item <?php if($p=='penilaian') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/penilaian')?>">
                    <i class="fas fa-fw fa-square-root-alt"></i>
                    <span>Penilaian</span></a>
            </li>
            <li class="nav-item <?php if($p=='matriks') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/matriks')?>">
                    <i class="fa fa-fw fa-table"></i>
                    <span>Matriks</span></a>
            </li>
            <li class="nav-item <?php if($p=='ranking') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/ranking')?>">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Perangkingan</span></a>
            </li>
            <?php endif; ?>
            <?php if($user->id_access == 1){ ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="collapsePages" class="collapse <?php if($p=='setting') echo 'show' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($s=='umum') echo 'active' ?>" href="<?=base_url('admin/setting/umum')?>">Umum</a>
                        <a class="collapse-item <?php if($s=='penilai') echo 'active' ?>" href="<?=base_url('admin/setting/penilai')?>">Penilai</a>
                        <a class="collapse-item <?php if($s=='alternatif') echo 'active' ?>" href="<?=base_url('admin/setting/alternatif')?>">Kandidat</a>
                        <a class="collapse-item <?php if($s=='kriteria') echo 'active' ?>" href="<?=base_url('admin/setting/kriteria')?>">Kriteria</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <li class="nav-item <?php if($p=='hasil') echo 'active' ?>">
                <a class="nav-link" href="<?=base_url('admin/hasil')?>">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Hasil</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user->fullname;?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url('assets/img/undraw_profile.svg')?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
