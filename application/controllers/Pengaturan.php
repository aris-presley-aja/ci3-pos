<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengaturan_model');

    $this->data = array(
      'module'        => 'Pengaturan',
      'title'         => 'Modul Pengaturan',
      'title_edit'    => 'Edit Pengaturan',
      'button_update' => 'Update',
      'button_reset'  => 'Reset',
      'action'        => site_url('pengaturan/update'),
      'action_edit'    => site_url('pengaturan/update_action'),
    );

    // cek session sudah ada/ belum atau user sudah login/ belum, jika belum maka akan diarahkan ke halaman dashboard
		if(!$this->session->has_userdata('username')){redirect(base_url());}
  }

  public function index()
  {
    $this->data['data_pengaturan'] = $this->Pengaturan_model->get_all();

    $this->load->view('pengaturan/pengaturan_list',$this->data);
  }

  public function update($slug)
  {
    $row = $this->Pengaturan_model->get_by_id($slug);
    $this->data['pengaturan'] = $this->Pengaturan_model->get_by_id($slug);

    if ($row)
    {
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['slug'] = array(
        'name'  => 'slug',
        'type'  => 'hidden',
      );

      $this->data['nama'] = array(
        'name'  => 'nama',
        'class' => 'form-control',
        'readonly' => '',
      );

      $this->data['isi'] = array(
        'name'  => 'isi',
        'class' => 'form-control',
      );

      $this->load->view('pengaturan/pengaturan_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('pengaturan'));
      }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('slug'));
    }
      else
      {
        $slug['slug'] = $this->input->post('slug');

        /* Jika file upload diisi */
        $data = array(
          'slug'      => $this->input->post('slug'),
          'isi'     => $this->input->post('isi'),
        );

        $this->Pengaturan_model->update($this->input->post('slug'), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil diperbarui</div>');
        redirect(site_url('pengaturan'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('isi', 'Isi Pengaturan', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}
