<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Beli extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Beli_model');

    $this->data = array(
      'module'        => 'Pembelian Barang',
      'title'         => 'Modul Pembelian Barang',
      'title_add'     => 'Tambah Pembelian Barang',
      'title_data'    => 'Data Pembelian Barang',
      'title_edit'    => 'Edit Pembelian Barang',
      'button_submit' => 'Submit',
      'button_update' => 'Update',
      'button_reset'  => 'Reset',
      'action'        => site_url('beli/create'),
      'action_add'    => site_url('beli/create_action'),
    );

    // cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman dashboard
		if(!$this->session->has_userdata('username')){redirect(base_url());}
  }

  public function index()
  {
    $this->data['data_beli'] = $this->Beli_model->get_alll();

    $this->load->view('beli/beli_list',$this->data);
  }

  public function create()
  {
    $this->load->view('beli/beli_add', $this->data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->create();
    }
      else
      {
        // mengambil 1 data terakhir dari tabel untuk pengecekan no_trans
        $this->db->select("no_trans");
        $this->db->where('time_upload',date('Y-m-d'));
        $this->db->order_by('no_trans','DESC');
        $this->db->limit(1);
        $query = $this->db->get('pos_beli');
        $hasil_cek = $query->row();

        // jika data tidak sama NULL atau tidak kosong atau datanya sudah ada di tabel maka buat no_trans yang selanjutnya
        if($hasil_cek != NULL)
        {
          // mengganti string dengan fungsi substr dari hasil_cek data terakhir
          $kode_akhir = substr($hasil_cek->no_trans,10,6);

          // membuat no_trans
          $kode2      = str_pad($kode_akhir+1, 4, '0', STR_PAD_LEFT);
        }
          // jika datanya masih kosong maka buat no_trans baru
          else
          {
            $kode2      = "0001";
          }

        // pembuatan tanggal
        $kode1  = date('ymd');
        /*$kode   = "J-".$kode1."-".$kode2;*/
        $kode   = "B-".$kode1."-".$kode2;

        $data = array(
          'no_trans'    => $kode,
          'supplier'    => $this->input->post('supplier'),
          'nama_barang' => $this->input->post('nama_barang'),
          'kd_barang'   => $this->input->post('kd_barang'),
          'harga_beli'  => $this->input->post('harga_beli'),
          'harga_jual'  => $this->input->post('harga_jual'),
          'qty'         => $this->input->post('qty'),
          'ket'         => $this->input->post('ket'),
          'total'       => $this->input->post('total'),
          'uploader'    => $this->session->userdata('username'),
          'time_upload' => date('Y-m-d')
        );

        // eksekusi query INSERT
        $this->Beli_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
        redirect(site_url('beli'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('supplier', 'Nama Supplier', 'trim|required');

    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_beli', 'id_beli', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}
