<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{
  var $table  = 'pengaturan';
  // Field tabel yang jadi Primary Key (PK)
  var $id     = 'slug';

  //////////////////////////////////////// LIST ////////////////////////////////////////
  public function get_all()
  {
    return $this->db->get($this->table)->result();
  }

  public function get_nama_perusahaan()
  {
    $this->db->where('slug','nama_perusahaan');
    return $this->db->get($this->table)->row();
  }

  public function get_alamat_perusahaan()
  {
    $this->db->where('slug','alamat');
    return $this->db->get($this->table)->row();
  }

  //////////////////////////////////////// UPDATE ////////////////////////////////////////
  public function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

  public function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

}
