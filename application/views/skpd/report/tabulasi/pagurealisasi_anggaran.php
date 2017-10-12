<div class="col-md-12">
	<p class="text-center"><strong><?php echo $this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama ?></strong></p>
	<p class="text-center"><strong>Tahun <?php echo $this->tahun ?></strong></p>
	<table class="table table-bordered" style="width: 100%">
		<thead class="bg-blue">
			<tr>
				<th class="text-center" width="50">No.</th>
				<th class="text-center">Misi</th>
				<th class="text-center" colspan="2">Sasaran</th>
				<th class="text-center" width="120">Pagu Anggaran</th>
				<th class="text-center" width="120">Realisasi</th>
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
            foreach(  $this->tjuan->getMisiLogin() as $key => $misi) : 

            	$col = count($this->tjuan->getSasaranByMisi($misi->id_misi)) + 1;
            ?>
			<tr>
				<td rowspan="<?php echo $col ?>" class="text-center"><?php echo ++$key; ?>.</td>
				<td rowspan="<?php echo $col ?>"><?php echo $misi->deskripsi ?></td>
			</tr>
			<?php  
			foreach ($this->tjuan->getSasaranByMisi($misi->id_misi) as $keySasaran => $sasaran) :
			?>
			<tr>
				<td class="text-center"><?php echo $key.".".++$keySasaran ?>.</td>
				<td><?php echo $sasaran->deskripsi; ?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php  
			endforeach;
			endforeach;
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4"><span class="pull-right">Jumlah :</span></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>