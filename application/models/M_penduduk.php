<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_penduduk extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all()
	{
		$q = $this->db->query("SELECT * FROM penduduk, agama
								WHERE penduduk.id_agama = agama.id_agama
								");	
		return $q;
	}

	public function get_nik($nik)
	{
		$q = $this->db->query("SELECT * FROM penduduk, agama
								WHERE penduduk.id_agama = agama.id_agama
								AND penduduk.nik = '$nik'
								");	
		return $q;
	}

	public function tambah()
	{
		$data = array(
				'nik' 			=> $this->input->post('nik'),
				'nama' 			=> $this->input->post('nama'),
				'tempat_lahir' 	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'jk' 			=> $this->input->post('jk'),
				'id_agama' 		=> $this->input->post('id_agama')
			);

		$this->db->insert('penduduk', $data);
	}

	public function edit($nik)
	{
		$data = array(
				'nama' 			=> $this->input->post('nama'),
				'tempat_lahir' 	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'jk' 			=> $this->input->post('jk'),
				'id_agama' 		=> $this->input->post('id_agama'),
			);

		$this->db->where('nik', $nik);
		$this->db->update('penduduk', $data);
	}

}

/* End of file M_penduduk.php */
/* Location: ./application/models/M_penduduk.php */ 