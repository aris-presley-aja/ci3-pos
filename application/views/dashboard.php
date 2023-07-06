<?php $this->load->view('header'); ?>
<?php $this->load->view('navbar'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-success alert"><b>SELAMAT DATANG DI APLIKASI PENJUALAN (POINT OF SALES / POS)</b></div>
      <!-- BOX TOTAL STOK BARANG-->
      <div class="col-lg-3">
        <div class="panel panel-primary">
          <div class="panel-heading"><label>TOTAL STOK BARANG</label></div>
          <div class="panel-body" align="center">
            <h1><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></h1>
            <h3><?php echo $total_barang; ?></h3>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <!-- BOX TOTAL PEMBELIAN HARI INI-->
      <div class="col-lg-3">
        <div class="panel panel-warning">
          <div class="panel-heading"><label>PEMBELIAN HARI INI</label></div>
          <div class="panel-body" align="center">
            <h1><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></h1>
            <h3>Rp <?php echo number_format($beli_harian) ?></h3>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>

      <div class="col-lg-3">
        <div class="panel panel-danger">
          <div class="panel-heading"><label>PENJUALAN HARI INI</label></div>
          <div class="panel-body" align="center">
            <h1><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></h1>
            <h3>Rp <?php echo number_format($jual_harian) ?></h3>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>

      <div class="col-lg-3">
        <div class="panel panel-info">
          <div class="panel-heading"><label>TOTAL USER</label></div>
          <div class="panel-body" align="center">
            <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h1>
            <h3>3</h3>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>

    </div>
  </div>
</div>
