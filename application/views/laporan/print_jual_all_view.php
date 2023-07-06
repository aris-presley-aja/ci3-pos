<?php
header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=".strtoupper($title).".xls");
header("Cache-Control: max-age=0");
?>

<center><h3><?php echo $nama_perusahaan->isi ?></h3></center>
<center><?php echo $alamat_perusahaan->isi ?></center>

<hr>

<center><?php echo strtoupper($title) ?></center>

<br>

<table border="1">
  <thead>
    <tr>
      <td style="text-align: center; background: #ddd; width: 100px"><b>No.Urut</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>No.Trans</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Pembeli</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>KD Barang</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Nama Barang</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Harga Jual</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Qty</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Total</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Ket</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Uploader</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Tanggal</b></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($get_all as $jual )
    {
    ?>
    <tr>
      <td style="text-align: center;vertical-align: top"><?php echo $no ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->no_trans; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->pembeli; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->kd_barang; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->nama_barang; ?></td>
      <td style="text-align: right;vertical-align: top"><?php echo $jual->harga_jual; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->qty; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->total; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->ket; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $jual->uploader; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo tgl_indo($jual->time_upload); ?></td>
    </tr>
  <?php
  $no++;
  }
  ?>
  </tbody>
</table>

<p><hr></p>

Total Penjualan adalah sebesar <b>Rp <?php echo number_format($total_jual) ?></b>

<hr>
