<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Point of Sales (POS)</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url()?>assets/template/backend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/template/backend/css/login.css" rel="stylesheet" type="text/css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/fav.ico" />
  </head>
  <body>
    <div class="container">
      <div class="card card-container"><h3 align="center">POINT OF SALES</h3>
        <img id="profile-img" class="profile-img-card" src="<?php echo base_url('assets/images/cashier.png') ?>" />
        <?php echo $this->session->userdata('message') ?>
        <?php echo form_open('auth/login') ?>
          <div class="form-group has-feedback">
            <?php echo form_input($username) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_password($password) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        <?php echo form_close();?>
      </div><!-- /card-container -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/template/backend/css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
