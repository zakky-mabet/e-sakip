<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered">
		<thead class="bg-blue">
			<tr>
				<th rowspan="3" class="text-center" style="vertical-align: middle;" width="70">No.</th>
				<th rowspan="3" class="text-center" style="vertical-align: middle;">Sasaran Strategis</th>
				<th rowspan="3" class="text-center" style="vertical-align: middle;" width="80">Jumlah Indikator</th>
				<th rowspan="3" class="text-center" style="vertical-align: middle;" width="80">Rata-rata Capaian</th>
			</tr>
			<tr>
				<th class="text-center" width="60" style="vertical-align: middle;">0-20</th>
				<th class="text-center" width="60" style="vertical-align: middle;">21-40</th>
				<th class="text-center" width="60" style="vertical-align: middle;">41-80</th>
				<th class="text-center" width="60" style="vertical-align: middle;">81-95</th>
				<th class="text-center" width="60" style="vertical-align: middle;">96-100</th>
			</tr>
			<tr>
				<th class="text-center" style="vertical-align: middle;">Sangat Kurang</th>
				<th class="text-center" style="vertical-align: middle;">Kurang</th>
				<th class="text-center" style="vertical-align: middle;">Cukup</th>
				<th class="text-center" style="vertical-align: middle;">Baik</th>
				<th class="text-center" style="vertical-align: middle;">Sangat Baik</th>
			</tr>
		</thead>
		<tbody>
            <?php 
            /**
             * Loop Misi
             *
             * @var string
             **/
            foreach(  $this->tjuan->getMisiLogin() as $key => $misi) : ?>
			<tr>
				<td class="text-center">Misi <?php echo ++$key; ?></td>
				<td><?php echo $misi->deskripsi ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php  
			endforeach;
			?>
		</tbody>
	</table>
</div>