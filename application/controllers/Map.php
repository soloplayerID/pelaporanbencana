<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_penduduk');
        $this->load->model('M_agama');
    $this->load->model('M_pengaduan');
        $this->load->library('PHPExcel');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('Login');
        }
  }

	public function index()
	{
    $data['judul'] 		= 'Pelaporan Bencana >> Data Penduduk';
		$data['aktif'] 		= 'penduduk';
		$data['penduduk']	= $this->M_penduduk->get_all()->result();
		$data['agama'] 		= $this->M_agama->get_all()->result();
		$this->load->view('Map/index', $data);
	}


}