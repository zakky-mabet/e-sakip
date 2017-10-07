<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading">Data Lampiran dan Foto/Gambar</h4>
				</div>
                <a class="btn btn-default pull-right"  data-toggle="modal" href='#modal-tambah'>
                    <i class="fa fa-plus"></i> Tambah Lampiran / Foto
                </a>
			</div>
			<div class="box-body">
				<div class="col-md-12 bottom2x">
				<?php echo form_open(current_url(), array('method' => 'get')); ?>
					<div class="col-md-2">
						<label for="">Bulan</label>
						<select name="bulan" class="form-control input-sm">
							<option value="">-- PILIH --</option>
							<?php $bulan = array('januari','februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september','oktober','november', 'desember') ?>
			          		<?php foreach ($bulan as $nama_bulan): ?>
								<option value="<?php echo $nama_bulan; ?>"><?php echo ucfirst($nama_bulan); ?></option>';
						 	<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-2">
						<label for="">Tahun</label>
						<select name="tahun" class="form-control input-sm">
							<option value="">-- PILIH --</option>
						<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
						echo '<option value="'.$tahun.'">'.$tahun.'</option>';
						?>
						</select>
					</div>
					<div class="col-md-2">
						<label for="">Kategori</label>
						<select name="kategori" class="form-control input-sm">
							<option value="">-- PILIH --</option>
							<option value="lampiran">lampiran</option>
							<option value="foto">foto</option>
						</select>
					</div>
					<div class="col-md-2">
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
							<th class="text-center">Bulan</th>
							<th class="text-center">Tahun</th>
							<th class="text-center">Kategori</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">File</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach( $lampiran as $key => $row ) : ?>
						<tr>
							<td class="text-center"><?php echo ++$this->page; ?>.</td>
							<td class="td-action">
								<?php echo ucfirst($row->bulan); ?>
								<div class="button-action">
									
									<a href="javascript:void(0)" data-action="update" data-key="lampiran" data-id="<?php echo $row->id ?>"><i class="fa fa-pencil"></i> Ubah</a> 
									 |
									<a href="javascript:void(0)" data-action="delete" data-key="lampiran" data-id="<?php echo $row->id ?>" class="red"> <i class="fa fa-trash-o"></i> Hapus</a>
								</div>
							</td>
							<td class="text-center"><?php echo $row->tahun; ?></td>
							<td class="text-center"><?php echo strtoupper($row->kategori) ?></td>
							<td class="text-center"><?php echo $row->keterangan; ?></td>
							<td class="text-center"> <a target="_blank" href="<?php  echo base_url('assets/lampiran/'.$row->file) ?>">Lihat File</a></td>
						</tr>
					<?php endforeach; 
					if( ! $lampiran ) :
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
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Lampiran / Foto</h4>
			</div>

			<?php echo form_open(current_url(), 'enctype="multipart/form-data"'); ?>
			<div class="modal-body">
				
				<div class="form-group">
					<label for="">Bulan :</label>
					<select name="bulan" class="form-control input-sm" required="required">
					<option value="">-- PILIH --</option>
						
					<?php $bulan = array('januari','februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september','oktober','november', 'desember') ?>
			         <?php foreach ($bulan as $nama_bulan): ?>
					<option value="<?php echo $nama_bulan; ?>"><?php echo ucfirst($nama_bulan); ?></option>';
					<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tahun :</label>
					<select name="tahun" class="form-control" required="required">
					<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
					echo '<option value="'.$tahun.'">'.$tahun.'</option>';
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Kategori :</label>
					<select name="kategori" class="form-control input-sm " required="required">
						<option value="">-- PILIH --</option>
						<option value="lampiran">lampiran</option>
						<option value="foto">foto / gambar</option>
					</select>
				</div>
				<div class="form-group">
					<label for="keterangan">Keterangan Lampiran / Foto :</label>
					<textarea name="keterangan" class="form-control" rows="2" required="required"></textarea>
				</div>
				<div class="form-group">
					<label for="">Keterangan Lampiran / Foto :</label>
					<input type="file" name="foto" required="required" class="form-control" >
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
				<h4 class="modal-title"><i class="fa fa-plus"></i> Ubah Lampiran/ Foto</h4>
			</div>
			<form method="post" action="<?php echo site_url('skpd/realisasi_sasaran/update_lampiran') ?>"  enctype="multipart/form-data">
			<div class="modal-body">
				<input name="" type="hidden" id="ID" value="">
				<input name="" type="hidden" id="unlink_file" value="">
				<div class="form-group">
					<label for="">Bulan :</label>
					<select name="bulan" id="update-bulan"  class="form-control input-sm" required="required">	
					<?php $bulan = array('januari','februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september','oktober','november', 'desember') ?>
			         <?php foreach ($bulan as $nama_bulan): ?>
					<option value="<?php echo $nama_bulan; ?>"><?php echo $nama_bulan; ?></option>';
					<?php endforeach ?>
					</select>
				</div>
				
				<div class="form-group">
					<label for="">Tahun :</label>
					<select name="tahun" id="update-tahun" class="form-control" required="required">
					<?php foreach( range($this->periode_awal, $this->periode_akhir) as $tahun) 
					echo '<option value="'.$tahun.'">'.$tahun.'</option>';
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Kategori :</label>
					<select name="kategori" id="update-kategori" class="form-control" required="required">
						<option value="lampiran">lampiran</option>
						<option value="foto">foto</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Ketrangan :</label>
					<textarea name="keterangan" id="update-keterangan" class="form-control" rows="2" required></textarea>
				</div>

				<div class="form-group">
					<label for="">Keterangan Lampiran / Foto :</label>
					<input type="file" name="foto"  id="update-foto" required="required" class="form-control" >
				</div> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
				<button type="submit" id="set-update-data" class="btn btn-primary">Simpan</button>
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