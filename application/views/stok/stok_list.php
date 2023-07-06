<?php $this->load->view('header'); ?>
<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title_data ?></li>
  </ol>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_data) ?></label></div>
        <div class="panel-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Kode Barang</th>
                <th style="text-align: center">Nama Barang</th>
                <th style="text-align: center">Stok (pcs)</th>
                <th style="text-align: center">Upload</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach($data_stok as $stok)
            {
            ?>
              <tr>
                <td valign='top' align='center'><?php echo $no++ ?></td>
                <td style='text-align: left'><?php echo $stok->kd_barang ?></td>
                <td style='text-align: left'><?php echo $stok->nama_barang ?></td>
                <td style='text-align: center'><?php echo $stok->qty ?></td>
                <td style='text-align: center'><?php echo $stok->uploader.' | '.$stok->time_upload ?></td>
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
