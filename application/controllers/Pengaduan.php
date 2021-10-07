<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require("Dijkstra.php");
		$this->load->model('M_pengaduan');
		$this->load->model('M_Vertex');
        $this->load->library('PHPExcel');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('Login');
        }
	}

	// public function generate_name()
	// {
	// 		$param='pengaduan.'.date('y');
	// 		$result=$this->M_pengaduan->generate_name();
	// 		if(count($result)>0)
	// 		{
	// 				$result=$result[0]->nama;
	// 				$result=str_replace($param,"",$result);
	// 				$result=(int)$result;
	// 				$result++;
	// 				$result=$param.str_pad($result,3,"0",STR_PAD_LEFT);
	// 				echo $result;
	// 		}
	// 		else
	// 		{
	// 				echo 'pengaduan.'.date('y').'000';
	// 		}
	// }

	public function index()
	{
		$data['judul'] 		= 'Pelaporan Bencana >> Data Laporan';
		$data['aktif'] 		= 'pengaduan';
		$data['pengaduan'] = $this->M_pengaduan->get_all()->result();
		$this->load->view('pengaduan/index', $data);
	}

    public function data()
    {
        $user = $this->session->userdata('userdata_desa');
        $data['judul']      = "Pelaporan Bencana >> Data Laporan ".$user['nama'];
        $data['aktif']      = 'pengaduan';
        $data['pengaduan'] = $this->M_pengaduan->get_nik($user['nik'])->result();
        $this->load->view('pengaduan/index', $data);
    }

    public function tambah()
    {
        $data['judul']      = 'Pelaporan Bencana >> Input Data Laporan';
        $data['aktif']      = 'input';
        $this->load->view('pengaduan/input', $data);
    }

    public function tambah_proses()
    {
        $this->form_validation->set_rules('pengaduan', 'Pengaduan', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Form Laporan Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Input Data Laporan';
            $data['aktif']      = 'input';
            $this->load->view('pengaduan/input', $data);
        }else{
            //setting config untuk library upload
            $config['upload_path']      = './upload';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 10000000;
            $config['max_width']        = 1024000;
            $config['max_height']       = 768000;

            //pemanggilan library upload
            $this->load->library('upload', $config);

            //jika upload gagal
            if ( ! $this->upload->do_upload('foto'))
            {
                $data['judul']      = 'Pelaporan Bencana >> Input Data Laporan';
                $data['aktif']      = 'input';
                $this->session->set_flashdata('gagal_tambah','1');
                $this->load->view('pengaduan/input', $data);
                //jika upload berhasil
            }else{
                $gambar = $this->upload->data();
                $this->M_pengaduan->tambah($gambar['file_name']);
                $this->session->set_flashdata('sukses_tambah','1');
                redirect('pengaduan/data');
            }
        }
    }

	public function cariRute(){
		$b = $this->db->get('tb_graph')->result();
		$data_rute = array();
		$g = new Graph();
		foreach ($b as $dt_rute){
				$data_rute[$dt_rute->graphAwal][$dt_rute->graphAkhir]= $dt_rute->graphJarak;
				$g->addedge($dt_rute->graphAwal, $dt_rute->graphAkhir, $dt_rute->graphJarak);
		}

		list($distances, $prev) = $g->paths_from($this->input->post('lokasiAsal'));

		$res['from'] = $this->input->post('lokasiAsal');
		$res['to'] = $this->input->post('tujuan');
		$res['path'] = $g->paths_to($prev,$this->input->post('tujuan'));
		$res['distance'] = $g->paths_to($distances,$this->input->post('tujuan'));
		echo json_encode($res);
}

    public function detail($id_pengaduan)
    {
        $data['judul']      = 'Pelaporan Bencana >> Laporan >> Detail';
        $data['aktif']      = 'pengaduan';
				$data['getAllVertex']           = $this->M_Vertex->getAll();
        $data['getAllPonpes']           = $this->M_pengaduan->getAll();
        $data['pengaduan']  = $this->M_pengaduan->get_id($id_pengaduan)->row_array();

				// //titik awal (BPBD Kota Bekasi)
				// $latitude1=-6.235380976613541;
				// $longitude1=106.995719969427;
				// //data koordinat aduan warga, diambil dari database
				// $latitude2=$data['pengaduan']['Latitude'];
				// $longitude2=$data['pengaduan']['Longitude'];
				// // $latitude2=-6.242446760459558;
				// // $longitude2=106.98661141673233;
				//
				// $hasil1 = $latitude2 - $latitude1;
				// //pow() bertugas untuk memangkatkan, parameter 1.bilangan yg dipangkat, 2.nilai eksponen
				// $hasil1 = pow($hasil1, 2);
				//
				// $hasil2 = $longitude2 - $longitude1;
				// $hasil2 = pow($hasil2, 2);
				//
				// $hasil = $hasil1 + $hasil2;
				// $hasilsqrt = sqrt($hasil);
        // $data['jarak'] = $hasilsqrt * 111.319;

        $this->load->view('pengaduan/_detail', $data);
    }

    public function edit($id_pengaduan)
    {
        $data['judul']      = 'Pelaporan Bencana >> Edit Data Laporan';
        $data['aktif']      = 'data';
        $data['pengaduan']  = $this->M_pengaduan->get_id($id_pengaduan)->row_array();
        $this->load->view('pengaduan/edit', $data);
    }

    public function edit_proses2($id_pengaduan)
    {
        $this->form_validation->set_rules('pengaduan', 'Pengaduan', 'required|trim',
                array(
                    'required' => '<div class="alert alert-danger">Gagal! Form Laporan Tidak Boleh Kosong.</div>'
                    )
            );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pelaporan Bencana >> Edit Data Laporan';
            $data['aktif']      = 'input';
            $data['pengaduan']  = $this->M_pengaduan->get_id($id_pengaduan)->row_array();
            $this->load->view('pengaduan/input', $data);
        }else{
            if ($_FILES["foto"]["name"] == "") {
                $foto_lama = $this->input->post('foto_lama');
                $this->M_pengaduan->edit_proses($id_pengaduan, $foto_lama);
                $this->session->set_flashdata('sukses_edit','1');
                redirect('pengaduan/data');
            } else {
                //setting config untuk library upload
                $config['upload_path']      = './upload';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 10000000;
                $config['max_width']        = 1024000;
                $config['max_height']       = 768000;

                //pemanggilan library upload
                $this->load->library('upload', $config);

                //jika upload gagal
                if ( ! $this->upload->do_upload('foto'))
                {
                    $data['judul']      = 'Pelaporan Bencana >> Edit Data Laporan';
                    $data['aktif']      = 'data';
                    $data['pengaduan']  = $this->M_pengaduan->get_id($id_pengaduan)->row_array();
                    $this->load->view('pengaduan/edit', $data);
                    //jika upload berhasil
                }else{
                    $foto_lama = $this->input->post('foto_lama');
                    $q = $this->db->query("SELECT * FROM pengaduan WHERE file = '$foto_lama' ")->row()->file;
                    $f = './upload/'.$q;
                    unlink($f);

                    $gambar = $this->upload->data();
                    $file   = $gambar['file_name'];
                    $this->M_pengaduan->edit_proses($id_pengaduan, $file);


                    $this->session->set_flashdata('sukses_edit','1');
                    redirect('pengaduan/data');
                }
            }
        }
    }

    public function edit_proses($id_pengaduan)
    {
        $admin = $this->session->userdata('userdata_desa');

        $status = $this->M_pengaduan->get_id($id_pengaduan)->row()->status;

        if ($status == 1) {
            $data = array(
                'status'    => 0,
                'id_admin'  => $admin['id_admin']
            );
        } else {
            $data = array(
                'status'    => 1,
                'id_admin'  => $admin['id_admin']
            );
        }

            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->update('pengaduan', $data);

            redirect('Pengaduan');
    }

    public function hapus($id_pengaduan)
    {
        $q = $this->db->query("SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan' ")->row()->file;
        // $file = base_url('upload/'.$q);
        $file = './upload/'.$q;
        unlink($file);

        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->delete('pengaduan');

        $this->session->set_flashdata('sukses_hapus','1');
        $user = $this->session->userdata('userdata_desa');
        if ($user['akses'] == 'admin') {
            redirect('pengaduan');
        } else {
            redirect('pengaduan/data');
        }
    }
}

/* End of file pengaduan.php */
/* Location: ./application/controllers/pengaduan.php */
