<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>KWITANSI: <?php echo $jual->no_trans; ?></title>
</head>
<body>

<table>
  <tr>
    <td align="center" style="width: 700px;"><font style="font-size: 18px"><br><b><?php echo $nama_perusahaan->isi ?></b></font>
      <br><?php echo $alamat_perusahaan->isi ?>
    </td>
  </tr>
</table>
<hr/>
<h4 align="center">KWITANSI PEMBAYARAN<br/>No. <?php echo $jual->no_trans; ?></h4>
<table>
  <tr>
    <td style="width: 20%; text-align: left"><b>Sudah terima dari</b></td>
    <td>:</td>
    <td>Bpk/ Ibu <?php echo $jual->pembeli; ?></td>
  </tr>
  <tr>
    <td><b>Uang Sejumlah</b></td>
    <td>:</td>
    <td>Rp <?php echo number_format($grand_total->total); ?></td>
  </tr>
  <tr>
    <td><b>Untuk pembayaran</b></td>
    <td>:</td>
  </tr>
</table>

  <table>
    <thead>
      <tr>
        <td style="text-align: center; background: #ddd; width: 50px"><b>No.Urut</b></td>
        <td style="text-align: center; background: #ddd; width: 240px"><b>Nama Barang</b></td>
        <td style="text-align: center; background: #ddd; width: 100px"><b>Harga (pcs)</b></td>
        <td style="text-align: center; background: #ddd; width: 100px"><b>Qty</b></td>
        <td style="text-align: center; background: #ddd; width: 100px"><b>Total</b></td>
        <td style="text-align: center; background: #ddd; width: 100px"><b>Ket</b></td>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($jual_row as $data )
      {
      ?>
      <tr>
        <td style="text-align: center;vertical-align: top"><?php echo $no ?></td>
        <td style="text-align: center;vertical-align: top"><?php echo $data->nama_barang; ?></td>
        <td style="text-align: center;vertical-align: top"><?php echo number_format($data->harga_jual); ?></td>
        <td style="text-align: center;vertical-align: top"><?php echo $data->qty; ?></td>
        <td style="text-align: center;vertical-align: top"><?php echo number_format($data->total); ?></td>
        <td style="text-align: center;vertical-align: top"><?php echo $data->ket; ?></td>
      </tr>
    <?php
    $no++;
    }
    ?>
    </tbody>
  </table>

  <p>
    Grand Total: <b>Rp <?php echo number_format($grand_total->total); ?></b>
  </p>

<p align="right">Jakarta, <?php echo tgl_indo($jual->time_upload); ?>
<br/><br/>Hormat kami,</p>
<br/>
<p align="right"><?php echo $this->session->userdata('username'); ?><br/>
(<?php echo $this->session->userdata('nama_user'); ?>)</p>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
