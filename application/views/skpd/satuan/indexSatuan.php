<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading">Master Data Satuan</h4>
				</div>
                <a class="btn btn-default pull-right"  data-toggle="modal" href='#modal-tambah'>
                    <i class="fa fa-plus"></i> Tambah Sataun
                </a>
			</div>
			<div class="box-body">
				<div class="col-md-12 bottom2x">
				<?php echo form_open(current_url(), array('method' => 'get')); ?>
					<div class="col-md-4">
						<label for="">SKPD</label>
						<select name="skpd" class="form-control input-sm">
							<option value="">-- PILIH --</option>
						<?php foreach($this->db->get('skpd')->result() as $row) : ?>
							<option value="<?php echo $row->ID ?>" <?php if($this->input->get('skpd')==$row->ID) echo 'selected' ?>>
								<?php echo $row->nama ?>
							</option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-2">
						<label for="">Jenis</label>
						<select name="jenis" class="form-control input-sm">
							<option value="">-- PILIH --</option>
							<option value="Kuantitatif" <?php if($this->input->get('jenis')=='Kuantitatif') echo 'selected' ?>>Kuantitatif</option>
							<option value="Kualitatif" <?php if($this->input->get('jenis')=='Kualitatif') echo 'selected' ?>>Kualitatif</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="">Kata Kunci</label>
						<input type="text" class="form-control input-sm" name="query" value="<?php echo $this->query ?>">
					</div>
					<div class="col-md-3">
						<button class="btn btn-default top2x"><i class="fa fa-filter"></i> Filter Data</button>
						<a href="<?php echo current_url() ?>" class="btn btn-default top2x"><i class="fa fa-times"></i> Reset</a>
					</div>
					<?php echo form_close(); ?>
				</div>
				<table class="table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50">No.</th>
							<th class="text-center">Nama SKPD</th>
							<th class="text-center">Nama Satuan</th>
							<th class="text-center">Jenis Satuan</th>
							<th width="100"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach( $satuan as $key => $row ) : ?>
						<tr>
							<td><?php echo ++$this->page; ?>.</td>
							<td><?php echo $row->nama_skpd ?></td>
							<td> <?php echo $row->nama; ?></td>
							<td class="text-center"><?php echo $row->jenis; ?></td>
							<td class="text-center">
								<?php if($this->SKPD == $row->id_skpd) : ?>
								<a href="javascript:void(0)" data-id="<?php echo $row->id ?>" data-action="update" data-key="satuan" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
								<a href="javascript:void(0)" data-id="<?php echo $row->id ?>" data-action="delete" data-key="satuan" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; 
					if( ! $satuan ) :
					?>
						<tr>
							<td colspan="5">
								<div class="alert alert-warning animated shake">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>Maaf!</strong> Data tidak ditemukan.
								</div>
							</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fadeIn" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Satuan</h4>
			</div>
			<?php echo form_open(current_url()); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Nama Satuan :</label>
					<textarea name="satuan" class="form-control" rows="2" required></textarea>
				</div>
				<div class="form-group">
					<label for="">Jenis :</label>
					<select name="jenis" class="form-control input-sm">
						<option value="">-- PILIH --</option>
						<option value="Kuantitatif" <?php if($this->input->get('jenis')=='Kuantitatif') echo 'selected' ?>>Kuantitatif</option>
						<option value="Kualitatif" <?php if($this->input->get('jenis')=='Kualitatif') echo 'selected' ?>>Kualitatif</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Tambahkan</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="modal fadeIn" id="modal-update">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-pencil"></i> Update Satuan</h4>
			</div>
			<form method="post" id="form-update">
			<div class="modal-body">
				<div class="form-group">
					<label for="">Nama Satuan :</label>
					<textarea name="satuan" id="update-satuan" class="form-control" rows="2" required></textarea>
				</div>
				<div class="form-group">
					<label for="">Jenis :</label>
					<select name="jenis" id="update-jenis" class="form-control input-sm">
						<option value="">-- PILIH --</option>
						<option value="Kuantitatif" <?php if($this->input->get('jenis')=='Kuantitatif') echo 'selected' ?>>Kuantitatif</option>
						<option value="Kualitatif" <?php if($this->input->get('jenis')=='Kualitatif') echo 'selected' ?>>Kualitatif</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
				<button type="submit" id="set-update-data" class="btn btn-primary">Tambahkan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-yes" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>