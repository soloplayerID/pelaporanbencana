<!DOCTYPE html>
    <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo $judul ?></title>

        <meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?=base_url()?>logo_bpbd.png">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- CSS Transaksi -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssku.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/style-gue.css" />

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-3.3.1.min.js"></script>

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="<?php echo base_url() ?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/plugins.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/app.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/vue.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/axios.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/js/tableHeadFixer.js"></script>

        <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet'/>
        <!-- <script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' /> -->

    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="page-wrapper" class="page-loading">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader">
                <div class="inner">
                    <!-- Animation spinner for all modern browsers -->
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                    <!-- Text for IE9 -->
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>
            <!-- END Preloader -->

            <!-- Page Container -->
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">

                <?php
                    $userdata = $this->session->userdata('userdata_desa');

                    if ($userdata['akses'] == 'admin') {
                        $this->load->view('main_sidebar');
                    } elseif ($userdata['akses'] == 'user') {
                        $this->load->view('main_sidebar_user');
                    }
                ?>
