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
                <th style="text-align: center">Kode</th>
                <th style="text-align: center">Nama Barang</th>
                <th style="text-align: center">Supplier</th>
                <th style="text-align: center">Harga Beli</th>
                <th style="text-align: center">Harga Jual</th>
                <th style="text-align: center">Qty</th>
                <th style="text-align: center">Ket</th>
                <th style="text-align: center">Total</th>
                <th style="text-align: center">Upload</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach($data_beli as $beli)
            {
            ?>
              <tr>
                <td valign='top' align='center'><?php echo $no++ ?></td>
                <td valign='top' ><?php echo $beli['no_trans'] ?></td>
                <td valign='top' ><?php echo $beli['kd_barang'] ?></td>
                <td style='text-align: left'><?php echo $beli['nama_barang'] ?></td>
                <td style='text-align: center'><?php echo $beli['supplier'] ?></td>
                <td style='text-align: right'><?php echo number_format($beli['harga_beli']) ?></td>
                <td style='text-align: right'><?php echo number_format($beli['harga_jual']) ?></td>
                <td style='text-align: center'><?php echo $beli['qty'] ?></td>
                <td style='text-align: center'><?php echo $beli['ket'] ?></td>
                <td style='text-align: right'><?php echo number_format($beli['total']) ?></td>
                <td style='text-align: center'><?php //echo $beli->uploader.' | '.$beli->time_upload ?></td>
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
