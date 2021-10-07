<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
		if ($this->session->userdata('userdata_desa') == null) {
			redirect('Login');
		}
	}

	public function index()
	{
		$user = $this->session->userdata('userdata_desa');

		if ($user['akses'] == 'admin') {
			redirect('Home/dashboard_admin');
		} else if ($user['akses'] == 'user') {
			redirect('Home/dashboard');
		}
	}

	public function dashboard_admin()
	{
		$data['judul'] 	= 'Aplikasi Pelaporan Bencana';
		$data['aktif'] 	= 'home';
		$data['semua'] 	= $this->M_home->get_aduan_all()->num_rows();
		$data['sudah'] 	= $this->M_home->get_aduan_id(0)->num_rows();
		$data['belum'] 	= $this->M_home->get_aduan_id(1)->num_rows();

		$this->load->view('home/index', $data);
	}

	public function dashboard()
	{
		$user = $this->session->userdata('userdata_desa');

		$data['judul'] 	= 'Aplikasi Pelaporan Bencana';
		$data['aktif'] 	= 'home';
		$data['semua'] 	= $this->M_home->get_aduan_nik($user['nik'])->num_rows();
		$data['sudah'] 	= $this->M_home->get_aduan_id_nik($user['nik'], 0)->num_rows();
		$data['belum'] 	= $this->M_home->get_aduan_id_nik($user['nik'], 1)->num_rows();

		$this->load->view('home/index', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */