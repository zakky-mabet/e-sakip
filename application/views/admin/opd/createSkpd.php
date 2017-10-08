<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="col-md-7 col-md-offset-3">
			<?php echo $this->session->flashdata('alert'); ?>
		</div>
		<form class="form-horizontal" action="<?php echo current_url() ?>" method="post">
			<div class="form-group">
				<div class="col-sm-10 col-md-offset-2">
					<h4>Tambah OPD</h4>
				</div>
    			<label class="control-label col-sm-2">Nama OPD :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="nama_opd" value="<?php echo set_value('nama_opd') ?>">
      				<p class="help-block"><?php echo form_error('nama_opd', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">Alamat :</label>
    			<div class="col-sm-10"> 
      				<textarea class="form-control" rows="3" name="alamat"><?php echo set_value('alamat') ?></textarea>
      				<p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">E-Mail :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="email" value="<?php echo set_value('email') ?>">
      				<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
    			<label class="control-label col-sm-2">No. Telepon :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="phone" value="<?php echo set_value('phone') ?>">
      				<p class="help-block"><?php echo form_error('phone', '<small class="text-red">', '</small>') ?></p>
    			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-md-offset-2">
					<h4>Akun Login</h4>
				</div>
    			<label class="control-label col-sm-2">Username :</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>">
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