<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->load->model('Jual_model');
		$this->load->model('Beli_model');
		$this->load->model('Stok_model');


		// cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman login
		if(!$this->session->has_userdata('username')){redirect(base_url());}

		$this->data['title']			= 'Dashboard';
		$this->data['total_barang']		= $this->Stok_model->get_total_barang();
		$this->data['jual_harian'] 		= $this->Jual_model->get_data_total_jual_harian();
		$this->data['beli_harian'] 		= $this->Beli_model->get_data_total_beli_harian();

		$this->load->view('dashboard',$this->data);
	}

}
