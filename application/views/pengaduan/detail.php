<?php $this->load->view('header'); ?>

<!-- Main Container -->
<div id="main-container">
    <header class="navbar navbar-inverse navbar-fixed-top">
      <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
      <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
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
                        <h1>Detail Laporan dan Rute Terdekat</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPENA</a></li>
                            <li><a href="<?php echo site_url('Pengaduan') ?>">Laporan Saya</a></li>
                            <li>Detail</li>
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
                        <h2>Detail Laporan</h2>
                    </div>

                    <!-- Partial Responsive Content -->
                    <div class="row gallery">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="gallery-image-container animation-fadeInQuick2" data-category="travel">
                                <img src="<?php echo base_url('upload/'.$pengaduan['file']) ?>">
                                <a href="<?php echo base_url('upload/'.$pengaduan['file']) ?>" class="gallery-image-options" data-toggle="lightbox-image" title="<?php echo "Keluhan ".$pengaduan['nama'] ?>">
                                    <h2 class="text-light"><strong><?php echo "Keluhan ".$pengaduan['nama'] ?></strong></h2>
                                    <i class="fa fa-search-plus fa-3x text-light"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <table class="table table-border table-vcenter">
                        <tbody>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <br>
                                    <div class="progress progress-striped active">
                                        <?php
                                            if ($pengaduan['status'] == 1) {
                                                $bar = 'progress-bar-danger';
                                                $wd = '50%';
                                                $text = '50% (Menunggu Verifikasi)';
                                            } else {
                                                $bar = 'progress-bar-success';
                                                $wd = '100%';
                                                $text = '100% (Sudah Diverifikasi)';
                                            }
                                        ?>
                                        <div class="progress-bar <?php echo $bar ?>" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $wd ?>"><?php echo $text ?></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Diverifikasi Oleh (Admin)</strong></td>
                                <td>
                                    <?php
                                        if ($pengaduan['status'] == 0) {
                                            echo $pengaduan['nama_admin'];
                                        } else {
                                            echo "<i>Masih Menunggu</i>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Rincian Kejadian Bencana</strong></td>
                                <td>
                                    <?php echo $pengaduan['pengaduan'] ?>
                                </td>
                            </tr>
                            <tr>
                              <td><strong>Alamat Kejadian</strong></td>
                              <td>
                                <?= $pengaduan['alamat']?>
                              </td>
                            </tr>
                            <tr>
                              <td><strong>Jarak</strong></td>
                              <td>
                                <?= number_format($jarak,2)?>&nbsp Km
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <td><strong><h2><b>Rute Terdekat</b></h2></strong></td>
                <div id='map' style="height: 500px;margin-bottom: 23px;"></div>
                <div id='inputs'></div>
                <div id='errors'></div>
                <!-- <div id='directions'>
                  <div id='routes'></div>
                  <div id='instructions'></div>
                </div> -->
                <!-- END Horizontal Form Block -->

            </div>
        </div>
    </div>
    <!-- END Page Content -->
    <!-- END Main Container -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

    <!-- <div id='map'></div>
    <div id='inputs'></div>
    <div id='errors'></div>
    <div id='directions'>
      <div id='routes'></div> -->
      <!-- <div id='instructions'></div> -->
    <!-- </div> -->
</div>
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoic29sb3BsYXllcmlkIiwiYSI6ImNrYm9zdmRuYjIzMDEydXBmbmpmcWVsNmcifQ.t0yJDa0gWtbAwcFVoACmVQ';
var map = new mapboxgl.Map({
    container: 'maps', // container id
    style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
    center: [106.92667,-6.91806], // starting position [lng, lat]
    zoom: 14, // starting zoom
    logoPosition:'top-right',
});

// move the attribution control out of the way
// map.attributionControl.setPosition('bottomleft');

// create the initial directions object, from which the layer
// and inputs will pull data.
var directions = L.mapbox.directions();

var directionsLayer = L.mapbox.directions.layer(directions).addTo(map);

var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions).addTo(map);

var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions).addTo(map);

var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions).addTo(map);

// var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions).addTo(map);

var destination = {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [<?=$pengaduan['Longitude'] ?>, <?=$pengaduan['Latitude'] ?>]
    },
    "properties": {
      "title": '<%= link_to @direction.business.name, business_url(@direction.business) %>',
      "description": '<%= @direction.business.full_street_address %>',
      "marker-color": "#3ca0d3",
      "marker-size": "large",
      "marker-symbol": "star"
    }
  };

  var origin = {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [106.9957675395965, -6.235224519191888]
    },
    "properties": {
      "title": 'You',
      "description": '',
      "marker-color": "#ff0000",
      "marker-size": "large",
      "marker-symbol": "heart"
    }
  };

directions.setOrigin(origin).setDestination(destination).query();

var awal = new mapboxgl.LngLat(106.9957675395965, -6.235224519191888);
var tujuan = new mapboxgl.LngLat(<?=$pengaduan['Longitude'] ?>, <?=$pengaduan['Latitude'] ?>);
var jarak = awal.distanceTo(tujuan).toString();

var explode = jarak.split(".");
// var td1 = document.getElementById('jarak');
// var text = document.createTextNode(explode[0]+" Meter");
// td1.appendChild(text);
console.log(jarak);
</script>

<?php $this->load->view('footer'); ?>
