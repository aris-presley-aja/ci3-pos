<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('Auth_model');

		$this->data 	= array(
	      'module'        => 'User',
	      'title'         => 'Modul User',
	      'title_add'     => 'Tambah User',
	      'title_data'    => 'Data User',
	      'title_edit'    => 'Edit User'
    );
	}

	public function index()
	{
		// cek session sudah ada/ belum atau user sudah login/ belum, jika sudah maka akan diarahkan ke halaman dashboard
		if($this->session->has_userdata('username')){redirect(base_url('dashboard'));}

		// siapkan form dalam bentuk array yang akan dilempar ke view
		$this->data['username'] = array(
      'name'  => 'username',
      'class' => 'form-control',
			'placeholder' => 'Isikan username anda',
    );
		
    $this->data['password'] = array(
      'name'  => 'password',
      'class' => 'form-control',
			'placeholder' => 'Isikan password anda',
    );

		// load view
		$this->load->view('auth/login', $this->data);
	}

	// Proses login
	public function login()
	{
		// set rules/ aturan form validasi
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

		// set default prefix (awalan) dan suffix (akhiran) pesan error
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// cek validasi input
		if ($this->form_validation->run() == FALSE)
		{
			// jika validasi gagal/ ada yang salah maka akan diarahkan ke function/ halaman index
			$this->index();
		}
			else
			{
				// siapkan variabel form input
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				// cek ke tabel berdasarkan username dan password yang diinput
				$query = $this->db->select("nama_user, username, usertype, password")->from("pos_user")->where("username", $username)->get();

				// menyimpan data/ hasil dalam bentuk row/ baris
				$row = $query->row();

				// jika username tidak ditemukan maka akan diarahkan ke halaman login kembali
				if($row->username == NULL)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Username tidak ditemukan</div>');
					redirect(base_url());
				}
				else
				{
					// cek password antara yang diinput dengan di tabel berdasarkan username menggunakan password_verify
					if(password_verify($password, $row->password))
			    {
						// jika benar siapkan session yang dibutuhkan
						$session = array(
							'username'  => $username,
							'usertype'  => $row->usertype,
							'nama_user' => $row->nama_user,
						);
						$this->session->set_userdata($session);

						// diarahkan ke halaman dashboard
						redirect(base_url('dashboard'));
					}
					else
					{
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Password salah</div>');
						redirect(base_url());
					}
				}
			}
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function user()
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		// ambil semua data user
		$this->data['get_all'] = $this->Auth_model->get_all();

		// load view
		$this->load->view('auth/user_list', $this->data);
	}

	public function user_tambah()
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		$this->data['nama_user'] = array(
      'name'  => 'nama_user',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
      'value' => $this->form_validation->set_value('nama_user'),
    );

		$this->data['username'] = array(
      'name'  => 'username',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
      'value' => $this->form_validation->set_value('username'),
    );

    $this->data['password'] = array(
      'name'  => 'password',
      'class' => 'form-control',
			'placeholder' => 'Isikan password anda',
      'value' => $this->form_validation->set_value('password'),
    );

		$this->data['email'] = array(
      'name'  => 'email',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
      'value' => $this->form_validation->set_value('email'),
    );

		$this->data['option'] = array(
			'1'  => 'Superadmin',
			'2'    => 'Admin',
    );

    $this->data['usertype'] = array(
      'name'  => 'usertype',
      'id'    => 'usertype',
      'class' => 'form-control',
    );

		$this->load->view('auth/user_tambah', $this->data);
	}

	public function user_tambah_proses()
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		// set rules/ aturan form validasi
		$this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_message('valid_email', 'Format {field} tidak benar');

		// set default prefix (awalan) dan suffix (akhiran) pesan error
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// cek validasi input
		if ($this->form_validation->run() == FALSE)
		{
			// jika validasi gagal/ ada yang salah maka akan diarahkan ke function/ halaman index
			$this->user_tambah();
		}
			else
			{
				$data = array(
					'nama_user'   => $this->input->post('nama_user'),
					'username'    => $this->input->post('username'),
					'password'    => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'email'    		=> $this->input->post('email'),
					'usertype'    => $this->input->post('usertype'),
					'time_upload' => date('Y-m-d')
				);

				// eksekusi query INSERT
				$this->Auth_model->insert($data);
				// set pesan data berhasil dibuat
				$this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dibuat</div>');
				redirect(site_url('auth/user'));
			}
	}

	public function user_edit($id)
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		$row = $this->Auth_model->get_by_id($id);
    $this->data['user'] = $this->Auth_model->get_by_id($id);

		$this->data['id_user'] = array(
      'name'  => 'id_user',
      'class' => 'form-control',
			'type' => 'hidden',
    );

		$this->data['nama_user'] = array(
      'name'  => 'nama_user',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
    );

		$this->data['username'] = array(
      'name'  => 'username',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
    );

    $this->data['password'] = array(
      'name'  => 'password',
      'class' => 'form-control',
			'placeholder' => 'Isikan password anda',
    );

		$this->data['email'] = array(
      'name'  => 'email',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
    );

		$this->data['option'] = array(
			'1'  => 'Superadmin',
			'2'    => 'Admin',
    );

    $this->data['usertype'] = array(
      'name'  => 'usertype',
      'id'    => 'usertype',
      'class' => 'form-control',
    );

		$this->load->view('auth/user_edit', $this->data);
	}

	public function user_edit_proses()
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		// set rules/ aturan form validasi
		$this->form_validation->set_rules('nama_user', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
		$this->form_validation->set_message('valid_email', 'Format {field} tidak benar');

		// set default prefix (awalan) dan suffix (akhiran) pesan error
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// cek validasi input
		if ($this->form_validation->run() == FALSE)
		{
			// jika validasi gagal/ ada yang salah maka akan diarahkan ke function/ halaman index
			$this->user_edit($this->input->post('id_user'));
		}
			else
			{
				$data = array(
					'nama_user'   => $this->input->post('nama_user'),
					'username'    => $this->input->post('username'),
					'email'    		=> $this->input->post('email'),
					'usertype'    => $this->input->post('usertype'),
				);

				// eksekusi query INSERT
				$this->Auth_model->update($this->input->post('id_user'), $data);
				// set pesan data berhasil dibuat
				$this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil diperbarui</div>');
				redirect(site_url('auth/user'));
			}
	}

	public function user_hapus($id)
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		// ambil value id yang akan dihapus
		$row = $this->Auth_model->get_by_id($id);

		// jika ada maka hapus data
		if($row)
    {
			// perintah untuk hapus data
			$this->Auth_model->delete($id);

			// set pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil dihapus</div>');
			redirect(site_url('auth/user'));
		}
			else
			{
				// set pesan
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert">Data tidak ditemukan</div>');
				redirect(site_url('auth/user'));
			}
	}

	public function user_ubah_pass($id)
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		$row = $this->Auth_model->get_by_id($id);
    $this->data['user'] = $this->Auth_model->get_by_id($id);

		$this->data['id_user'] = array(
      'name'  => 'id_user',
      'class' => 'form-control',
			'type' => 'hidden',
    );

		$this->data['nama_user'] = array(
      'name'  => 'nama_user',
      'class' => 'form-control',
			'placeholder' => 'Isikan nama anda',
			'readonly' => ''
    );

		$this->data['password'] = array(
      'name'  => 'password',
      'class' => 'form-control',
			'placeholder' => 'Isikan password baru',
    );

		$this->load->view('auth/user_ubah_pass', $this->data);
	}

	public function user_ubah_pass_proses()
	{
		// ambil value usertype dari session login
		$usertype    	= $_SESSION['usertype'];
		// cek sudah login/ belum
		if(!$this->session->has_userdata('username')){redirect(base_url());}
		// cek usertype sebagai superadmin atau bukan, jika bukan diarahkan ke halaman dashboard
		if($usertype != '1'){redirect(base_url());}

		// set rules/ aturan form validasi
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

		// set default prefix (awalan) dan suffix (akhiran) pesan error
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// cek validasi input
		if ($this->form_validation->run() == FALSE)
		{
			// jika validasi gagal/ ada yang salah maka akan diarahkan ke function/ halaman index
			$this->user_ubah_pass($this->input->post('id_user'));
		}
			else
			{
				$data = array(
					'password'    => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				);

				// eksekusi query INSERT
				$this->Auth_model->update($this->input->post('id_user'), $data);
				// set pesan data berhasil dibuat
				$this->session->set_flashdata('message', '<div class="alert alert-success alert">Data berhasil diperbarui</div>');
				redirect(site_url('auth/user'));
			}
	}

}
