<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
    }

    public function index()
    {
        if ($this->session->userdata('userdata_desa') != null) {
            redirect('Home');
        }
		$this->load->view('login/index_user');
	}

    public function admin()
    {
        $this->load->view('login/index');
    }

    public function register()
    {
        $this->load->view('login/register');
    }

    public function proses_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Username Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('password', 'Password', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Password Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/index_user');
        }else{
            $u      = $this->input->post('username');
            $p      = md5($this->input->post('password'));
            $cek    = $this->M_login->cek_user($u, $p);
						// print_r($p);
						// die();

            if ($cek->num_rows() > 0) {
                $user_data              = $cek->row_array();
                $session['nik']         = $user_data['nik'];
                $session['nama']        = $user_data['nama'];
                $session['username']    = $user_data['username'];
                $session['password']    = $user_data['password'];
                $session['akses']       = 'user';
                $this->session->set_userdata('userdata_desa', $session);
                redirect('Home/dashboard');
            } else {
                $this->session->set_flashdata('gagal_login','1');
                redirect('Login/index');
            }
        }
    }

	public function proses()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Username Tidak Boleh Kosong.</div>'
                    )
            );
		$this->form_validation->set_rules('password', 'Password', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Password Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/index');
        }else{
            $u 		= $this->input->post('username');
            $p 		= md5($this->input->post('password'));
            $cek 	= $this->M_login->cek($u, $p);

            if ($cek->num_rows() > 0) {
            	$user_data	= $cek->row_array();
            	$session['id_admin'] 		= $user_data['id_admin'];
				$session['nama_admin'] 		= $user_data['nama_admin'];
				$session['username'] 		= $user_data['username'];
                $session['password']        = $user_data['password'];
				$session['akses'] 		    = 'admin';
				$this->session->set_userdata('userdata_desa', $session);
                redirect('Home');
            } else {
	            $this->session->set_flashdata('gagal_login','1');
	            redirect('Login/admin');
            }
        }
	}

    public function register_proses()
    {
        $this->form_validation->set_rules('val-number', 'NIK', 'numeric|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> NIK Tidak Valid.</div>'
                    )
            );
        $this->form_validation->set_rules('val-username', 'Username', 'is_unique[penduduk.username]|required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Username Tidak Boleh Kosong.</div>',
                    'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Username Sudah Dipakai.</div>',
                    )
            );
        $this->form_validation->set_rules('val-password', 'Password', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('val-confirm-password', 'Konfirmasi Password', 'matches[val-password]|required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Boleh Kosong.</div>',
                    'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Sama.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/register');
        }else{
            $nik = $this->input->post('val-number');

            $cek_nik = $this->M_login->cek_register($nik)->num_rows();

            if ($cek_nik < 1) {
                $this->session->set_flashdata('error_nik','1');
                $this->load->view('login/register');
            } else {
                $this->M_login->register($nik);
                $this->session->set_flashdata('sukses_register','1');
                redirect('login/register');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */