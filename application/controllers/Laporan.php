<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
  {
		parent::__construct();

    // panggil semua model
		$this->load->model('Beli_model');
    $this->load->model('Jual_model');
		$this->load->model('Pengaturan_model');
		$this->load->model('Stok_model');

    // panggil helper tgl_indo
		$this->load->helper('tgl_indo');

    $this->data = array(
      'module'         => 'Modul Laporan',
    );

		// cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman dashboard
		if(!$this->session->has_userdata('username')){redirect(base_url());}
	}

  /* BELI */
	public function beli()
	{
    $this->data['title'] = "Laporan Pembelian Barang";
		$this->load->view('laporan/laporan_beli_view',$this->data);
  }

  public function print_beli_all()
  {
		$data['title'] 							= "Laporan Pembelian Barang Keseluruhan";
		$data['nama_perusahaan'] 		= $this->Pengaturan_model->get_nama_perusahaan();
		$data['alamat_perusahaan'] 	= $this->Pengaturan_model->get_alamat_perusahaan();

    $data['get_all']    = $this->Beli_model->get_all();
    $data['total_beli'] = $this->Beli_model->get_data_total_beli();

    $this->load->view('laporan/print_beli_all_view',$data);
  }

  public function print_beli_periode()
  {
		$data['title'] 							= "Laporan Pembelian Barang Periode";
		$data['nama_perusahaan'] 		= $this->Pengaturan_model->get_nama_perusahaan();
		$data['alamat_perusahaan'] 	= $this->Pengaturan_model->get_alamat_perusahaan();

    $data['get_periode']        = $this->Beli_model->get_data_beli_periode();
    $data['total_beli_periode'] = $this->Beli_model->get_data_total_periode_beli();

    $this->load->view('laporan/print_beli_periode_view',$data);
  }

	/* JUAL */
	public function jual()
	{
    $this->data['title'] = "Laporan Penjualan Barang";
		$this->load->view('laporan/laporan_jual_view',$this->data);
  }

  public function print_jual_all()
  {
		$data['title'] 							= "Laporan Penjualan Barang Keseluruhan";
		$data['nama_perusahaan'] 		= $this->Pengaturan_model->get_nama_perusahaan();
		$data['alamat_perusahaan'] 	= $this->Pengaturan_model->get_alamat_perusahaan();

    $data['get_all']    = $this->Jual_model->get_all();
    $data['total_jual'] = $this->Jual_model->get_data_total_jual();

    $this->load->view('laporan/print_jual_all_view',$data);
  }

  public function print_jual_periode()
  {
		// silahkan Anda coba latihan membuat print/ cetak data penjualan dalam periode tertentu seperti yang ada di pembelian
  }

	/* STOK */
	public function stok()
	{
  	// silahkan Anda coba latihan membuat print/ cetak data penjualan dalam periode tertentu seperti yang ada di pembelian
  }

  public function print_stok_all()
  {
    // silahkan Anda coba latihan membuat print/ cetak data penjualan dalam periode tertentu seperti yang ada di pembelian
  }

}
