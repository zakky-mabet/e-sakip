<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered" style="width: 100%;">
		<thead class="bg-blue">
			<tr>
				<th class="text-center" width="70">No.</th>
				<th class="text-center">Kategori</th>
				<th class="text-center" width="70">Jumlah Indikator</th>
				<th class="text-center" width="80">Presentase</th>
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
				<td colspan="3"><?php echo $misi->deskripsi ?></td>
			</tr>
			<?php foreach($this->kategoriCapaian as $no => $kategori) : ?>
			<tr>
				<td class="text-center"><?php echo ++$no; ?>.</td>
				<td><?php echo $kategori ?></td>
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