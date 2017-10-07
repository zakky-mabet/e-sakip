<div class="row">
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-3">
        	<div class="input-group">
                <input type="text" name="q" value="<?php echo $this->query ?>" class="form-control" placeholder="Pencarian ...">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
        	</div>
		</div>
		<div class="col-md-2 pull-right">
			<a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box">
			<div class="box-body no-padding">
				<table class="table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50">NO.</th>
							<th class="text-center">OPD</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">E-Mail</th>
							<th class="text-center">Telepon</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>