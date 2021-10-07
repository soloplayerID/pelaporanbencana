<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('admin/_part/style')?>
<!--alerts CSS -->
	<link rel="shortcut icon" href="<?=base_url()?>logo_bpbd.png">
    <link href="<?= base_url('assets/map/')?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/map/')?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets/map/')?>plugins/bower_components/dropify/dist/css/dropify.min.css">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
    <style type="text/css">
    .marker {
        display: block;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
        background-position: top;
    }
    </style>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
		<?php $this->load->view('admin/_part/sidebar')?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?= $judulHalaman;?></h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
	           <!-- content -->
			   <!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                        	<script type="text/javascript">
								var data = [];
								<?php foreach ($getAllVertex as $v):?>
									data.push({vertexNama:"<?= $v->vertexNama?>",vertexLatitude:"<?= $v->vertexLatitude ?>",vertexLongitude:"<?= $v->vertexLongitude ?>"});
								<?php endforeach;?>
                        	</script>
                        	<script type="text/javascript">
								var data2 = [];
								<?php foreach ($getAllPonpes as $v):?>
									data2.push({ponpesNama:"<?= $v->kode_pengaduan?>",ponpesLatitude:"<?= $v->Latitude ?>",ponpesLongitude:"<?= $v->Longitude ?>"});
								<?php endforeach;?>
                        	</script>
                            <h3 class="box-title m-b-0">Form Inputan <?= $judulHalaman;?></h3>                            
                            <form class="form-horizontal" id="insertData">
                                <input type="hidden" id="graphID" name="graphID">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Lokasi Awal</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="graphAwal" name="graphAwal">
                                        	<option value="">-Pilih Lokasi Awal-</option>
                                        	<optgroup label="Vertex">Vertex</optgroup>
                                        	<?php foreach ($getAllVertex as $v):?>
                                        	<option  lat="<?= $v->vertexLatitude?>" lng="<?= $v->vertexLongitude ?>" value="<?= $v->vertexNama?>"><?= $v->vertexNama?></option>
                                        	<?php endforeach;?>
                                        	<optgroup label="pengaduan">pengaduan</optgroup>
                                        	<?php foreach ($getAllPonpes as $v):?>
                                        	<option lat="<?= $v->Latitude?>" lng="<?= $v->Longitude ?>" value="<?= $v->kode_pengaduan?>"><?= $v->kode_pengaduan?></option>
                                        	<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Lokasi Akhir</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="graphAkhir" name="graphAkhir">
                                        	<option value="">-Pilih Lokasi Akhir-</option>
                                        	<optgroup label="Vertex">Vertex</optgroup>
                                        	<?php foreach ($getAllVertex as $v):?>
                                        	<option lat="<?= $v->vertexLatitude?>" lng="<?= $v->vertexLongitude ?>" value="<?= $v->vertexNama?>"><?= $v->vertexNama?></option>
                                        	<?php endforeach;?>
                                          <optgroup label="pengaduan">pengaduan</optgroup>
                                        	<?php foreach ($getAllPonpes as $v):?>
                                        	<option lat="<?= $v->Latitude?>" lng="<?= $v->Longitude ?>" value="<?= $v->kode_pengaduan?>"><?= $v->kode_pengaduan?></option>
                                        	<?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Map</label>
                                    <div class="col-sm-9">
                                       <div id="map" class="" style="height: 340px;margin-bottom: 23px;"></div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="graphJarak" name="graphJarak" placeholder="Longitude">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Jarak</label>
                                    <div class="col-sm-9">
                                       <p id="jaraxText" style="padding-top: 6px;">- Km</p>
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button style="display: none;" id="btn-update" type="button" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                        <button id="btn-submit" type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                                        <button id="btn-reset" type="reset" class="btn btn-info waves-effect waves-light m-t-10">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Data <?= $judulHalaman;?></h3>
                            <p class="text-muted m-b-30 font-13"> Berikut merupakan data <?= $judulHalaman;?> yang sudah terinput </p>
                        	<div class="table-responsive">
                                <table id="demo-foo-addrow" class=" nowrap table table-hover" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Graph</th>
                                            <th>Jarak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dt_tab">

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
			<!-- /content -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2020 &copy; <a href="https://bpbd.bekasikota.go.id/" target="_blank">BPBD Kota Bekasi</a> </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/map/')?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= base_url('assets/map/')?>js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('assets/map/')?>js/waves.js"></script>
    <!--Counter js -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url('assets/map/')?>js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="<?= base_url('assets/map/')?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- Sweet-Alert  -->
	<script src="<?= base_url('assets/map/') ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
	<script src="<?= base_url('assets/map/') ?>plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- This is data table -->
    <script src="<?= base_url('assets/map/') ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/map/') ?>turf/turf.min.js"></script>
		<script type="text/javascript">
		$("#demo-foo-addrow").DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ordering: false,
			processing: true,
			serverSide: true,
			ajax: {
			  url: "<?php echo site_url('Master/gDataTableGraph') ?>",
			  type:'POST'
			}
		});
		mapboxgl.accessToken = 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog';
        var map = new mapboxgl.Map({
            container: 'map', // container id
            style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
            center: [106.995150, -6.235189], // starting position [lng, lat]
            zoom: 13, // starting zoom
            logoPosition:'top-right',
        });
        var lineMapLayer;
        function buatLine(){
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
                        		"coordinates": [
                            		[$("#graphAwal").find(":selected").attr('lng'), $("#graphAwal").find(":selected").attr('lat')],
                            		[$("#graphAkhir").find(":selected").attr('lng'), $("#graphAkhir").find(":selected").attr('lat')]
                        		]
                    		}
                		}
        		},
        		"layout": {
                    		"line-join": "round",
                    		"line-cap": "round"
                    		},
        		"paint": {
                    		"line-color": "#888",
                    		"line-width": 8
                    		}
        		});

        }
		function kalkulasiJarak(){
			var distance = turf.distance(turf.point([$("#graphAwal").find(":selected").attr('lng'), $("#graphAwal").find(":selected").attr('lat')]), turf.point([$("#graphAkhir").find(":selected").attr('lng'), $("#graphAkhir").find(":selected").attr('lat')]), {units: 'kilometers'}).toFixed(4);
			$("#jaraxText").text(distance + ' Km');
			$("#graphJarak").val(distance);
			if(lineMapLayer)
			{
			 	map.removeLayer("route");
			 	map.removeSource("route");
    			buatLine();
			}else{
    			buatLine();
			}
		}
        $("#graphAwal,#graphAkhir").change(function(){
            if($("#graphAwal").val() != "" && $("#graphAkhir").val() != ""){
            	kalkulasiJarak();
            }else{
            	$("#jaraxText").text(" km");
            }
        });
		data.forEach(function(index,item){
			var el = document.createElement('div');
			el.className = 'marker';
			el.style.backgroundImage = 'url(http://localhost/project-pencarian-cagar-budaya-sukabumi-dengan-floyd-warshall/assets/map/img/marker/marker-icon2.png)';
			el.style.width = '50px';
			el.style.height = '50px';
			el.style.backgroundRepeat = "no-repeat";
			new mapboxgl.Marker(el).setLngLat([index.vertexLongitude,index.vertexLatitude]).addTo(map);
			new mapboxgl.Popup({ offset: [0, -20] })
		    .setLngLat([index.vertexLongitude,index.vertexLatitude])
		    .setHTML('<b style="color:#f33155;">' + index.vertexNama + '</b>')
		    .setLngLat([index.vertexLongitude,index.vertexLatitude])
		    .addTo(map);
		});
		data2.forEach(function(index,item){
			var el = document.createElement('div');
			el.className = 'marker';
			el.style.backgroundImage = 'url(http://localhost/project-pencarian-cagar-budaya-sukabumi-dengan-floyd-warshall/assets/map/img/marker/marker-icon3.png)';
			el.style.width = '50px';
			el.style.height = '50px';
			el.style.backgroundRepeat = "no-repeat";
			new mapboxgl.Marker(el).setLngLat([index.ponpesLongitude,index.ponpesLatitude]).addTo(map);
      new mapboxgl.Popup({ offset: [0, -20] })
		    .setLngLat([index.ponpesLongitude,index.ponpesLatitude])
		    .setHTML('<b style="color:#f33155;">' + index.ponpesNama + '</b>')
		    .setLngLat([index.ponpesLongitude,index.ponpesLatitude])
		    .addTo(map);
		});
		$(document).on("click",".hapus",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		swal({
			title:"Konfirmasi",
			text:"Yakin akan menghapus data ini ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak",
			closeOnConfirm: true,
			},
			function(){
				$.ajax({
					url : "<?= site_url('Master/deleteGraph')?>",
					data : {id:id},
					type: 'POST',
					success : function(e){
						sweetAlert("Hapus Data Berhasil","","success");
						$('#demo-foo-addrow').DataTable().ajax.reload();
						$("#btn-cancel").trigger("click");
					}
				});
			});
		});
		$("#btn-update").click(function(e){
			e.preventDefault();
			$.ajax({
				url : "<?= site_url('Master/updateGraph')?>",
				data : new FormData($("#insertData")[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					sweetAlert("Update Data Success","","success");
					$('#demo-foo-addrow').DataTable().ajax.reload();
				}
			});
		});
		$(document).on("click",".edit",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		$.ajax({
				url : "<?= site_url('Master/getIDGraph')?>",
				data : {id:id},
				type: 'POST',
				success : function(e){
					var Obj = JSON.parse(e);
					$("#graphID").val(Obj.graphID);
					$("#graphAwal").val(Obj.graphAwal);
					$("#graphAkhir").val(Obj.graphAkhir);
					$("#graphJarak").val(Obj.graphJarak);
					$("#jaraxText").text(Obj.graphJarak+" km");
					if(lineMapLayer)
					{
					 	map.removeLayer("route");
					 	map.removeSource("route");
		    			buatLine();
					}else{
		    			buatLine();
					}
					$("#btn-update").show();
					$("#btn-cancel").show();
					$("#btn-submit").hide();
				}
			});
		});
		$("#btn-cancel").click(function(e){
			e.preventDefault();
			$(this).hide();
			$("#btn-submit").show();
			$("#btn-reset").trigger("click");
    		$("#btn-cancel").hide();
			$("#btn-update").hide();
		});
		$("#insertData").submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "<?= site_url('Master/insertGraph')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e=="DATA_BERHASIL_DISIMPAN"){
						swal("Insert Data Berhasil","","success");
    					$('#demo-foo-addrow').DataTable().ajax.reload();
    					$("#btn-reset").trigger("click");
					}else{
						var msg = [];
						var Obj = JSON.parse(e);
						for(a in Obj){
							if(Obj[a] != ""){
								msg.push(Obj[a]);
							}
						}
						sweetAlert("Gagal",msg.join(', '),"warning");
					}
				}
			});
		});
	</script>
</body>

</html>
