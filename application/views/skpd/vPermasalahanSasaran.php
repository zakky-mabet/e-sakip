<div class="row">
	<?php echo form_open(base_url("skpd/sasaran/permasalahan_update/".$param)); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">
		<div class="box">
			<div class="box-header ">
				<div class="col-md-12">

					<h5 class="box-heading">
						<span class="bold">Sasaran </span>: <?php echo $this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->deskripsi   ?>		
					</h5>
				</div>
				
			</div>
			<div class="box-body">
				 <div class="callout callout-primary">
					<label for="label">Permasalahan :</label>
					<?php echo form_hidden("permasalahan[IDP][]", $this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->id_permasalahan);?>
					<textarea name="permasalahan[deskripsi_permasalahan][<?php echo $this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->id_permasalahan ?>]" class="form-control" rows="4" required="required"><?php echo $this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->deskripsi_permasalahan ?></textarea>

					
				</div>

				 <div class="callout callout-primary">

					<?php if (count($this->msasaran->get_akar_permasalahan($this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->id_permasalahan)) == 0 ): ?>
						
						<div class="alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Akar Permsalahan belum tersedia !</strong> Sillahkan Input Permasalahan terlebih dahulu.
						</div>

					<?php else: ?>	
					<label for="label">Akar Permasalahan :</label>
					
					<table class="table table-bordered table-hover ">
						<thead>
							<tr class="bg-blue">
								<th class="text-center" style="vertical-align: middle;" width="40">No</th>
								<th class="text-center">Akar Permasalahan</th>
								<th class="text-center">Kelola</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($this->msasaran->get_akar_permasalahan($this->msasaran->get_sasaran_to_permasalahan_sasaran($param)->id_permasalahan) as $key => $value): ?>

							<tr>
								<td style="vertical-align: middle;" class="text-center"><?php echo ++$key; ?></td>
								<td>
									<?php echo form_hidden("akar[IDA][]", $value->id );?>

									<textarea name="akar[deskripsi_akar][<?php echo $value->id ?>]" class="form-control" ><?php echo $value->deskripsi_akar  ?></textarea>
								</td>
								<td  style="vertical-align: middle;" class="text-center"> 
									<a class="btn btn-danger"><i class="fa fa-trash get-delete-akar" data-id="<?php echo $value->id ?>"></i></a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					

					<?php endif ?>
				</div>
			</div>
	</div>		
</div>

<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
	<?php echo form_close(); ?>
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

								
			