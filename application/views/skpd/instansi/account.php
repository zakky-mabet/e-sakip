<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
		<div class="nav-tabs-custom" role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="<?php if($this->nav=='profil' OR $this->input->post('nav') == 'profil') echo 'active' ?>">
					<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><strong>Profil</strong></a>
				</li>
				<li role="presentation" class="<?php if($this->nav=='change_password' OR $this->input->post('nav') == 'change_password') echo 'active' ?>">
					<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><strong>Ganti Password</strong></a>
				</li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane <?php if($this->nav=='profil' OR $this->input->post('nav') == 'profil') echo 'active' ?>" id="home">
				<?php echo form_open(current_url()); 
				echo form_hidden('nav', 'profil');
				?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama OPD :</label>
								<input type="text" class="form-control" name="nama_opd" value="<?php echo (set_value('nama_opd')) ? set_value('nama_opd') : $SKPD->nama  ?>">
								<p class="help-block"><?php echo form_error('nama_opd', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Alamat :</label>
								<textarea class="form-control" rows="2" name="alamat"><?php echo (set_value('alamat')) ? set_value('alamat') : $SKPD->alamat ?></textarea>
								<p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>E-Mail :</label>
								<input type="email" class="form-control" name="email" value="<?php echo (set_value('email')) ? set_value('email') : $SKPD->email ?>">
								<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>No Telepon :</label>
								<input type="text" class="form-control" name="phone" value="<?php echo (set_value('phone')) ? set_value('phone') : $SKPD->no_telp ?>">
								<p class="help-block"><?php echo form_error('phone', '<small class="text-red">', '</small>') ?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>NIP Kepala :</label>
								<input type="text" class="form-control" name="nip_kepala" value="<?php echo (set_value('nip_kepala')) ? set_value('nip_kepala') : $kepala->nip_kepala ?>">
								<p class="help-block"><?php echo form_error('nip_kepala', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Nama Kepala :</label>
								<input type="text" class="form-control" name="nama_kepala" value="<?php echo (set_value('nama_kepala')) ? set_value('nama_kepala') : $kepala->nama_kepala ?>">
								<p class="help-block"><?php echo form_error('nama_kepala', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Jabatan Kepala :</label>
								<input type="text" class="form-control" name="jabatan" value="<?php echo (set_value('jabatan')) ? set_value('jabatan') : $kepala->jabatan ?>">
								<p class="help-block"><?php echo form_error('jabatan', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Pangkat Kepala :</label>
								<input type="text" class="form-control" name="pangkat" value="<?php echo (set_value('pangkat')) ? set_value('pangkat') : $kepala->pangkat ?>">
								<p class="help-block"><?php echo form_error('pangkat', '<small class="text-red">', '</small>') ?></p>
							</div>	
							<div class="form-group">
								<label>Golongan Kepala :</label>
								<input type="text" class="form-control" name="golongan" value="<?php echo (set_value('golongan')) ? set_value('golongan') : $kepala->golongan ?>">
								<p class="help-block"><?php echo form_error('golongan', '<small class="text-red">', '</small>') ?></p>
							</div>		
						</div>
						<div class="col-md-12"><hr>
							<button class="btn-app pull-right" type="submit">
								<i class="fa fa-save"></i> Simpan
							</button>
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
				<div role="tabpanel" class="tab-pane <?php if($this->nav=='change_password' OR $this->input->post('nav') == 'change_password') echo 'active' ?>" id="tab">
				<?php echo form_open(current_url()); 
				echo form_hidden('nav', 'change_password');
				?>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<label>Username :</label>
								<input type="text" class="form-control" name="username" value="<?php echo (set_value('username')) ? set_value('username') : $SKPD->username  ?>">
								<p class="help-block"><?php echo form_error('username', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Password Baru :</label>
								<input type="password" class="form-control" name="new_pass" value="<?php echo set_value('new_pass') ?>">
								<p class="help-block"><?php echo form_error('new_pass', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Ulangi Password Baru :</label>
								<input type="password" class="form-control" name="repeat_new_pass" value="<?php echo set_value('repeat_new_pass')  ?>">
								<p class="help-block"><?php echo form_error('repeat_new_pass', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<label>Password Lama :</label>
								<input type="password" class="form-control" name="old_pass" value="<?php echo set_value('old_pass')  ?>">
								<p class="help-block"><?php echo form_error('old_pass', '<small class="text-red">', '</small>') ?></p>
							</div>
							<div class="form-group">
								<hr>
								<button class="btn-app pull-right" type="submit">
									<i class="fa fa-save"></i> Simpan
								</button>
							</div>
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>