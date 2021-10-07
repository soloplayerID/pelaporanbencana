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
        <script type="text/javascript">
          var datas = [];
					datas.push({isPonpes:1,ponpesNama:"<?= $pengaduan['kode_pengaduan'] ?>",ponpesLatitude:"<?= $pengaduan['Latitude']?>",ponpesLongitude:"<?= $pengaduan['Longitude']?>",ponpesGambar:"<?= $pengaduan['file'] ?>"});
        </script>

        <?php foreach ($getAllVertex as $v):?>
          <script type="text/javascript">
  					datas.push({isPonpes:0,vertexNama:"<?= $v->vertexNama ?>",vertexLatitude:"<?= $v->vertexLatitude?>",vertexLongitude:"<?= $v->vertexLongitude?>"});
          </script>
        <?php endforeach;?>

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
                            <!-- <tr>
                              <td><strong>Jarak</strong></td>
                              <td>
                                <?= number_format($jarak,2)?>&nbsp Km
                              </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <td><strong><h2><b>Rute Terdekat</b></h2></strong></td>
                <div class="map-navigation">
                                <form id="formCariRute" method="post" action="?" class="clearfix">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Lokasi Asal</label>
                                        <div class="col-md-9">
                                            <input type="text" id="lokasiAsal" name="lokasiAsal" value="BPBD Kota Bekasi" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tujuan</label>
                                        <div class="col-md-9">
                                            <input type="text" id="tujuan" name="tujuan" value="<?=$pengaduan['kode_pengaduan']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <input id="cari_rute" type="submit" class="btn btn-primary btn-inversed btn-block" value="Cari Rute">
                                    </div><!-- /.form-group -->
                                    <div class="form-group col-sm-12" id="res" style="color:black;display: none;">
                                        <p><b>Rute </b>(<span id="lPath"></span>)</p>
                                        <p><b>Jarak Tempuh </b>(<span class="lJarak"></span> Km)</p>
                                        <table style="width:100%">
                                          <tr>
                                            <th>Kecepatan Rata-Rata</th>
                                            <th>Waktu Tempuh</th>
                                          </tr>
                                          <tr>
                                            <td><span id="j40"></span> Km/Jam</td>
                                            <td><span id="w40"></span> Menit</td>
                                          </tr>
                                          <tr>
                                            <td><span id="j60"></span> Km/Jam</td>
                                            <td><span id="w60"></span> Menit</td>
                                          </tr>
                                          <tr>
                                            <td><span id="j80"></span> Km/Jam</td>
                                            <td><span id="w80"></span> Menit</td>
                                          </tr>
                                          <tr>
                                            <td><span id="j100"></span> Km/Jam</td>
                                            <td><span id="w100"></span> Menit</td>
                                          </tr>
                                        </table>
                                    </div><!-- /.form-group -->
                                     <div class="form-group col-sm-12" id="resNone" style="color:black;display: none;">
                                     	<p><b id="resTidakDitemukan"></b></p>
                                     </div>
                                </form>
                            </div><!-- /.map-navigation -->
                <div id='map' style="height: 500px;margin-bottom: 23px;"></div>
                <!-- <div id='inputs'></div>
                <div id='errors'></div> -->
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
mapboxgl.accessToken = 'pk.eyJ1Ijoic29sb3BsYXllcmlkIiwiYSI6ImNrYm9zdmRuYjIzMDEydXBmbmpmcWVsNmcifQ.t0yJDa0gWtbAwcFVoACmVQ';
var map = new mapboxgl.Map({
    container: 'map', // container id
    style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
    center: [106.995150, -6.235189], // starting position [lng, lat]
    zoom: 14, // starting zoom
    logoPosition:'top-right',
});

  var marker = [];
  function createMarker(){
      datas.forEach(function(e){

      	if(e.ponpesNama){
      		var el = document.createElement('div');
          	el.className = 'marker';
      		el.style.backgroundImage = 'url(<?= site_url('upload/')?>'+e.ponpesGambar;
      		el.style.width = '50px';
      		el.style.height = '50px';
      		el.style.backgroundRepeat = "no-repeat";
      		el.style.backgroundSize = 'cover';
      		el.style.borderRadius = '50%';
      		el.innerHTML = '<div style="background-color: #00000091;bottom: 55px;position: inherit;border-radius: 4px;color:white;"><p style="line-height: normal;padding:4px;">'+e.ponpesNama+'</p></div>';
      		marker[e.ponpesNama] = [new mapboxgl.Marker(el).setLngLat([e.ponpesLongitude,e.ponpesLatitude]).addTo(map)];
      	}
      	if(e.vertexNama){
      		var el = document.createElement('div');
          	el.className = 'marker';
      		el.style.width = '50px';
      		el.style.height = '50px';
      		el.style.backgroundRepeat = "no-repeat";
      		el.style.backgroundSize = 'cover';
      		el.style.borderRadius = '50%';
      		el.innerHTML = '<div style=""><b> '+e.vertexNama+'</b></div>';
      		marker[e.vertexNama] = [new mapboxgl.Marker(el).setLngLat([e.vertexLongitude,e.vertexLatitude])];
      	}
      });
  }

  var lineMapLayer;
  function buatLine(Obj){
  	var cor = [];
  	Obj.forEach(function(i){
  		cor.push([marker[i][0]._lngLat.lng,marker[i][0]._lngLat.lat]);
  	});
  	console.log(cor);
  	lineMapLayer = map.addLayer({
  		"id": "route",
  		"type": "line",
  		"source": {
  		"type": "geojson",
  		"data": {
          		"type": "Feature",
          		"properties": {},
          		"geometry": {
              		"type": "LineString",
                  		"coordinates": cor
              		}
          		}
  		},
  		"layout": {
              		"line-join": "round",
              		"line-cap": "round"
              		},
  		"paint": {
              		"line-color": "#008000",
              		"line-width": 8
              		}
  		});
  }
  $("#cari_rute").click(function(e){
  	e.preventDefault();
  	$.ajax({
  		url  : "<?= site_url('Pengaduan/cariRute') ?>",
  		type : "POST",
  		data : $("#formCariRute").serialize(),
  		success : function(e){
  			console.log(e);
  			var Obj = JSON.parse(e);
  			if(Obj.distance[0]){
  				console.log(Obj);
  				if(lineMapLayer)
  				{
  				 	map.removeLayer("route");
  				 	map.removeSource("route");
  	    			$("#lAsal").text(Obj.from);
  	    			$("#lAkhir").text(Obj.to);
  	    			$(".lJarak").text(Obj.distance[0].toFixed(2));
  	    			// $("#lPath").text(Obj.path);
              var text ='';
              var rows = 10;
              var cols = 3;
              var o = 0;
              for (var i = 0; i < Obj.path.length; i++) {
                if (i==10) {
                  text += ' ' + Obj.path[i] + '-'+'<br>';
                }else{
                  text += ' ' + Obj.path[i] + '-';
                }
              }
              $('#lPath').append(text);
  	    			$("#res").show();
          			$("#resNone").hide();
  	    			buatLine(Obj.path);
  	    			map.flyTo({center:marker[Obj.from][0]._lngLat,zoom: 14,
  	    				  curve: 1,
  	    				  easing(t) {
  	    				    return t;
  	    				  }});
  				}else{
  	    			map.flyTo({center:marker[Obj.from][0]._lngLat,zoom: 14,
  	    				  curve: 1,
  	    				  easing(t) {
  	    				    return t;
  	    				  }});
  	    			buatLine(Obj.path);
  	    			$("#lAsal").text(Obj.from);
  	    			$("#lAkhir").text(Obj.to);
  	    			$(".lJarak").text(Obj.distance[0].toFixed(2));
              $("#j40").text(40);
              $("#w40").text(Math.ceil(Obj.distance[0].toFixed(2) / 40 * 60));
              $("#j60").text(60);
              $("#w60").text(Math.ceil(Obj.distance[0].toFixed(2) / 60 * 60));
              $("#j80").text(80);
              $("#w80").text(Math.ceil(Obj.distance[0].toFixed(2) / 80 * 60));
              $("#j100").text(100);
              $("#w100").text(Math.ceil(Obj.distance[0].toFixed(2) / 100 * 60));
  	    			// $("#lPath").text(Obj.path);
              var text ='';
              var rows = 10;
              var cols = 3;
              var o = 0;
              for (var i = 0; i < Obj.path.length; i++) {
                if (i==10) {
                  text += ' ' + Obj.path[i] + ' -'+'<br>';
                }else{
                  text += ' ' + Obj.path[i] + ' -';
                }
              }
              // for(var i = 0; i < rows; i++) {
              // 	text += '<tr>';
              //   for(var c = 0; c <= cols; c++)
              //   {
              //     text += '<td>' + Obj.path[i] + '</td>';
              //   }
              // 	text += '</tr>';
              // }
              $('#lPath').append(text);
  	    			$("#res").show();
          			$("#resNone").hide();
  				}

  			}else{
      			$("#res").hide();
      			$("#resNone").show();
      			$("#resTidakDitemukan").text("Jalur tidak ditemukan !");
  			}
  		}

  	});

  })
  createMarker();
</script>

<?php $this->load->view('footer'); ?>