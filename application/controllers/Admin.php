<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
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
		$data['judul'] 		= 'Pelaporan Bencana >> Data Admin';
		$data['aktif'] 		= 'admin';
		$data['admin']	    = $this->M_admin->get_all()->result();
		$this->load->view('admin/index', $data);
	}

    public function tambah_proses()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Tempat Lahir Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Tanggal Lahir Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Jenis Kelamin Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username]|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Username Tidak Boleh Kosong.</div>',
                    'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Username Sudah Digunakan.</div>',
                    )
            );
        $this->form_validation->set_rules('password', 'Password', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Boleh Kosong.</div>',
                    'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Sama.</div>',
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Data Admin';
            $data['aktif']      = 'admin';
            $data['admin']      = $this->M_admin->get_all()->result();
            $data['modal_show'] = "$('#modal-fade').modal('show');";
            $this->load->view('admin/index', $data);
        }else{
            $this->M_admin->tambah();
            $this->session->set_flashdata('sukses_tambah','1');
            redirect('admin');
        }
    }

    public function edit($id_admin)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Data admin';
        $data['aktif']      = 'admin';
        $data['admin']      = $this->M_admin->get_id($id_admin)->row_array();
        $this->load->view('admin/edit', $data);
    }

    public function edit_proses($id_admin)
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Admin Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Tempat Lahir Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Tanggal Lahir Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Jenis Kelamin Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Edit Data admin';
            $data['aktif']      = 'admin';
            $data['admin']      = $this->M_admin->get_id($id_admin)->row_array();
            $this->load->view('admin/edit', $data);
        }else{
            $this->M_admin->edit($id_admin);
            $this->session->set_flashdata('sukses_edit','1');
            redirect('admin');
        }
    }

    public function hapus($id_admin)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->delete('admin');

        $this->session->set_flashdata('sukses_hapus','1');
        redirect('admin');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */