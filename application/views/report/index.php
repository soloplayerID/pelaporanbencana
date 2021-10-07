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

        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->

        <!-- Form Components Row -->
        <div id="inbound_report_tab">
            <div class="row">
                <div class="box-header with-border box-success">
                  <div class="box-body">



                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date: </label>
                            <div class="input-group">
                                <input class="form-control" type="date" v-model="start_date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-3"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date: </label>
                            <div class="input-group">
                                <input class="form-control" type="date" v-model="end_date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-3"></div>
                  </div>

                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <span v-on:click="Show_Report()" class="btn btn-flat btn-primary"><i class="fa fa-list"></i> List Data</span>
                        <a v-bind:href="'<?php echo base_url() ?>'+'Report/Pengaduan/'+start_date+'/'+end_date+'/true'" class="btn btn-flat btn-default"><i class="fa fa-download"></i> Download</a>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                  </div>
                </div>
          </div>
          <div class="row" id="Inbound_Report_Show">

          </div>
      </div>
    </div>
    <!-- END Page Content -->
</div>
<!-- END Main Container -->

<?php $this->load->view('footer'); ?>
<script type="text/javascript">

var Inbound_Report = new Vue({
  el : '#inbound_report_tab',
  data (){
    return {
      start_date : '',
      end_date : '',
      base_url_vue : '<?php echo base_url() ?>',
    }
  },
  methods : {
    Show_Report: function()
    {
      if(this.start_date!='' && this.end_date!='')
      {
          $('#Inbound_Report_Show').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
          axios.get('<?php echo base_url() ?>'+'Report/Pengaduan/'+this.start_date+'/'+this.end_date).then(response => {
            $('#Inbound_Report_Show').html(response.data);
          }).catch(error => {
            // swal("ERROR!",'Terjadi Kesalahan Saat Melakukan request!', "error");
            alert("Terjadi Kesalahan Saat Melakukan request!!!");
            $('#Inbound_Report_Show').html('');
          });
        }
        else
        {
          // swal("ERROR!",'Field is Require', "error");
          alert("Field is Require!!");
        }
    }
  }
});

</script>
