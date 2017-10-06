<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading">Data Prestasi</h4>
				</div>
                <a class="btn btn-default pull-right"  data-toggle="modal" href='#modal-tambah'>
                    <i class="fa fa-plus"></i> Tambah Prestasi
                </a>
			</div>
			<div class="box-body">
				<div class="col-md-12 bottom2x">
				<?php echo form_open(current_url(), array('method' => 'get')); ?>
					<div class="col-md-2">
						<label for="">Tahun</label>
						<select name="tingkat" class="form-control input-sm">
							<option value="">-- PILIH --</option>
						<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
						echo '<option value="'.$tahun.'">'.$tahun.'</option>';
						?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="">Tingkat</label>
						<select name="tingkat" class="form-control input-sm">
							<option value="">-- PILIH --</option>
							<option value="internasional">internasional</option>
							<option value="nasional">nasional</option>
							<option value="regional">regional</option>
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
							<th class="text-center">Prestasi</th>
							<th class="text-center">Tahun</th>
							<th class="text-center">Tingkat</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach( $prestasi as $key => $row ) : ?>
						<tr>
							<td><?php echo ++$this->page; ?>.</td>
							<td class="td-action">
								<?php echo $row->deskripsi; ?>
								<div class="button-action">
									<a href="javascript:void(0)" data-action="update" data-key="prestasi" data-id="<?php echo $row->id_prestasi ?>"><i class="fa fa-pencil"></i> Ubah</a>  |
									<a href="javascript:void(0)" data-action="delete" data-key="prestasi" data-id="<?php echo $row->id_prestasi ?>" class="red"> <i class="fa fa-trash-o"></i> Hapus</a>
								</div>
							</td>
							<td class="text-center"><?php echo $row->tahun; ?></td>
							<td class="text-center"><?php echo strtoupper($row->tingkat) ?></td>
						</tr>
					<?php endforeach; 
					if( ! $prestasi ) :
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
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Prestasi</h4>
			</div>
			<?php echo form_open(current_url()); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Prestasi :</label>
					<textarea name="prestasi" class="form-control" rows="2" required></textarea>
				</div>
				<div class="form-group">
					<label for="">Tahun Prestasi :</label>
					<select name="tahun" class="form-control" required="required">
					<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
					echo '<option value="'.$tahun.'">'.$tahun.'</option>';
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tingkat Prestasi :</label>
					<select name="tingkat" class="form-control" required="required">
						<option value="internasional">internasional</option>
						<option value="nasional">nasional</option>
						<option value="regional">regional</option>
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
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Prestasi</h4>
			</div>
			<form method="post" id="form-update">
			<div class="modal-body">
				<div class="form-group">
					<label for="">Prestasi :</label>
					<textarea name="prestasi" id="update-prestasi" class="form-control" rows="2" required></textarea>
				</div>
				<div class="form-group">
					<label for="">Tahun Prestasi :</label>
					<select name="tahun" id="update-tahun" class="form-control" required="required">
					<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
					echo '<option value="'.$tahun.'">'.$tahun.'</option>';
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tingkat Prestasi :</label>
					<select name="tingkat" id="update-tingkat" class="form-control" required="required">
						<option value="internasional">internasional</option>
						<option value="nasional">nasional</option>
						<option value="regional">regional</option>
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