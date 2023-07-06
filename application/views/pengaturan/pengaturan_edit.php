<?php $this->load->view('header'); ?>

<?php $this->load->view('navbar'); ?>

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
    <li><?php echo $module ?></li>
    <li class="active"><?php echo $title_edit ?></li>
  </ol>
  <div class="row">
    <div class="col-md-12">
      <?php echo validation_errors() ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><label><?php echo strtoupper($title_edit) ?></label></div>
        <div class="panel-body">
          <?php echo form_open($action_edit);?>
            <?php echo form_input($slug, $pengaturan->slug) ?>
            <!-- kolom kiri -->
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group"><label>Bagian</label>
                    <?php echo form_input($nama, $pengaturan->nama) ?>
                  </div>
                  <div class="form-group"><label>Isi</label>
                    <?php echo form_input($isi, $pengaturan->isi) ?>
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
