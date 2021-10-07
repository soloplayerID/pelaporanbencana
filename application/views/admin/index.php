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
                        <h1></h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPENA</a></li>
                            <li>Admin Sistem</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in ../assets/js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>DATA ADMIN </h2>
            </div>
            <a href="#modal-fade" title="Tambah Agama" class="btn btn-effect-ripple btn-info" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Admin</a>
            <br>
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
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i> Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=0; foreach ($admin as $row): $no++?>
                        <tr>
                            <td class="text-center"><?php echo $no; ?></td>
                            <td><?php echo $row->nama_admin ?></td>
                            <td>
                                <?php
                                    if ($row->jk == "L") {$tampil = "LAKI - LAKI";}
                                    else {$tampil = "PEREMPUAN";}
                                ?>
                                <?php echo "$tampil"; ?>
                            </td>
                            <td><?php echo $row->tempat_lahir.", ".$row->tanggal_lahir ?></td>
                            <td class="text-center" width="200px">
                                <a href="<?php echo site_url('Admin/edit/'.$row->id_admin) ?>" data-toggle="tooltip" title="Edit <?php echo $row->nama_admin ?>" class="btn btn-effect-ripple btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo site_url('Admin/hapus/'.$row->id_admin) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $row->nama_admin?>');" data-toggle="tooltip" title="Hapus <?php echo $row->nama_admin ?>" class="btn btn-effect-ripple btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Datatables Block -->
    </div>
    <!-- END Page Content -->

</div>
<!-- END Main Container -->

<!-- Regular Fade -->
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Tambah Admin</strong></h3>
            </div>
            <div class="modal-body">
                <form id="form-validation" action="<?php echo site_url('Admin/tambah_proses') ?>" method="POST" enctype="multipart/form-data">
                    <!-- <div class="col-sm-6"> -->
                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" name="nama_admin" class="form-control" placeholder="Masukkan Nama Admin" required>
                            <?php echo form_error('nama_admin') ?>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"  placeholder="Masukkan Tempat Lahir" required>
                            <?php echo form_error('tempat_lahir') ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input id="example-datepicker3" type="text" name="tanggal_lahir" class="form-control input-datepicker"  placeholder="Tanggal-Bulan-Tahun" data-date-format="dd-mm-yyyy" required>
                            <?php echo form_error('tanggal_lahir') ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" id="example-chosen" class="form-control" required>
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <?php echo form_error('jk') ?>
                        </div>
                    <!-- </div> -->

                    <!-- <div class="col-sm-6"> -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                            <?php echo form_error('username') ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                            <?php echo form_error('password') ?>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password" required>
                            <?php echo form_error('password2') ?>
                        </div>
                    <!-- </div> -->

                    <!-- <div class="col-sm-12"> -->
                        <div class="form-group form-actions">
                            <button type="submit" class="btn btn-effect-ripple btn-primary" name="tambah_anggota">Tambah</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                        </div>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Regular Fade -->

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
