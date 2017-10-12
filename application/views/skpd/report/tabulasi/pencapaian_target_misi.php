<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered" style="width: 100%">
		<thead class="bg-blue">
			<tr>
				<th rowspan="4" class="text-center" style="vertical-align: middle;" width="40">No.</th>
				<th rowspan="4" class="text-center" style="vertical-align: middle;">Misi</th>
				<th rowspan="4" class="text-center" style="vertical-align: middle;" width="60">Jumlah Indikator Sasaran</th>
				<th colspan="6" class="text-center" style="vertical-align: middle;">Tingkat Pencapaian</th>
			</tr>
			<tr>
				<th colspan="2" class="text-center" style="vertical-align: middle;">Melampaui Target <br><small>( > 100% )</small></th>
				<th colspan="2" class="text-center" style="vertical-align: middle;">Sesuai Target <br><small>( = 100% )</small></th>
				<th colspan="2" class="text-center" style="vertical-align: middle;">Belum Mencapai Target <br><small>( < 100% )</small></th>
			</tr>
			<tr>
				<th width="50" class="text-center">Jumlah</th>
				<th width="50" class="text-center">%</th>
				<th width="50" class="text-center">Jumlah</th>
				<th width="50" class="text-center">%</th>
				<th width="50" class="text-center">Jumlah</th>
				<th width="50" class="text-center">%</th>
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
				<td class="text-center"><?php echo ++$key; ?></td>
				<td class="text-center">Misi <?php echo $key ?></td>
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