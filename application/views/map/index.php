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
                        <div id='map' style='width: 800px; height: 600px;'></div>
                    </div>
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->

<?php $this->load->view('footer'); ?>

<script>
mapboxgl.accessToken = 'pk.eyJ1Ijoic29sb3BsYXllcmlkIiwiYSI6ImNrYm9zdmRuYjIzMDEydXBmbmpmcWVsNmcifQ.t0yJDa0gWtbAwcFVoACmVQ';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [106.995160,-6.235094],
zoom: 12
});
// Add geolocate control to the map.
map.addControl(
new mapboxgl.GeolocateControl({
positionOptions: {
enableHighAccuracy: true
},
trackUserLocation: true
})
);
</script>
