<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk extends CI_Controller {

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
		$this->load->view('penduduk/index', $data);
	}

    public function tambah_proses()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> NIK Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim',
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
        $this->form_validation->set_rules('id_agama', 'Agama', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Agama Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Data Penduduk';
            $data['aktif']      = 'penduduk';
            $data['penduduk']   = $this->M_penduduk->get_all()->result();
            $data['agama']      = $this->M_agama->get_all()->result();
            $data['modal_show'] = "$('#modal-fade').modal('show');";
            $this->load->view('penduduk/index', $data);
        }else{
            $this->M_penduduk->tambah();
            $this->session->set_flashdata('sukses_tambah','1');
            redirect('penduduk');
        }
    }

    public function detail($nik)
    {
        $data['judul']      = 'Pelaporan Bencana >> Penduduk >> Detail';
        $data['aktif']      = 'penduduk';
        $data['penduduk']   = $this->M_penduduk->get_nik($nik)->row_array();
        $data['keluhan']    = $this->M_pengaduan->get_nik($nik)->num_rows();
        $this->load->view('penduduk/detail', $data);
    }

    public function edit($nik)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Data penduduk';
        $data['aktif']      = 'penduduk';
        $data['penduduk']  = $this->M_penduduk->get_nik($nik)->row_array();
        $data['agama']      = $this->M_agama->get_all()->result();
        $this->load->view('penduduk/edit', $data);
    }

    public function edit_proses($nik)
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> NIK Tidak Boleh Kosong.</div>'
                    )
            );
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim',
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
        $this->form_validation->set_rules('id_agama', 'Agama', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger"><strong>Error!</strong> Agama Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Edit Data penduduk';
            $data['aktif']      = 'penduduk';
            $data['penduduk']   = $this->M_penduduk->get_nik($nik)->row_array();
            $data['agama']      = $this->M_agama->get_all()->result();
            $this->load->view('penduduk/edit', $data);
        }else{
            $this->M_penduduk->edit($nik);
            $this->session->set_flashdata('sukses_edit','1');
            redirect('penduduk');
        }
    }

    public function hapus($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->delete('penduduk');

        $this->session->set_flashdata('sukses_hapus','1');
        redirect('penduduk');
    }
}

/* End of file penduduk.php */
/* Location: ./application/controllers/penduduk.php */