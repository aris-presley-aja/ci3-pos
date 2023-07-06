<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jual_model extends CI_Model
{
  // set nama tabel
  var $table  = 'jual';
  // Field tabel yang jadi Primary Key (PK)
  var $id     = 'id_jual';

  // menampilkan semua data dari tabel
  public function get_all()
  {
    $this->db->group_by('no_trans');
    return $this->db->get($this->table)->result();
  }

  // menampilkan data total dari total
  public function get_data_total_jual()
	{
		$this->db->select_sum('total');
		$query = $this->db->get($this->table);
    return $query->row()->total;
  }

  public function get_data_total_jual_harian()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d');
		$this->db->select_sum('total');
		$this->db->where('DATE(time_upload)',$curr_date);//use date function
		$query = $this->db->get($this->table);
    return $query->row()->total;
  }

  // memasukkan data ke tabel
  public function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  // mengambil data berdasarkan no_trans per baris/ tidak melakukan looping
  public function get_by_notrans($id)
  {
    $this->db->where('no_trans', $id);
    return $this->db->get($this->table)->row();
  }

  // mengambil data berdasarkan no_trans dam siap untuk melakukan looping dari barang yang dibeli
  public function get_by_notrans_result($id)
  {
    $this->db->where('no_trans', $id);
    return $this->db->get($this->table)->result();
  }

  // menampilkan grand_total dari no_trans
  public function get_by_notrans_gtotal($id)
  {
    $this->db->select_sum('total');
    $this->db->where('no_trans', $id);
    return $this->db->get($this->table)->row();
  }

}
