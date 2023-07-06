<?php $this->load->view('header'); ?>

<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title_add ?></li>
  </ol>
  <div class="row">
    <div class="col-md-12">
      <?php echo validation_errors() ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_add) ?></label></div>
        <div class="panel-body">
          <?php echo form_open($action);?>
            <!-- kolom kiri -->
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group"><label>Pembeli</label>
                    <input class="form-control" name="pembeli" id="pembeli" type="text" placeholder="Isi nama pembeli" value="<?php echo set_value('pembeli') ?>" required/>
                  </div>
                  <div class="row">
                    <div class="col-lg-4"><label>Nama Barang</label>
                      <select name="nama_barang[]" id="nama_barang" onchange="changeValue(this.value,'')" class="form-control" >
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $jsArray = "var prdName = new Array();\n";
                        foreach ($get_combo_barang as $barang)
                        {
                          echo '<option value="'.$barang->kd_barang.'">'.$barang->nama_barang.'</option>';
                          $jsArray .= "prdName['".$barang->kd_barang."'] =
                          {
                            kd_barang:'".addslashes($barang->kd_barang)."',
                            harga_jual:'".addslashes($barang->harga_jual)."',
                          };\n";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-4"><label>Kode Barang</label>
                      <input class="form-control" name="kd_barang[]" id="kd_barang" type="text" readonly value="<?php echo set_value('kd_barang[0]') ?>"/>
                    </div>
                    <div class="col-lg-4"><label>Harga Jual (pcs)</label>
                      <input class="form-control" name="harga_jual[]" id="harga_jual" type="text" readonly value="<?php echo set_value('harga_jual[0]') ?>"/>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-lg-4"><label>Qty</label>
                      <input class="form-control" name="qty[]" id="qty" type="text" placeholder="Isi angka saja" onkeyup="count('');" value="<?php echo set_value('qty[0]') ?>"/>
                    </div>
                    <div class="col-lg-4"><label>Total</label>
                      <input class="form-control" name="total[]" id="total" type="text"  readonly/>
                    </div>
                    <div class="col-lg-4"><label>Ket</label>
                      <input class="form-control" name="ket[]" id="ket" type="text" value="<?php echo set_value('ket[0]') ?>"/>
                    </div>
                  </div>
                  <div id="addedRows"></div><br/>
                  <button type="button" name="add" id="add" class="btn btn-primary" onclick="addMoreRows(this.form);">Tambah Barang</button><br/><br/>
                  <div class="form"><label>Grand Total</label>
                    <input class="form-control" name="gtotal" id="gtotal" type="text" readonly/>
                  </div>
                </div>
                <hr>
                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
                  <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
                </div>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    <?php echo $jsArray; ?>
    var rowCount = 1;
    function changeValue(value,id)
    {
        document.getElementById('kd_barang'+id).value = prdName[value].kd_barang;
        document.getElementById('harga_jual'+id).value = prdName[value].harga_jual;
    };

    function count(id) {
      var a = parseInt($("#harga_jual"+id).val());
      var b = parseInt($("#qty"+id).val());
      var g = parseInt($("#gtotal").val());
      var h = parseInt($("#total"+id).val());
      c = a * b;

      if (isNaN(h)) { h = 0; } else { h = h; }
      if (isNaN(g)) { f = c; } else { f = (g - h) + c; }

      if (!isNaN(c)) {
        $("#total"+id).val(c);
        $("#gtotal").val(f);
      }
    }

    function remcount(id) {
      var c = $("#total"+id).val();
      var d = $("#gtotal").val();

      e = d - c;

      $("#gtotal").val(e);
    }

    function removeMaterial(id){
      // $(lnk).parent().remove();
      remcount(id);
      removeRow(id);
    }

    function addMoreRows(frm) {
      rowCount++;
      var recRow = '<br><div id="rowCount'+rowCount+'"><hr>';
          recRow += '<div class="row"><div class="col-lg-4"><label>Nama Barang</label>';
          recRow += '<select name="nama_barang[]" id="nama_barang" onchange="changeValue(this.value,\''+rowCount+'\')" class="form-control">';
          recRow += '<option value="">-- Pilih Barang --</option><?php $jsArray = "var prdName = new Array();\n";foreach ($get_combo_barang as $barang){echo '<option value="'.$barang->kd_barang.'">'.$barang->nama_barang.'</option>';$jsArray .= "prdName['".$barang->kd_barang."']={kd_barang:'".addslashes($barang->kd_barang)."',harga_jual:'".addslashes($barang->harga_jual)."',};\n";} ?></select></div>';
          recRow += '<div class="col-lg-4"><label>Kode Barang</label>';
          recRow += '<input class="form-control" name="kd_barang[]" id="kd_barang'+rowCount+'" type="text" readonly value="<?php echo set_value('kd_barang['.'+rowCount+'.']') ?>"/></div>';
          recRow += '<div class="col-lg-4"><label>Harga Jual</label>';
          recRow += '<input class="form-control" name="harga_jual[]" id="harga_jual'+rowCount+'" type="text" readonly value="<?php echo set_value('harga_jual['.'+rowCount+'.']') ?>"/></div></div><br>';
          recRow += '<div class="row"><div class="col-lg-4"><label>Qty</label><input class="form-control" name="qty[]" id="qty'+rowCount+'" type="text" placeholder="Isi angka saja" onkeyup="count(\''+rowCount+'\');" value="<?php echo set_value('qty['.'+rowCount+'.']') ?>"/></div>';
          recRow += '<div class="col-lg-4"><label>Total</label>';
          recRow += '<input class="form-control" name="total[]" id="total'+rowCount+'" type="text" readonly/></div>';
          recRow += '<div class="col-lg-4"><label>Ket</label><input class="form-control" name="ket[]" id="ket'+rowCount+'" type="text" value="<?php echo set_value('ket['.'+rowCount+'.']') ?>"/></div></div><br>';
          recRow += '<div class="form-group"><a href="javascript:void(0);" onclick="removeMaterial(\''+rowCount+'\')"><button type="reset" name="reset" class="btn btn-warning">Hapus</button></a></div></div>';
      jQuery('#addedRows').append(recRow);
    }

    function removeRow(removeNum) {
      jQuery('#rowCount'+removeNum).remove();
    }
    </script>
