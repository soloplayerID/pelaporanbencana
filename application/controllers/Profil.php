<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_penduduk');
        $this->load->model('M_admin');
        $this->load->model('M_agama');
        $this->load->library('PHPExcel');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('Login');
        }
    }

    public function profil_user($nik)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Profil';
        $data['aktif']      = 'profil';
        $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
        $data['agama']      = $this->M_agama->get_all()->result();
        $this->load->view('profil/edit', $data);
    }

    public function profil_admin($id_admin)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Profil';
        $data['aktif']      = 'profil';
        $data['admin']     = $this->M_admin->get_id($id_admin)->row_array();
        $this->load->view('profil/edit_admin', $data);
    }

    public function edit_akun($nik)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Akun';
        $data['aktif']      = 'akun';
        $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
        $this->load->view('profil/edit_akun', $data);
    }

    public function edit_akun_admin($id_admin)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Akun';
        $data['aktif']      = 'akun';
        $data['profil']     = $this->M_admin->get_id($id_admin)->row_array();
        $this->load->view('profil/edit_akun_admin', $data);
    }

    public function edit_proses($nik)
    {
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
            $data['judul']      = 'Pelaporan Bencana >> Edit Profil';
            $data['aktif']      = 'profil';
            $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
            $data['agama']      = $this->M_agama->get_all()->result();
            $this->load->view('profil/edit', $data);
        }else{
            $this->M_penduduk->edit($nik);
            $this->session->set_flashdata('sukses_edit','1');
            redirect('profil/profil_user/'.$nik);
        }
    }

    public function edit_proses_admin($id_admin)
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

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Edit Profil';
            $data['aktif']      = 'profil';
            $data['admin']     = $this->M_admin->get_id($id_admin)->row_array();
            $this->load->view('profil/edit_admin', $data);
        }else{
            $this->M_admin->edit($id_admin);
            $this->session->set_flashdata('sukses_edit','1');
            redirect('profil/profil_admin/'.$id_admin);
        }
    }

    public function edit_akun_proses($nik)
    {
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
            $data['judul']      = 'Pelaporan Bencana >> Edit Akun';
            $data['aktif']      = 'akun';
            $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
            $this->load->view('profil/edit_akun', $data);
        }else{
            $cek_nik        = $this->db->query("SELECT * FROM penduduk WHERE nik = '$nik' ")->row_array();


            $pass_lama_in   = MD5($this->input->post('password_lama'));
            $pass_baru      = MD5($this->input->post('password'));

            if ($cek_nik['password'] == $pass_lama_in) {
                $data = array('password' => $pass_baru);

                $this->db->where('nik', $nik);
                $this->db->update('penduduk', $data);

                $this->session->set_flashdata('sukses_edit','1');
                redirect('Profil/edit_akun/'.$nik);
            } else {
                $this->session->set_flashdata('gagal_edit','1');
                redirect('Profil/edit_akun/'.$nik);
            }
        }
    }

    public function edit_akun_admin_proses($id_admin)
    {
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
            $data['judul']      = 'Pelaporan Bencana >> Edit Akun';
            $data['aktif']      = 'akun';
            $data['profil']     = $this->M_admin->get_id($id_admin)->row_array();
            $this->load->view('profil/edit_akun_admin', $data);
        }else{
            $cek_id        = $this->db->query("SELECT * FROM admin WHERE id_admin = '$id_admin' ")->row_array();


            $pass_lama_in   = MD5($this->input->post('password_lama'));
            $pass_baru      = MD5($this->input->post('password'));

            if ($cek_id['password'] == $pass_lama_in) {
                $data = array('password' => $pass_baru);

                $this->db->where('id_admin', $id_admin);
                $this->db->update('admin', $data);

                $this->session->set_flashdata('sukses_edit','1');
                redirect('Profil/edit_akun_admin/'.$id_admin);
            } else {
                $this->session->set_flashdata('gagal_edit','1');
                redirect('Profil/edit_akun_admin/'.$id_admin);
            }
        }
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */