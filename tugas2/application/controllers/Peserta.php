<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

  function __construct() {
    parent::__construct();

    //Load library dan controller lainnya
    $this->load->model('M_peserta', 'peserta', true);

  }

  //fungsi index peserta
  //redirect ke welcome index
	public function index()
	{
		redirect();
	}

  //fungsi manage peserta
  //load view manage peserta
  public function manage()
  {
    $data['managepeserta'] = 'active';
    $this->load->view('managepeserta', $data);
  }

  //fungsi tambah peserta
  //laod view tambah peserta
  public function tambah()
  {
    $data['tambahPeserta'] = 'active';
    $this->load->view('tambahPeserta', $data);
  }

  //fungsi edit Peserta
  //load view edit peserta
  public function edit()
  {
    if($this->input->get('id', true) <> null){
      $this->load->view('editPeserta');
    }else{
      redirect();
    }
  }

  //fungsi mengambil pesefik data peserta dan menampilkan dengan tipe json
  public function ambildata()
  {
    $id = $this->input->get('id', true);
    $lists = $this->peserta->getData(array(
      'column' => 'id',
      'value' => $id
    ))->row();
    $this->output ->set_content_type('application/json')->set_output(json_encode($lists));
  }

//fungsi menghapus data dan menampilkan hasil dari hapus data secara json
  public function hapusdata()
  {
    $id = $this->input->get('id', true);
    if($this->peserta->delData($id)){
      $result = array(
        'status' => 'success'
      );
    }else{
      $result = array(
        'status' => 'failed'
      );
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($result));
  }

  //fungsi menampilkan nilai badge pada dahsboard dalam json
  public function badge()
  {
    $total = $this->peserta->getDatas()->num_rows();
    $program = $this->peserta->getData(array('column' => 'skema', 'value' => 'Programmer Madya'))->num_rows();
    $network = $this->peserta->getData(array('column' => 'skema', 'value' => 'Networking'))->num_rows();
    $multimedia = $this->peserta->getData(array('column' => 'skema', 'value' => 'Multimedia'))->num_rows();
    $data = array(
      'total' => $total,
      'program' => $program,
      'network' => $network,
      'multimedia' => $multimedia
    );
    $this->output ->set_content_type('application/json')->set_output(json_encode($data));
  }

  //funsgi untuk mengecek ketersediaan nama sewaktu memasukkan nama
  public function checknama()
  {
    $data = array(
      'column' => 'namapeserta',
      'value' => $this->input->get('namapeserta', true)
    );
    $result = $this->peserta->getData($data)->num_rows();
    if($result > 0 ){
      $output = false;
    }else{
      $output = true;
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi untuk mengecek ketersediaan nik sewaktu memasukkan nik
  public function checknik()
  {
    $data = array(
      'column' => 'nik',
      'value' => $this->input->get('nik', true)
    );
    $result = $this->peserta->getData($data)->num_rows();
    if($result > 0 ){
      $output = false;
    }else{
      $output = true;
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi untuk mengecek ketersediaan nomor telepon
  public function checknomortelp()
  {
    $data = array(
      'column' => 'notelphp',
      'value' => $this->input->get('notelphp', true)
    );
    $result = $this->peserta->getData($data)->num_rows();
    if($result > 0 ){
      $output = false;
    }else{
      $output = true;
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi memproses request tambah peserta dan menampilkan hasil request
  public function tambahsubmit()
  {
    $data = array(
      'namapeserta' => $this->input->post('namapeserta', true),
      'nik' => $this->input->post('nik', true),
      'notelphp' => $this->input->post('notelphp', true),
      'email' => $this->input->post('email', true),
      'skema' => $this->input->post('skema', true),
      'tempatuji' => $this->input->post('tempatuji', true),
      'rekomendasi' => $this->input->post('rekomendasi', true),
      'tanggalterbit' => $this->input->post('tanggalterbit', true),
      'tanggallahir' => $this->input->post('tanggallahir', true),
      'organisasi' => $this->input->post('organisasi', true),
    );
    if($this->peserta->insData($data)){
      $output = array(
        'status' => 'success'
      );
    }else{
      $output = array(
        'status' => 'failed',
        'message' => 'Gagal memasukkan data silahkan coba lagi'
      );
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi memproses request edit peserta dan menampilkan hasil request
  public function editsubmit()
  {
    $data = array(
      'namapeserta' => $this->input->post('namapeserta', true),
      'nik' => $this->input->post('nik', true),
      'notelphp' => $this->input->post('notelphp', true),
      'email' => $this->input->post('email', true),
      'skema' => $this->input->post('skema', true),
      'tempatuji' => $this->input->post('tempatuji', true),
      'rekomendasi' => $this->input->post('rekomendasi', true),
      'tanggalterbit' => $this->input->post('tanggalterbit', true),
      'tanggallahir' => $this->input->post('tanggallahir', true),
      'organisasi' => $this->input->post('organisasi', true),
    );
    if($this->peserta->updateData($this->input->post('idx', true), $data)){
      $output = array(
        'status' => 'success'
      );
    }else{
      $output = array(
        'status' => 'failed',
        'message' => 'Gagal memasukkan data silahkan coba lagi'
      );
    }
    $this->output ->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi untuk mengirim data ke datatables untuk tabel peserta
  public function tabelpeserta()
  {
    $cek = $this->input->get('tipe', true);
    if($cek == 'umum'){
      $lists = $this->peserta->getDatas()->result();
      $data = array();
      $c = 1;
      foreach ($lists as $list) {
        $row = array();
        $row[] = $c;
        $row[] = $list->namapeserta;
        $row[] = $list->nik;
        $row[] = $list->tempatuji;
        $row[] = $list->tanggallahir;
        $row[] = $list->organisasi;
        $row[] = '<button data-value="'.$list->id.'" class="btn btn-success btn-sm">View</button>
                  <a href="'.base_url('peserta/edit').'?id='.$list->id.'" class="btn btn-warning btn-sm">Edit</a>
                  <button data-value="'.$list->id.'" class="btn btn-danger btn-sm">Delete</button>';
        $data[] = $row;
        $c++;
      }
      $output = array(
        'data' => $data
      );
    }elseif($cek == 'grouptanggallahir'){
      $lists = $this->peserta->getGroupTanggal()->result();
      $data = array();
      $c = 1;
      foreach ($lists as $list) {
        $row = array();
        $row[] = $c;
        $row[] = $list->tanggallahir;
        $row[] = $list->total;
        $data[] = $row;
        $c++;
      }
      $output = array(
        'data' => $data
      );
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($output));
  }
}
