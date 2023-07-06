<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	var $table  = 'user';
	var $id  = 'id_user';
	var $username  = 'username';

	public function get_all()
	{
		return $this->db->get($this->table)->result();
	}

	public function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

	public function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

	public function delete($id)
  {
    $this->db->where($this->id,$id);
    $this->db->delete($this->table);
  }

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

}
