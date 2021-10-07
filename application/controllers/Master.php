<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('userdata_desa') == null) {
            redirect('Login');
        }
        $this->load->model('M_pengaduan');
        $this->load->model('M_Vertex');
        $this->load->model('M_Graph');
        $this->load->library('upload');
    }
	// public function index()
	// {
	//     $data['judulHalaman']      = 'Master';
	// 	$this->load->view('admin/dashboard',$data);
	// }

	/*
	 * Master Pengaduan
	 *
	 *  */
	public function getIDPonpes()
  {
      $id = $this->input->post('id');
      echo json_encode($this->M_pengaduan->getID($id));
  }

  public function gDataTablePonpes()
  {
    $this->M_pengaduan->gDataTable();
  }
	/*
	 * Master Vertex
	 *
	 *  */
	public function vVertex()
	{
      $data['judul'] 		= 'Pelaporan Bencana >> Data Laporan';
      $data['aktif'] 		= 'pengaduan';
	    $data['getAllVertex']      = $this->M_Vertex->getAll();
	    $data['getAllPonpes']      = $this->M_pengaduan->getAll();
	    $data['judulHalaman']      = 'Vertex';
		$this->load->view('admin/vertex',$data);
	}
	public function insertVertex()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('vertexNama','', 'required',array('required'=>'Nama Vertex Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'vertexNama'=> form_error('vertexNama', '', ''),

        );
        echo json_encode($json);
        else :

        $data = array(
            'vertexNama'=> $this->input->post('vertexNama'),
            'vertexLatitude'=> $this->input->post('vertexLatitude'),
            'vertexLongitude'=> $this->input->post('vertexLongitude'),
        );
        if($this->M_Vertex->insert($data)){
            echo 'DATA_BERHASIL_DISIMPAN';
        }else{
            echo 'DATA_GAGAL_DISIMPAN';
        }
        endif;
    }
	public function updateVertex()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('vertexNama','', 'required',array('required'=>'Nama Vertex Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'vertexNama'=> form_error('vertexNama', '', ''),

        );
        echo json_encode($json);
        else :

        $data = array(
            'vertexNama'=> $this->input->post('vertexNama'),
            'vertexLatitude'=> $this->input->post('vertexLatitude'),
            'vertexLongitude'=> $this->input->post('vertexLongitude'),
        );
        if($this->M_Vertex->update($this->input->post('vertexID'),$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function gDataTableVertex()
	{
        $this->M_Vertex->gDataTable();
    }
    public function deleteVertex(){
	    $data = array(
        'vertexID'      =>   $this->input->post('id'),
	    );
        if($this->M_Vertex->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
	public function getIDVertex()
    {
        $id = $this->input->post('id');
        echo json_encode($this->M_Vertex->getID($id));
    }
    /*
     * Master Graph
     *
     *  */
    public function vGraph()
    {
        $data['getAllVertex']           = $this->M_Vertex->getAll();
        $data['getAllPonpes']           = $this->M_pengaduan->getAll();
        $data['judulHalaman']           = 'Graph';
        $this->load->view('admin/graph',$data);
    }
    public function insertGraph()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('graphAwal','', 'required',array('required'=>'Graph Awal Tidak Boleh Kosong'));
        $this->form_validation->set_rules('graphAkhir','', 'required',array('required'=>'Graph Akhir Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'graphAwal'=> form_error('graphAwal', '', ''),
            'graphAkhir'=> form_error('graphAkhir', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'graphAwal'=> $this->input->post('graphAwal'),
            'graphAkhir'=> $this->input->post('graphAkhir'),
            'graphJarak'=> $this->input->post('graphJarak'),
        );
        if($this->M_Graph->insert($data)){
            echo 'DATA_BERHASIL_DISIMPAN';
        }else{
            echo 'DATA_GAGAL_DISIMPAN';
        }
        endif;
    }
    public function gDataTableGraph()
	{
        $this->M_Graph->gDataTable();
    }
    public function deleteGraph(){
	    $data = array(
        'graphID'      =>   $this->input->post('id'),
	    );
        if($this->M_Graph->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
	public function getIDGraph()
    {
        $id = $this->input->post('id');
        echo json_encode($this->M_Graph->getID($id));
    }
    public function updateGraph()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('graphAwal','', 'required',array('required'=>'Graph Awal Tidak Boleh Kosong'));
        $this->form_validation->set_rules('graphAkhir','', 'required',array('required'=>'Graph Akhir Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'graphAwal'=> form_error('graphAwal', '', ''),
            'graphAkhir'=> form_error('graphAkhir', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'graphAwal'=> $this->input->post('graphAwal'),
            'graphAkhir'=> $this->input->post('graphAkhir'),
            'graphJarak'=> $this->input->post('graphJarak'),
        );
        if($this->M_Graph->update($this->input->post('graphID'),$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    /*
     * Master Post
     *
     *  */
    public function vPost()
    {
        $data['judulHalaman']           = 'Berita';
        $data['getAllKategori']        = $this->M_Kategori->getAllKategori();
        $this->load->view('admin/post',$data);
    }
    public function insertPost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('postJudul',
            '', 'required',array('required'=>'Judul Postingan Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'postJudul'=> form_error('postJudul', '', ''),
        );
        echo json_encode($json);
        else :

        $config['upload_path'] = './assets/img/post/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        $data = array();
        if(!empty($_FILES['featuredImage']['name']))
        {
            if ($this->upload->do_upload('featuredImage'))
            {
                $gbr = $this->upload->data();
                $data['postFeaturedImage'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
            }else{
                echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
            }

        }else{
            $data['postFeaturedImage'] = 'default.jpg';
        }
        $data['postJudul'] = $this->input->post('postJudul');
        $data['postKonten']= $this->input->post('postKonten');
        $data['postKategori']= $this->input->post('postKategori');
        $data['postTanggalInsert'] = date('Y-m-d H:i:s');
        if($this->M_Post->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function gDataTablePost()
	{
        $this->M_Post->gDataTable();
    }
    public function deletePost(){
	    $data = array(
        'postID'      =>   $this->input->post('id'),
	    );
        if($this->M_Post->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
	public function getIDPost()
    {
        $id = $this->input->post('id');
        echo json_encode($this->M_Post->getID($id));
    }
    public function updatePost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('postJudul',
            '', 'required',array('required'=>'Judul Postingan Tidak Boleh Kosong'));

        if ($this->form_validation->run() == false) :
        $json = array(
            'postJudul'=> form_error('postJudul', '', ''),

        );
        echo json_encode($json);
        else :
        $config['upload_path'] = './assets/img/post/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        $data = array();
        if(!empty($_FILES['featuredImage']['name']))
        {
            if ($this->upload->do_upload('featuredImage'))
            {
                unlink(realpath('./').'/assets/img/post/'.$this->input->post('old_foto'));
                $gbr = $this->upload->data();
                $data['postFeaturedImage'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
            }else{
                echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
            }

        }
        $data['postJudul'] = $this->input->post('postJudul');
        $data['postKonten']= $this->input->post('postKonten');
        $data['postTanggalInsert'] = date('Y-m-d H:i:s');
        $id = $this->input->post('postID');
        if($this->M_Post->update($id,$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function previewPost($postID)
    {
        $data['dataPostByID']           = $this->M_Post->getID($postID);
        $data['judulHalaman']           = 'Preview Post';
        $this->load->view('admin/previewPost',$data);
    }
}
