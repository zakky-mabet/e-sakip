<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Rencana Kinerja Tahunan  </h4>
					<p style="margin-left: 23px;">Periode <?php echo $this->periode_awal.'-'.$this->periode_akhir ?></p>
				</div>
				<div class="col-md-7">
					<div class="col-md-4">
						<label>Tahun</label>
						<select name="thn" class="form-control input-sm" onchange="window.location = '<?php echo current_url() ?>?thn=' + this.value">
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
						{
							$selected = ($tahun == $this->tahun) ? 'selected' : '';
							echo '<option value="'.$tahun.'" '.$selected.'>'.$tahun.'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-6 pull-right top2x">
						<a href="<?php echo current_url().'?output=print&thn='.$this->tahun ?>" target="_blank" class="btn btn-default btn-print">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?php echo current_url().'?output=pdf&thn='.$this->tahun ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<!-- <a href="<?php echo current_url().'?output=excel&thn='.$this->tahun ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-excel-o"></i> Excel
						</a> -->
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="box no-border">
			<div class="box-body no-padding">
				<div class="clearfix"></div>
				<hr>
				<div class="col-md-12 text-center">
					<p><strong>Rencana Kinerja Tahunan (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class="table table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>
							<th class="text-center" valign="top">Sasaran</th>
							<th class="text-center" colspan="3">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Target <?php echo $this->tahun ?></th>
						</tr>
					</thead>
					<tbody>
			        <?php 
			        /**
			         * Loop Sasaran
			         *
			         * @var string
			         **/
			        foreach(  $this->mprogram->getSasaranByLogin() as $key => $sasaran) : 
			        	$DIndikator = $this->tjuan->getInodikatorSasaranBySasaran($sasaran->id_sasaran);
			        	$col1 = (count($DIndikator) + 1);
			        ?>
					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php echo ++$key ?>.</td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $sasaran->deskripsi ?></td>
					</tr>
			        <?php 
			        /**
			         * Loop Program
			         *
			         * @var string
			         **/
			        foreach(  $DIndikator as $keyIndikator => $indikator) : 
			        	$target = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $this->tahun);
			       ?>
					<tr>
						<td colspan="2" width="40"><?php echo $key.".".++$keyIndikator ?></td>
						<td><?php echo $indikator->deskripsi ?></td>
						<td class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td class="text-center"><?php echo @$target->nilai_target ?></td>
					</tr>
			        <?php  
			    	endforeach;
			    	// end indikator
			     	endforeach;
			     	// end sasaran
			        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>