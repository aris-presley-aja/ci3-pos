<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jual extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Jual_model');
    $this->load->model('Stok_model');

    $this->data = array(
      'module'        => 'Penjualan Barang',
      'title'         => 'Modul Penjualan Barang',
      'title_add'     => 'Tambah Penjualan Barang',
      'title_data'    => 'Data Penjualan Barang',
      'title_edit'    => 'Edit Penjualan Barang',
      'button_submit' => 'Submit',
      'button_update' => 'Update',
      'button_reset'  => 'Reset',
      'action'        => site_url('jual/create_action'),
    );

    // cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman dashboard
		if(!$this->session->has_userdata('username')){redirect(base_url());}
  }

  public function index()
  {
    $this->data['data_jual'] = $this->Jual_model->get_all();

    $this->load->view('jual/jual_list',$this->data);
  }

  public function create()
  {
    $this->data['get_combo_barang'] = $this->Stok_model->get_combo_barang();

    $this->load->view('jual/jual_add', $this->data);

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
        $query = $this->db->get('pos_jual');
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
        $kode   = "J-".$kode1."-".$kode2;

        // menghitung total data yang dientry berdasarkan kd_barang
        $count = count($this->input->post('kd_barang'));

        // looping data yang diinput dan disimpan dalam variabel $data[$i]
        for($i=0;$i<$count;$i++)
        {
          $data[$i] = array(
            'no_trans'    => $kode,
            'kd_barang'   => $this->input->post('kd_barang['.$i.']'),
            'nama_barang' => $this->input->post('nama_barang['.$i.']'),
            'pembeli'     => $this->input->post('pembeli'),
            'qty'         => $this->input->post('qty['.$i.']'),
            'ket'         => $this->input->post('ket['.$i.']'),
            'harga_jual'  => $this->input->post('harga_jual['.$i.']'),
            'total'       => $this->input->post('total['.$i.']'),
            'uploader'    => $this->session->userdata('username'),
            'time_upload' => date('Y-m-d')
          );
        }

        // eksekusi query INSERT dan UPDATE + looping
        foreach($data as $data_r)
        {
          $this->Jual_model->insert($data_r);
        }

        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
        redirect(site_url('Jual'));

      }
  }

  public function print_data($id)
  {
    $this->load->model('Pengaturan_model');

    $this->load->helper('tgl_indo');
    $row = $this->Jual_model->get_by_notrans($id);

    if ($row)
    {
      // buffering atau menyiapkan data sebelum ditampilkan secara keseluruhan di browser
      ob_start();

      $data['nama_perusahaan'] = $this->Pengaturan_model->get_nama_perusahaan();
      $data['alamat_perusahaan'] = $this->Pengaturan_model->get_alamat_perusahaan();

      $data['jual'] = $this->Jual_model->get_by_notrans($id);
      $data['jual_row'] = $this->Jual_model->get_by_notrans_result($id);
      $data['grand_total'] = $this->Jual_model->get_by_notrans_gtotal($id);

      $this->load->view('jual/print', $data);

      $html = ob_get_contents();
      $html = '<page style="font-family: freeserif">'.nl2br($html).'</page>';
      ob_end_clean();

      require_once('application/libraries/html2pdf/html2pdf.class.php');
      $pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 0, 10, 0));
      $pdf->setDefaultFont('Arial');
      $pdf->pdf->SetDisplayMode('fullpage');
      $pdf->setTestTdInOnePage(false);
      $pdf->WriteHTML($html);
      $pdf->Output('print_jual.pdf');
    }
      else
      {
        $this->session->set_flashdata('message', "<script>alert('Data tidak ditemukan');</script>");
        redirect(site_url('jual'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('pembeli', 'Nama Pembeli', 'trim|required');

    $this->form_validation->set_rules('nama_barang[]', 'Nama Barang', 'trim|required');
    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_Jual', 'id_Jual', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}
