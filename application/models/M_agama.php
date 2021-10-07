<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_agama extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all()
	{
		return $this->db->get('agama');
	}

	public function get_nik($nik)
	{
		$q = $this->db->query("SELECT * FROM penduduk, agama
								WHERE penduduk.nik = agama.nik
								AND penduduk.nik = '$nik'
								");	
		return $q;
	}

	public function get_id($id_agama)
	{
		$q = $this->db->query("SELECT * FROM agama, admin
								WHERE agama.id_admin = admin.id_admin
								AND agama.id_agama = '$id_agama' ");	
		return $q;
	}

	public function tambah()
	{
		$user 		= $this->session->userdata('userdata_desa');
		$nik 		= $user['nik'];
		$tanggal 	= date('d-m-Y');
		$agama 	= $this->input->post('agama');
		$status 	= 1;

		$data = array(
			'nik'    	=> $nik,
            'tanggal'   => $tanggal,
			'agama'	=> $agama,
            'status' 	=> $status
				);

		$this->db->insert('agama', $data);
	}

	public function edit_proses($id_agama)
	{
		$data = array(
			'agama' => $this->input->post('agama')
		);

		$this->db->where('id_agama', $id_agama);
		$this->db->update('agama', $data);
	}

}

/* End of file M_agama.php */
/* Location: ./application/models/M_agama.php */ 