<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {

  //Construct class
  function __construct() {
    parent::__construct();
  }

  // public function untuk memasukkan data dalam tabel peserta
  public function insData($data)
  {
    return $this->db->insert('peserta', $data);
  }

  //public function untuk mengambil semua data dari tabel peserta
  public function getDatas()
  {
    $this->db->from('peserta');
    return $this->db->get();
  }

  //public function untuk mengambil spesifik data dari tabel peserta
  public function getData($search)
  {
    $this->db->from('peserta');
    $this->db->where($search['column'], $search['value']);
    return $this->db->get();
  }

  public function delData($id)
  {
    return $this->db->delete('peserta', array('id' => $id));
  }

  public function updateData($id, $data){
   $this->db->where('id', $id);
   return $this->db->update('peserta', $data);
  }

  public function getGroupTanggal()
  {
    $this->db->select('COUNT(id) as total, tanggallahir');
    $this->db->from('peserta');
    $this->db->group_by('tanggallahir');
    $this->db->order_by('tanggallahir', 'desc');
    return $this->db->get();
  }


}
?>
