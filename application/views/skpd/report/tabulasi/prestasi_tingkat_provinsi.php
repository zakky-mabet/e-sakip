<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered" style="width: 100%">
		<thead class="bg-blue">
			<tr>
				<th class="text-center" width="50">No.</th>
				<th class="text-center">Prestasi</th>
				<th class="text-center" width="50">Tahun</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($this->mprestasi->getFilter('provinsi', $this->tahun) as $no => $prestasi) : ?>
			<tr>
				<td><?php echo ++$no ?></td>
				<td><?php echo $prestasi->deskripsi ?></td>
				<td><?php echo $prestasi->tahun ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>