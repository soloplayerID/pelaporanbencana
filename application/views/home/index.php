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
                        <!-- First Row -->
                        <div class="row">
                            <!-- Simple Stats Widgets -->
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini themed-background-dark-flat">
                                        <span class="pull-right text-muted">

                                        </span>
                                        <strong class="text-light-op">Jumlah</strong>
                                    </div>
                                    <div class="widget-content themed-background-flat clearfix">
                                        <div class="widget-icon pull-right">
                                            <i class="gi gi-circle_arrow_down text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-light"><strong><?php echo $semua ?></strong></h2>
                                        <span class="text-light-op">SEMUA LAPORAN</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini themed-background-dark-passion">
                                        <span class="pull-right text-muted">

                                        </span>
                                        <strong class="text-light-op">Jumlah</strong>
                                    </div>
                                    <div class="widget-content themed-background-passion clearfix">
                                        <div class="widget-icon pull-right">
                                            <i class="gi gi-circle_question_mark text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-light"><strong><?php echo $belum ?></strong></h2>
                                        <span class="text-light-op">LAPORAN BELUM DIVERIFIKASI</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini themed-background-dark-passion">
                                        <span class="pull-right text-muted">

                                        </span>
                                        <strong class="text-light-op">Jumlah</strong>
                                    </div>
                                    <div class="widget-content themed-background-success clearfix">
                                        <div class="widget-icon pull-right">
                                            <i class="gi gi-circle_ok text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-light"><strong><?php echo $sudah ?></strong></h2>
                                        <span class="text-light-op">LAPORAN SUDAH DIVERIFIKASI</span>
                                    </div>
                                </a>
                            </div>
                            <!-- END Simple Stats Widgets -->
                        </div>
                        <!-- END First Row -->

                    </div>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->

<?php $this->load->view('footer'); ?>

<!-- Load and execute javascript code used only in this page -->
<!-- <script src="<?php echo base_url() ?>assets/js/pages/compCharts.js"></script> -->
<!-- <script>$(function(){ CompCharts.init(); });</script> -->

<!-- Load and execute javascript code used only in this page -->
<!-- <script src="<?php echo base_url() ?>assets/js/pages/readyDashboard.js"></script> -->
<!-- <script>$(function(){ ReadyDashboard.init(); });</script> -->

<?php
    function to_rupiah($angka) {
        $rupiah = number_format($angka ,2, ',' , '.' );
        return "Rp. ".$rupiah;
    }
?>

<script>
        function to_rupiah(angka){
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return 'Rp. ' + rev2.split('').reverse().join('');
    }
</script>
