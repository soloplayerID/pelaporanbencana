<!-- Right Header Navigation -->
<ul class="nav navbar-nav-custom pull-right">

    <!-- User Dropdown -->
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <?php
                $user = $this->session->userdata('userdata_desa');

                if ($user['akses'] == 'admin') {
                    $akses = 'ADMIN';
                    $nama = $user['nama_admin'];
                } else {
                    $akses = 'USER';
                    $nama = $user['nama'];
                }
            ?>
            <strong>SELAMAT DATANG, <?php echo $akses ?> A.N. <?php echo $nama ?>  </strong>
            <img src="<?php echo base_url() ?>/assets/img/placeholders/avatars/avatar9.jpg" alt="avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">
                <strong>ADMINISTRATOR</strong>
            </li>
            <li>
                <a href="#modal-stok" data-toggle="modal">
                    <i class="fa fa-power-off fa-fw pull-right"></i> Log Out
                </a>
            </li>
        </ul>
    </li>
    <!-- END User Dropdown -->

</ul>
<!-- END Right Header Navigation -->
