<?php $this->load->view('header'); ?>
<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title_data ?></li>
  </ol>
  <div class="row">
    <div class="col-lg-12">
      <?php echo $this->session->userdata('message') ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_data) ?></label></div>
        <div class="panel-body">
          <p>
            <a href="<?php echo base_url('auth/user_tambah') ?>">
              <button type='submit' class='btn btn-default'>
                <i class="fa fa-plus"></i> <?php echo $title_add ?>
              </button>
            </a>
          </p><hr>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Nama</th>
                <th style="text-align: center">Username</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Usertype</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $start = 0; foreach ($get_all as $user):?>
              <tr>
                <td style="text-align:center"><?php echo ++$start ?></td>
                <td style="text-align:center"><?php echo $user->nama_user ?></td>
                <td style="text-align:center"><?php echo $user->username ?></td>
                <td style="text-align:center"><?php echo $user->email ?></td>
                <td style="text-align:center"><?php if($user->usertype == '1'){echo "Superadmin";}else{echo "Admin";}  ?></td>
                <td style="text-align:center">
                <?php
                echo anchor(site_url('auth/user_ubah_pass/'.$user->id_user),'<i class="glyphicon glyphicon-lock"></i>','title="Ubah Password", class="btn btn-sm btn-primary"'); echo ' ';
                echo anchor(site_url('auth/user_edit/'.$user->id_user),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                echo anchor(site_url('auth/user_hapus/'.$user->id_user),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Data Tables -->
    <link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- Skrip Datatables -->
    <script type="text/javascript">$(function () {$('#datatable').dataTable({});});</script>
