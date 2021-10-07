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
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Data Laporan Bencana</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPENA</a></li>
                            <li>Laporan Bencana</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>List Laporan Bencana</h2>
            </div>
            <div class="block-section">
                <?php
                    if($this->session->flashdata('sukses_tambah') != "") {
                        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Disimpan
                              </div>';
                    }
                ?>

                <?php
                    if($this->session->flashdata('sukses_hapus') != "") {
                        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Dihapus
                              </div>';
                    }
                ?>

                <?php
                    if($this->session->flashdata('sukses_edit') != "") {
                        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Diedit
                              </div>';
                    }
                ?>
            </div>
            <div class="table-responsive">
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">#</th>
                            <th>Nama Pelapor</th>
                            <th>Alamat</th>
                            <th>Jenis Bencana</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px;"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($pengaduan as $row) {?>
                        <tr>
                            <td class="text-center">
                                <?php echo $no ?>
                            </td>
                            <td>
                                <strong><?php echo $row->nama ?></strong>
                            </td>
                            <td>
                                <strong><?php echo $row->alamat ?></strong>
                            </td>
                            <td>
                                <?php echo $row->jenis_bencana ?>
                            </td>
                            <td>
                                <?php echo $row->tanggal ?>
                            </td>
                            <td>
                                <?php
                                    if ($row->status == 1) {
                                        $label = "label label-danger";
                                        $text = "Menunggu Verifikasi";
                                        $color = "btn-success";
                                        $icon = "gi gi-ok";
                                    } else {
                                        $label = "label label-success";
                                        $text = "Sudah Diverifikasi";
                                        $color = "btn-danger";
                                        $icon = "gi gi-remove";
                                    }
                                ?>
                                <span class="<?php echo $label; ?>">
                                    <?php echo $text; ?>
                                </span>
                            </td>
                            <?php
                                $user = $this->session->userdata('userdata_desa');
                                if($user['akses'] == 'admin'){
                            ?>
                            <td class="text-center">
                                <a href="<?php echo site_url('Pengaduan/detail/'.$row->id_pengaduan) ?>" data-toggle="tooltip" title="Detail Laporan dan Rute" class="btn btn-effect-ripple btn-s btn-warning"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('Pengaduan/edit_proses/'.$row->id_pengaduan) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Mengubah Status?')" data-toggle="tooltip" title="Ubah Status" class="btn btn-effect-ripple btn-s <?php echo $color ?>"><i class="<?php echo $icon ?>"></i></a>
                                <a href="<?php echo site_url('Pengaduan/hapus/'.$row->id_pengaduan) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menolak Laporan?')" data-toggle="tooltip" title="Tolak Laporan" class="btn btn-effect-ripple btn-s btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                            <?php } elseif($user['akses'] == 'user') { ?>
                            <td class="text-center">
                                <a href="<?php echo site_url('Pengaduan/detail/'.$row->id_pengaduan) ?>" data-toggle="tooltip" title="Detail Laporan dan Rute" class="btn btn-effect-ripple btn-s btn-warning"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('Pengaduan/edit/'.$row->id_pengaduan) ?>" data-toggle="tooltip" title="Edit Laporan" class="btn btn-effect-ripple btn-s btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo site_url('Pengaduan/hapus/'.$row->id_pengaduan) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?')" data-toggle="tooltip" title="Delete Laporan" class="btn btn-effect-ripple btn-s btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Datatables Block -->
    </div>
    <!-- END Page Content -->

</div>
<!-- END Main Container -->
<?php $this->load->view('footer'); ?>

<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url() ?>/assets/js/pages/uiTables.js"></script>
<script>$(function () {UiTables.init();});</script>

<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url() ?>/assets/js/pages/formsComponents.js"></script>
<script>$(function(){ FormsComponents.init(); });</script>

<script>
    <?php
        if (isset($modal_show)) {
            echo $modal_show;
        }
    ?>
</script>
