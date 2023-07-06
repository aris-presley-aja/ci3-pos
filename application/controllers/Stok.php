<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stok extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Stok_model');

    $this->data = array(
      'module'        => 'Stok Barang',
      'title'         => 'Modul Stok Barang',
      'title_data'    => 'Data Stok Barang',
    );

    // cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman dashboard
		if(!$this->session->has_userdata('username')){redirect(base_url());}
  }

  public function index()
  {
    $this->data['data_stok'] = $this->Stok_model->get_all();

    $this->load->view('stok/stok_list',$this->data);
  }


}
