<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaduan extends CI_Model {

	private $tbl_ = 'pengaduan';
	public $variable;

	public function __construct()
	{
		parent::__construct();

	}

	function read_report($start=null,$end=null)
	{
		$this->db->from('pengaduan a');
		$this->db->where('a.tanggal <',$end);
		$this->db->where('a.tanggal >=',$start);
		$this->db->order_by("a.tanggal", "asc");
		return $this->db->get()->result();
	}

	function generate_name($param='')
	{
			if($param!='')
	    {
	        $this->db->like('kode_pengaduan',$param);
	        $this->db->select_max('kode_pengaduan');
	        return $this->db->get($this->tbl_)->result();
	    }
	}

	public function gDataTable()
  {
      /*Menagkap semua data yang dikirimkan oleh client*/

      /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
       server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
       sesuai dengan urutan yang sebenarnya */
      @$draw=$_REQUEST['draw'];

      /*Jumlah baris yang akan ditampilkan pada setiap page*/
      @$length=$_REQUEST['length'];

      /*Offset yang akan digunakan untuk memberitahu database
       dari baris mana data yang harus ditampilkan untuk masing masing page
       */
      @$start=$_REQUEST['start'];

      /*Keyword yang diketikan oleh user pada field pencarian*/
      @$search=$_REQUEST['search']["value"];

      /*Menghitung total desa didalam database*/
      $total=$this->db->count_all_results($this->tbl_);

      /*Mempersiapkan array tempat kita akan menampung semua data
       yang nantinya akan server kirimkan ke client*/
      $output=array();

      /*Token yang dikrimkan client, akan dikirim balik ke client*/
      $output['draw']=$draw;
      /*
       $output['recordsTotal'] adalah total data sebelum difilter
       $output['recordsFiltered'] adalah total data ketika difilter
       Biasanya kedua duanya bernilai sama, maka kita assignment
       keduaduanya dengan nilai dari $total
       */
      $output['recordsTotal']=$output['recordsFiltered']=$total;

      /*disini nantinya akan memuat data yang akan kita tampilkan
       pada table client*/
      $output['data']=array();

      /*Jika $search mengandung nilai, berarti user sedang telah
       memasukan keyword didalam filed pencarian*/
      if($search!=""){
          $this->db->like("nama",$search);
      }
      /*Lanjutkan pencarian ke database*/
      $this->db->limit($length,$start);
      /*Urutkan dari alphabet paling terkahir*/
      $this->db->order_by("{$this->tbl_}.id_pengaduan",'DESC');
      $query=$this->db->get($this->tbl_);

      /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
       dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
       yang mengandung keyword tertentu
       */
      if($search!=""){
          $this->db->like("nama",$search);
          $jum=$this->db->get($this->tbl_);
          $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
      }

      $nomor_urut=$start+1;
      foreach ($query->result_array() as $data) {
          $output['data'][]=array(
                  $nomor_urut,
                  $data['nama'],
                  "<button class='edit btn btn-sm btn-success waves-effect waves-light' data-id='{$data['id_pengaduan']}'> Edit</button>
                  <button class='hapus btn btn-danger btn-sm waves-effect waves-light' data-id='{$data['id_pengaduan']}'> Hapus</button>"
              );
          $nomor_urut++;
      }
      echo json_encode($output);
  }

  public function getID($id){
      $this->db->where('id_pengaduan',$id);
      $this->db->limit(1);
      $res = $this->db->get($this->tbl_);
      if($res->num_rows() > 0){
          return $res->result()[0];
      }else{
          return false;
      }
  }

	public function get_all()
	{
		$q = $this->db->query("SELECT * FROM penduduk, pengaduan
								WHERE penduduk.nik = pengaduan.nik
								");
		return $q;
	}

	public function getAll()
  {
      $res = $this->db->get($this->tbl_);
      if($res->num_rows() > 0){
          return $res->result();
      }
  }

	public function get_nik($nik)
	{
		$q = $this->db->query("SELECT * FROM penduduk, pengaduan
								WHERE penduduk.nik = pengaduan.nik
								AND penduduk.nik = '$nik'
								");
		return $q;
	}

	public function get_id($id_pengaduan)
	{
		$q = $this->db->query("SELECT pengaduan.*, admin.*, penduduk.nama as nama_lengkap FROM pengaduan, admin, penduduk
								WHERE pengaduan.id_admin = admin.id_admin
								AND pengaduan.nik = penduduk.nik
								AND pengaduan.id_pengaduan = '$id_pengaduan' ");
		return $q;
	}

	public function tambah($file)
	{
		$param='pengaduan.'.date('y');
		$result=$this->generate_name($param);
		if(count($result)>0)
		{
				$result=$result[0]->kode_pengaduan;
				$result=str_replace($param,"",$result);
				$result=(int)$result;
				$result++;
				$result=$param.str_pad($result,3,"0",STR_PAD_LEFT);
		}
		else
		{
				$result = 'pengaduan.'.date('y').'000';
		}

		$user 		= $this->session->userdata('userdata_desa');
		$nik 		= $user['nik'];
		$tanggal 	= date('Y-m-d');
		$pengaduan 	= $this->input->post('pengaduan');
		$status 	= 1;
		//titik awal (BPBD Kota Bekasi)
		$latitude1=-6.235380976613541;
		$longitude1=106.995719969427;
		//data koordinat aduan warga, diambil dari database
		$latitude2=$this->input->post('Latitude');
		$longitude2=$this->input->post('Longitude');
		// $latitude2=-6.242446760459558;
		// $longitude2=106.98661141673233;

		$hasil1 = $latitude2 - $latitude1;
		//pow() bertugas untuk memangkatkan, parameter 1.bilangan yg dipangkat, 2.nilai eksponen
		$hasil1 = pow($hasil1, 2);

		$hasil2 = $longitude2 - $longitude1;
		$hasil2 = pow($hasil2, 2);

		$hasil = $hasil1 + $hasil2;
		$hasilsqrt = sqrt($hasil);
		$jarak = $hasilsqrt * 111.319;

		$data = array(
			'kode_pengaduan' => $result,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'Latitude' => $this->input->post('Latitude'),
			'Longitude' => $this->input->post('Longitude'),
			'jarak' => number_format($jarak,2).' KM',
			'nik'    	=> $nik,
      'tanggal'   => $tanggal,
			'pengaduan'	=> $pengaduan,
			'jenis_bencana' => $this->input->post('jenis_bencana'),
			'file'		=> $file,
      'status' 	=> $status
		);

		$this->db->insert('pengaduan', $data);
	}

	public function edit_proses($id_pengaduan, $file)
	{
		$data = array(
			'pengaduan' => $this->input->post('pengaduan'),
			'file' => $file
		);

		$this->db->where('id_pengaduan', $id_pengaduan);
		$this->db->update('pengaduan', $data);
	}

}

/* End of file M_pengaduan.php */
/* Location: ./application/models/M_pengaduan.php */
