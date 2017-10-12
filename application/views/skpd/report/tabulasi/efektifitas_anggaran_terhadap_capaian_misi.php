<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered" style="width: 100%;">
		<thead class="bg-blue">
			<tr>
				<th rowspan="2" class="text-center" width="70" style="vertical-align: middle;">No.</th>
				<th rowspan="2" class="text-center" style="vertical-align: middle;">Kategori</th>
				<th rowspan="2" class="text-center" width="70" style="vertical-align: middle;">Jumlah Indikator</th>
				<th rowspan="2" class="text-center" width="80" style="vertical-align: middle;">Presentase Capaian Kinerja</th>
				<th class="text-center" width="200" colspan="2">Anggaran</th>
			</tr>
			<tr>
				<th class="text-center" width="120">Realisasi (Rp.)</th>
				<th class="text-center" width="120">%</th>
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
			<tr class="bg-gray">
				<td class="text-center">Misi <?php echo ++$key; ?></td>
				<td colspan="5"><?php echo $misi->deskripsi ?></td>
			</tr>
			<?php foreach($this->kategoriCapaian as $no => $kategori) : ?>
			<tr>
				<td class="text-center"><?php echo ++$no; ?>.</td>
				<td><?php echo $kategori ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php  
			endforeach;
			endforeach;
			?>
		</tbody>
	</table>
</div>