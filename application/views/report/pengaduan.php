<div style="height:500px;">
    <table class="table table-bordered" border="1" id="table-inbound-report">
        <thead>
          <tr style="background-color: #3c8dbc; color: white;">
            <th width="3%">No</th>
            <th width="8%">Tanggal</th>
            <th width="8%">NIK</th>
            <th width="10%">Nama Pelapor</th>
            <th width="8%">Jenis Bencana</th>
            <th width="50%">Rincian Kejadian</th>
            <th width="10%">Latitude</th>
            <th width="10%">Longitude</th>
            <th width="10%">Jarak</th>           
            <th width="10%">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $temp_dn='';
            $head_counter=0;
            $item_counter=0;
          ?>
          <?php foreach ($pengaduan as $key => $row) { ?>
            <?php if($temp_dn!=$row->id_pengaduan) { $item_counter=0; $temp_dn=$row->id_pengaduan; //JIKA INI HEAD ?>
            <tr style="background-color: #ecf0f5">
              <td  width="3%"><b><?=++$head_counter?></b></td>
              <td  width="8%"><b><?=date("d-m-Y", strtotime($row->tanggal))?></b></td>
              <td  width="8%"><b><?=$row->nik?></b></td>
              <td  width="10%"><b><?=$row->nama?></b></td>
              <td  width="8%"><b><?=$row->jenis_bencana?></b></td>
              <td  width="50%"><b><?=$row->pengaduan?></b></td>
              <td  width="10%"><b><?=$row->Latitude?></b></td>
              <td  width="10%"><b><?=$row->Longitude?></b></td>
              <td  width="10%"><b><?=$row->jarak?></b></td>                 
              <td  width="10%"><b><?= ($row->status==0) ? 'Terverifikasi' : 'Belum Diverifikasi' ?></b></td>
            </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
    </table>
</div>
<script>
$("#table-inbound-report").tableHeadFixer({
// fix table header
head: true,

// fix table footer
foot: false,

// fix x left columns
left: 0,

// fix x right columns
right: 0,

// z-index
'z-index': 10000

});


</script>
