<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stok_model extends CI_Model
{
  var $table  = 'stok';
  // Field tabel yang jadi Primary Key (PK)
  var $id     = 'id_stok';

  //////////////////////////////////////// LIST ////////////////////////////////////////
  public function get_all()
  {
    $this->db->select('beli.nama_barang,beli.harga_beli, beli.harga_jual,beli.uploader,beli.time_upload, stok.kd_barang, stok.qty');
    $this->db->join('beli','stok.kd_barang = beli.kd_barang');
    $this->db->group_by('stok.kd_barang');
    return $this->db->get($this->table)->result();
  }

  public function get_combo_barang()
  {
    $this->db->select('beli.nama_barang,beli.harga_beli, beli.harga_jual,beli.uploader,beli.time_upload, stok.kd_barang, stok.qty');
    $this->db->join('beli','stok.kd_barang = beli.kd_barang');
    $this->db->group_by('stok.kd_barang');
    $this->db->order_by('beli.nama_barang', 'ASC');
    return $this->db->get($this->table)->result();
  } 

  function get_total_barang()
  {
    $this->db->select_sum('qty');
    $query = $this->db->get($this->table);
    return $query->row()->qty;
  }
}
