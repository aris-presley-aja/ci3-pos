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
      <?php echo $this->session->userdata('message') ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title) ?></label></div>
        <div class="panel-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Menu</th>
                <th style="text-align: center">Isi</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach($data_pengaturan as $pengaturan)
            {
            ?>
              <tr>
                <td valign='top' align='center'><?php echo $no++ ?></td>
                <td style='text-align: center'><?php echo $pengaturan->nama ?></td>
                <td style='text-align: center'><?php echo $pengaturan->isi ?></td>
                <td style='text-align: center'>
                  <a href='<?php echo base_url('pengaturan/update/').$pengaturan->slug ?>'>
                    <button type='submit' class='btn btn-warning' name="print">EDIT</button>
                  </a>
                </td>
              </tr>
            <?php } ?>
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
