<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model {

	public function get_aduan_all()
	{
		return $this->db->get('pengaduan');
	}

	public function get_aduan_nik($nik)
	{
		$this->db->where('nik', $nik);
		return $this->db->get('pengaduan');
	}

	public function get_aduan_id($status)
	{
		$this->db->where('status', $status);
		return $this->db->get('pengaduan');
	}

	public function get_aduan_id_nik($nik, $status)
	{
		$this->db->where('nik', $nik);
		$this->db->where('status', $status);
		return $this->db->get('pengaduan');
	}

}

/* End of file M_home.php */
/* Location: ./application/models/M_home.php */ 