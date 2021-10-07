<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pengaduan');
    $this->load->library('PHPExcel');
		if ($this->session->userdata('userdata_desa') == null) {
			redirect('Login');
		}
	}

	public function index()
	{
		$user = $this->session->userdata('userdata_desa');

		if ($user['akses'] == 'admin') {
			$data['judul'] 	= 'Aplikasi Pelaporan Bencana';
			$data['aktif'] 	= 'report';
			// $data['semua'] 	= $this->M_home->get_aduan_all()->num_rows();
			// $data['sudah'] 	= $this->M_home->get_aduan_id(0)->num_rows();
			// $data['belum'] 	= $this->M_home->get_aduan_id(1)->num_rows();
			$this->load->view('report/index', $data);
		} else if ($user['akses'] == 'user') {
			redirect('Home/dashboard');
		}
	}


	public function Pengaduan($start_date=null,$end_date=null,$excel=false)
	{
		$data['pengaduan']=$this->M_pengaduan->read_report($start_date,$end_date);
		// print_r($start_date);
		// die();
		if($excel==false)
		{
				$this->load->view('Report/pengaduan',$data);
		}
		else
		{
				header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
				header("Content-type:   application/x-msexcel; charset=utf-8");
				header("Content-Disposition: attachment; filename=Rekapitulasi Laporan Bencana.xls");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);
				$this->load->view('Report/pengaduan',$data);
		}
	}


}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
