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
          <?php echo form_open($action_add);?>
            <!-- kolom kiri -->
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group"><label>Supplier</label>
                    <input class="form-control" name="supplier" id="supplier" type="text" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6"><label>Kode Barang</label>
                    <input class="form-control" name="kd_barang" id="kd_barang" type="text" />
                  </div>
                  <div class="col-lg-6"><label>Nama Barang</label>
                    <input class="form-control" name="nama_barang" id="nama_barang" type="text"/>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-lg-4"><label>Harga Beli (pcs)</label>
                    <input class="form-control" name="harga_beli" id="harga_beli" type="text" placeholder="Isi angka saja" onkeyup="count();"/>
                  </div>
                  <div class="col-lg-4"><label>Harga Jual (pcs)</label>
                    <input class="form-control" name="harga_jual" id="harga_jual" type="text" placeholder="Isi angka saja"/>
                  </div>
                  <div class="col-lg-2"><label>Qty</label>
                    <input class="form-control" name="qty" id="qty" type="text" placeholder="Isi angka saja" onkeyup="count();"/>
                  </div>
                  <div class="col-lg-2"><label>Keterangan</label>
                    <input class="form-control" name="ket" id="ket" type="text" size="30"/>
                  </div>
                </div><br>
                <div class="form"><label>Total</label>
                  <input class="form-control" name="total" id="total" type="text" readonly/>
                </div>
              </div>
              <hr>
              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
                <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    function count() {
      var a = parseInt($("#harga_beli").val());
      var b = parseInt($("#qty").val());
      c = a * b;
      if (!isNaN(c)) {
        $("#total").val(c);
      }
    }
    </script>
