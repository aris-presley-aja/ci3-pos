<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">POS</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url() ?>stok"><i class="fa fa-archive"></i> Stok Barang</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-arrow-circle-down"></i> Pembelian <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>beli/create">Tambah Data</a></li>
            <li><a href="<?php echo base_url() ?>beli">Data Pembelian</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-arrow-circle-up"></i> Penjualan <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>jual/create">Tambah Data</a></li>
            <li><a href="<?php echo base_url() ?>jual">Data Penjualan</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-file"></i> Laporan <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>laporan/beli">Laporan Pembelian</a></li>
            <li><a href="<?php echo base_url() ?>laporan/jual">Laporan Penjualan</a></li>
            <!-- <li><a href="<?php echo base_url() ?>laporan/stok">Laporan Stok Barang</a></li> -->
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gear"></i> Pengaturan <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url() ?>pengaturan/update/nama_perusahaan">Nama Toko</a></li>
            <li><a href="<?php echo base_url() ?>pengaturan/update/alamat">Alamat Toko</a></li>
          </ul>
        </li>
        <?php if($_SESSION['usertype'] == '1'){ ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i> User <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url() ?>auth/user_tambah">Tambah User</a></li>
              <li><a href="<?php echo base_url() ?>auth/user">Data User</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <?php
        if(isset($_SESSION['username']))
        {
          echo '
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Halo, '.$_SESSION['username'].' <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <div class="form-group">
                <div class="col-lg-12"><a href="'.base_url('auth/logout').'"><button class="btn btn-primary" type="submit"><i class="fa fa-sign-out"></i> Logout</button></a></div>
              </div>
            </li>
          </ul>';  } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
