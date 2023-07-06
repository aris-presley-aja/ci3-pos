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
      <td style="text-align: center; background: #ddd; width: 100px"><b>Supplier</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Nama Barang</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>KD Barang</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Harga Beli</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Harga Jual</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Qty</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Ket</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Total</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Uploader</b></td>
      <td style="text-align: center; background: #ddd; width: 100px"><b>Tanggal</b></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($get_all as $beli )
    {
    ?>
    <tr>
      <td style="text-align: center;vertical-align: top"><?php echo $no ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->no_trans; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->supplier; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->nama_barang; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->kd_barang; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->harga_beli; ?></td>
      <td style="text-align: right;vertical-align: top"><?php echo $beli->harga_jual; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->qty; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->ket; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->total; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo $beli->uploader; ?></td>
      <td style="text-align: center;vertical-align: top"><?php echo tgl_indo($beli->time_upload); ?></td>
    </tr>
  <?php
  $no++;
  }
  ?>
  </tbody>
</table>

<p><hr></p>

Total Pembelian adalah sebesar <b>Rp <?php echo number_format($total_beli) ?></b>

<hr>
