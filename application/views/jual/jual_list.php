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
      <?php echo $this->session->userdata('message') ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_data) ?></label></div>
        <div class="panel-body">
          <p>
            <a href="<?php echo $action ?>">
              <button type='submit' class='btn btn-default'>
                <i class="fa fa-plus"></i> <?php echo $title_add ?>
              </button>
            </a>
          </p>
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Faktur</th>
                <th style="text-align: center">Pembeli</th>
                <th style="text-align: center">Upload</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach($data_jual as $penjualan)
            {
            ?>
              <tr>
                <td valign='top' align='center'><?php echo $no++ ?></td>
                <td style='text-align: center'><?php echo $penjualan->no_trans ?></td>
                <td style='text-align: center'><?php echo $penjualan->pembeli ?></td>
                <td style='text-align: center'><?php echo $penjualan->uploader.' | '.$penjualan->time_upload ?></td>
                <td style='text-align: center'>
                  <a href='<?php echo base_url('jual/print_data/').$penjualan->no_trans ?>'>
                    <button type='submit' class='btn btn-warning' name="print">PRINT</button>
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
