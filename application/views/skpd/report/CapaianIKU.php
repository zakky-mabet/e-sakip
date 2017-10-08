<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Capaian Indikator Kinerja Utama  </h4>
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
						<a href="" class="btn btn-default">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<a href="" class="btn btn-default">
							<i class="fa fa-file-excel-o"></i> Excel
						</a>
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
					<p><strong>Capaian Indikator Kinerja Utama Tahun <?php echo $this->tahun ?></strong></p>
				</div>
				<table class="mini-font table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>	
							<th class="text-center">Sasaran Strategis</th>
							<th class="text-center" colspan="2">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Target Tahunan</th>
							<th class="text-center">Triwulan</th>
							<th class="text-center">Target</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">Capaian (%)</th>
							<th class="text-center">Keterangan</th>
						</tr>
						<tr>
							<th class="text-center">a</th>
							<th class="text-center">b</th>
							<th class="text-center">c</th>
							<th class="text-center">d</th>
							<th class="text-center">e</th>
							<th class="text-center">f</th>
							<th class="text-center">g</th>
							<th class="text-center">h</th>
							<th class="text-center">i</th>
							<th class="text-center">j</th>
							<th class="text-center">k</th>
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

			            //if( $col1 >= 2 )
			            //	$col1;
			        ?>
					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php echo ++$key; ?>.</td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $sasaran->deskripsi; ?></td>
					</tr>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $DIndikator as $keyIndikator => $indikator) : 
			            	$targetThn = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $this->tahun);
			            ?>

					<tr>
						<td   class="text-center"><?php echo $key.".".++$keyIndikator ?></td>
						<td ><?php echo $indikator->deskripsi; ?></td>
						<td  class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td class="text-center"><?php echo @$targetThn->nilai_target ?></td>
						
					</tr>
					<?php endforeach;
			        ?>
			        <?php 
			        endforeach; ?>


			    	
			        
					</tbody>
				</table>

				<
			</div>
		</div>
	</div>
</div>