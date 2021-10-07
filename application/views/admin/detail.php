<?php $this->load->view('header'); ?>

<!-- Main Container -->
<div id="main-container">
    <header class="navbar navbar-inverse navbar-fixed-top">
        <!-- Left Header Navigation -->
        <ul class="nav navbar-nav-custom">
            <!-- Main Sidebar Toggle Button -->
            <li>
                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                    <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                    <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                </a>
            </li>
            <!-- END Main Sidebar Toggle Button -->

            <!-- Header Link -->
            <li class="hidden-xs animation-fadeInQuick">
                <a href=""><strong>APLIKASI PELAPORAN BENCANA</strong></a>
            </li>
            <!-- END Header Link -->
        </ul>
        <!-- END Left Header Navigation -->

        <?php $this->load->view('right_menu'); ?>
        
    </header>
    <!-- END Header -->

    <!-- Page content -->
    <div id="page-content">
        <!-- Forms Components Header -->
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Detail Penduduk <?php echo $penduduk['nama'] ?></h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>SIPENA</li>
                            <li><a href="<?php echo site_url('Penduduk') ?>">Penduduk</a></li>
                            <li>Detail <?php echo $penduduk['nama'] ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->

        <!-- Form Components Row -->
        <div class="row">
            <div class="col-md-8">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Detail Penduduk <?php echo $penduduk['nama'] ?></h2>
                    </div>

                    <!-- Partial Responsive Content -->
                    <table class="table table-border table-vcenter">
                        <tbody>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>
                                    <?php echo $penduduk['nik'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>
                                    <?php echo $penduduk['nama'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tempat, Tanggal Lahir</strong></td>
                                <td>
                                    <?php echo $penduduk['tempat_lahir'].", ".$penduduk['tanggal_lahir'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>
                                    <?php
                                        if ($penduduk['jk'] == 'L') {
                                            echo "Laki-laki";
                                        } else {
                                            echo "Perempuan";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Agama</strong></td>
                                <td>
                                    <?php echo $penduduk['nama_agama'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Laporan</strong></td>
                                <td>
                                    <?php echo $keluhan ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Horizontal Form Block -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</div>
<!-- END Main Container -->

<?php $this->load->view('footer'); ?>