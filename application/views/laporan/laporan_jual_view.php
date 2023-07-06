<?php $this->load->view('header'); ?>
<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title ?></li>
  </ol>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title) ?></label></div>
        <div class="panel-body">
          <h4><b>Keseluruhan</b></h4>
          <hr>
          <?php echo form_open('laporan/print_jual_all') ?>
            <button type="submit" name="submit" class="btn btn-success">Download</button>
          <?php echo form_close() ?>
          <hr>
          <h4><b>Per Periode</b></h4>
          <hr>
          <?php echo form_open('laporan/print_jual_periode') ?>
            <div class="box-body">
              <div class="panel-body">
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <input type="text" name="tgl_awal" id="tgl_awal" placeholder="Isi tanggal mulai" class="form-control" >
                <br><input type="text" name="tgl_akhir" id="tgl_akhir" placeholder="Isi tanggal akhir" class="form-control" >
              </div>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-success">Download</button>
            <button type="reset" name="reset" class="btn btn-primary">Reset</button>
          <?php echo form_close() ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>

  <link href="<?php echo base_url()?>assets/plugins/datepicker/css/datepicker.css" rel="stylesheet">
  <script src="<?php echo base_url()?>assets/plugins/datepicker/js/jquery.js"></script>
  <script src="<?php echo base_url()?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
  $(function()
  {
    $('#tgl_awal').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy/mm/dd'}),
    $('#tgl_akhir').datepicker({autoclose: true,todayHighlight: true,format: 'yyyy/mm/dd'})
  });
  </script>

  </body>
</html>
