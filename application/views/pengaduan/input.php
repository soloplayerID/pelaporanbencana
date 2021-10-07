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
                        <h1>Input Laporan Bencana</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPENA</a></li>
                            <li><a href="<?php echo site_url('Pengaduan') ?>">Laporan Saya</a></li>
                            <li>Input Laporan Bencana</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->
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

        <!-- Form Components Row -->
        <div class="row">
            <div class="col-md-9">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Form Pelaporan Kejadian Bencana</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form action="<?php echo site_url('Pengaduan/tambah_proses') ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Pelapor</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" value="<?= $nama ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="alamat" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Bencana</label>
                        <div class="col-md-9">
                            <select name="jenis_bencana" id="example-chosen" class="form-control" required>
                                <option value="">--Pilih Jenis Bencana--</option>
                                <option value="alam">Alam</option>
                                <option value="non alam">Non-Alam</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Foto Kejadian<br><span class="help-block">*File JPG/JPEG/PNG</span></br></label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" id="example-file-input" name="foto" style="height: 80px" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Rincian Kejadian Bencana</label>
                            <div class="col-md-9">
                                <textarea name="pengaduan" class="form-control" rows="10" required></textarea>
                                <?php echo form_error('pengaduan'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Titik Koordinat Lokasi<br><span class="help-block">*Klik Peta Untuk <br>Menentukan Lokasi</span></br></br></label>
                            <div class="col-sm-9">
                               <div id="map" class="" style="height: 340px"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Latitude" name="Latitude" placeholder="Latitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Lng</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Longitude" name="Longitude" placeholder="Longitude" required>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                    <!-- END Horizontal Form Content -->
                </div>
                <!-- END Horizontal Form Block -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</div>
<!-- END Main Container -->

<script type="text/javascript">
mapboxgl.accessToken = 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog';
    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
        center: [106.995150, -6.235189], // starting position [lng, lat]
        zoom: 13, // starting zoom
        logoPosition:'top-right',
    });

    var marker = new mapboxgl.Marker({
        draggable: true
    })
        .setLngLat([106.995150, -6.235189])
        .addTo(map);
    function onDragEnd() {
        var lngLat = marker.getLngLat();

        var a = lngLat.lat;
        var b = lngLat.lng;
        $("#Latitude").val(a);
        $("#Longitude").val(b);
    }
    // Add geolocate control to the map.
    map.addControl(
    new mapboxgl.GeolocateControl({
    onViewportChange: {
      zoom:5
    },
    positionOptions: {
    enableHighAccuracy: true
    },
    trackUserLocation: true
    })
    );

    marker.on('dragend', onDragEnd);
    map.on('click', addMarker);

    function addMarker(e){
      //add marker
      // console.log(e.lngLat.lng);
      marker.setLngLat([e.lngLat.lng, e.lngLat.lat])
      .addTo(map);
      var a = e.lngLat.lat;
      var b = e.lngLat.lng;
      $("#Latitude").val(a);
      $("#Longitude").val(b);
    }

</script>

<?php $this->load->view('footer'); ?>

<!-- Mapbox.js
API
Examples
Plugins
Driving directions

Use the mapbox-directions.js plugin to show results from the Mapbox Directions API

<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Driving directions</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<body>

<style>
#inputs,
#errors,
#directions {
    position: absolute;
    width: 33.3333%;
    max-width: 300px;
    min-width: 200px;
}

#inputs {
    z-index: 10;
    top: 10px;
    left: 10px;
}

#directions {
    z-index: 99;
    background: rgba(0,0,0,.8);
    top: 0;
    right: 0;
    bottom: 0;
    overflow: auto;
}

#errors {
    z-index: 8;
    opacity: 0;
    padding: 10px;
    border-radius: 0 0 3px 3px;
    background: rgba(0,0,0,.25);
    top: 90px;
    left: 10px;
}

</style>

<script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

<div id='map'></div>
<div id='inputs'></div>
<div id='errors'></div>
<div id='directions'>
  <div id='routes'></div>
  <div id='instructions'></div>
</div>
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoic29sb3BsYXllcmlkIiwiYSI6ImNrYm9zdmRuYjIzMDEydXBmbmpmcWVsNmcifQ.t0yJDa0gWtbAwcFVoACmVQ';
var map = L.mapbox.map('map', null, {
    zoomControl: false
})
  .setView([-6.2352154, 106.9929826], 13)
  .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

// move the attribution control out of the way
// map.attributionControl.setPosition('bottomleft');

// create the initial directions object, from which the layer
// and inputs will pull data.
var directions = L.mapbox.directions();

var directionsLayer = L.mapbox.directions.layer(directions).addTo(map);

var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions).addTo(map);

var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions).addTo(map);

var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions).addTo(map);

var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions).addTo(map);

var destination = {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [106.972296, -6.269769]
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
      "coordinates": [106.99557, -6.23521]
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
</script>

</body>
</html> -->
