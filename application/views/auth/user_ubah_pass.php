<?php $this->load->view('header'); ?>
<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title_edit ?></li>
  </ol>
  <div class="row">
    <div class="col-md-12">
      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_edit) ?></label></div>
        <div class="panel-body">
          <?php echo validation_errors() ?>
          <?php echo form_open('auth/user_ubah_pass_proses') ?>
            <?php echo form_input($id_user,$user->id_user);?>
            <div class="form-group"><label>Nama User</label>
              <?php echo form_input($nama_user, $user->nama_user);?>
            </div>

            <div class="form-group"><label>Password Baru</label>
              <?php echo form_password($password);?>
            </div>

            <hr>

            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>

          <?php echo form_close() ?>
        </div>
      </div>
    </div>
