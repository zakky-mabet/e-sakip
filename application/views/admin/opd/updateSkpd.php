<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="col-md-7 col-md-offset-3">
			<?php echo $this->session->flashdata('alert'); ?>
		</div>
		<form class="form-horizontal" action="<?php echo current_url() ?>" method="post">
      <?php echo form_hidden('ID', $opd->ID); ?>
			<div class="form-group">
				<div class="col-sm-10 col-md-offset-2">
					<h4>Update OPD</h4>
				</div>
    			<label class="control-label col-sm-2">Nama OPD :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="nama_opd" value="<?php echo (set_value('nama_opd')) ? set_value('nama_opd') : $opd->nama ?>">
      				<p class="help-block"><?php echo form_error('nama_opd', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">Alamat :</label>
    			<div class="col-sm-10"> 
      				<textarea class="form-control" rows="3" name="alamat"><?php echo (set_value('alamat')) ? set_value('alamat') : $opd->alamat ?></textarea>
      				<p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">E-Mail :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="email" value="<?php echo (set_value('email')) ? set_value('email') : $opd->email ?>">
      				<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">No. Telepon :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="phone" value="<?php echo (set_value('phone')) ? set_value('phone') : $opd->no_telp ?>">
      				<p class="help-block"><?php echo form_error('phone', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-md-offset-2">
					<h4>Akun Login</h4>
          <p>Kosongkan password bila tidak ingin mengganti password.</p>
				</div>
    			<label class="control-label col-sm-2">Username :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="username" value="<?php echo (set_value('username')) ? set_value('username') : $opd->username ?>">
      				<p class="help-block"><?php echo form_error('username', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">Password :</label>
    			<div class="col-sm-10">
      				<input type="password" class="form-control" name="new_pass" value="<?php echo set_value('new_pass') ?>">
      				<p class="help-block"><?php echo form_error('new_pass', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">Ulangi Password :</label>
    			<div class="col-sm-10">
      				<input type="password" class="form-control" name="repeat_new_pass" value="<?php echo set_value('repeat_new_pass') ?>">
      				<p class="help-block"><?php echo form_error('repeat_new_pass', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<div class="col-sm-6 col-md-offset-4">
      				<a href="<?php echo site_url('admin/opd') ?>" class="btn btn-app">
      					<i class="fa fa-undo"></i> Kembali
      				</a>
      				<button class="btn btn-app pull-right btn-primary" type="submit">
      					<i class="fa fa-save"></i> Simpan
      				</button>
    			</div>
			</div>
  		</form>
	</div>
</div>