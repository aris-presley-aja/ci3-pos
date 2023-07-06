<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beli_model extends CI_Model
{
  // set nama tabel
  var $table  = 'beli';

  var $id     = 'id_beli';

  // menampilkan semua data dari tabel
  public function get_all()
  {
    

    $this->db->group_by('no_trans');
    return $this->db->get($this->table)->result();
  }

  public function get_alll(){
    $query = $this->db->get($this->table);
    return $query->result_array();

  }

  // public function get_all()
  // {
  //   $this->db->group_by('no_trans');
  //   return $this->db->get($this->table)->result();
  // }

  // menampilkan semua data total pembelian dari total
  public function get_data_total_beli()
	{
		$this->db->select_sum('total');
		$query = $this->db->get($this->table);
    return $query->row()->total;
  }

  // menampilkan semua data total pembelian berdasarkan periode
  public function get_data_beli_periode()
	{
		$tgl_awal 	= $this->input->post('tgl_awal'); //getting from post value
    $tgl_akhir 	= $this->input->post('tgl_akhir'); //getting from post value

		$this->db->where('time_upload >=', $tgl_awal);
		$this->db->where('time_upload <=', $tgl_akhir);
		return $this->db->get($this->table)->result();
  }

  // menampilkan semua data total pembelian dari harga beli berdasarkan periode
  public function get_data_total_periode_beli()
	{
    $tgl_awal 	= $this->input->post('tgl_awal'); //getting from post value
    $tgl_akhir 	= $this->input->post('tgl_akhir'); //getting from post value

    $this->db->select_sum('total');
    $this->db->where('time_upload >=', $tgl_awal);
		$this->db->where('time_upload <=', $tgl_akhir);
		$query = $this->db->get($this->table);
    return $query->row()->total;
  }

  public function get_data_total_beli_harian()
	{
		$date = new DateTime("now");
		$curr_date = $date->format('Y-m-d ');
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

}
