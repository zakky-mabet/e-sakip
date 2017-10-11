<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Tingkat Efisiensi dan Efektifitas Kinerja</h4>
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
						<a href="<?php echo current_url().'?output=print&thn='.$this->input->get('thn') ?>" target="_blank" class="btn btn-default btn-print">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?php echo current_url().'?output=pdf&thn='.$this->input->get('thn') ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<!-- <a href="<?php echo current_url().'?output=excel&thn='.$this->input->get('thn') ?>" target="_blank" class="btn btn-default">
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
					<p><strong>Tingkat Efisiensi dan Efektifitas Kinerja  (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class="mini-font table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th rowspan="2" class="text-center" width="30" valign="top">No.</th>	
							<th rowspan="2" class="text-center" colspan="2" width="150">Indikator</th>
							<th rowspan="2" class="text-center" width="70">Satuan</th>
							<th class="text-center" colspan="3" width="180">Kinerja</th>
							<th class="text-center" colspan="5">Keuangan</th>
						</tr>
						<tr>
							<th class="text-center">Target</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center" colspan="2">Program</th>
							<th class="text-center">Pagu</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
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
				    ?>
					<tr class="bg-gray">
						<td><?php echo ++$key ?></td>
						<td colspan="11"><strong>Sasaran : </strong><?php echo $sasaran->deskripsi ?></td>
					</tr>
			        <?php 
			        /**
			         * Loop Program
			         *
			         * @var string
			         **/
			        $TotRTR = 0;
			        foreach(  $DIndikator as $keyIndikator => $indikator) : 
			        	$Dporgram =$this->mprogram->getProgramBySasaran( $indikator->id_sasaran);
			        	$PK = $this->mprogram->getPKIndikatorTargetTriwulan($indikator->id_indikator_sasaran, $this->tahun);

			        	$multipleProgram = array();
			        	foreach($Dporgram as $row)
			        		$multipleProgram[] = $row->id_program;

			        	$col1 = (count($Dporgram) + 1);

			        	$TR = $this->mprogram->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $this->tahun);
			        	$RTR = @$this->mprogram->getRealisasiIndikatorSasaran($TR->id_target_sasaran, $this->tahun);
			       ?>
 					<tr>
 						<td rowspan="<?php echo $col1 ?>"></td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $key.'.'.++$keyIndikator  ?></td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $indikator->deskripsi ?></td>
						<td rowspan="<?php echo $col1 ?>" class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td rowspan="<?php echo $col1 ?>" class="text-center"><?php echo @$TR->nilai_target; ?></td>
						<td rowspan="<?php echo $col1 ?>" class="text-center"><?php echo @$RTR->nilai_realisasi ?></td>
						<td rowspan="<?php echo $col1 ?>" class="bg-red"><?php echo @$RTR->nilai_capaian ?></td>
					</tr>
			        <?php  
					/**
					 * Loop Program
					 *
					 * @var string
					 **/
					$totalPAngg = 0;
					$TotalreKeua = 0;
					foreach($Dporgram as $keyProgram => $program) :
						$DKegiatan = $this->kgiatan->getKegiatanProgramByProgram($program->id_program);
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
					?>
					<tr>
						<td><?php echo $key.'.'.$keyIndikator.'.'.++$keyProgram ?></td>
						<td><?php echo $program->deskripsi ?></td>
						<td><?php echo @number_format($anggaran) ?></td>
						<td>
							<?php  
							$reKeua = 0;
							foreach(range(1, 4) as $tri => $tTahun)
								$reKeua += $this->kgiatan->getTotalReAnggaranKegiatan($program->id_program, $this->tahun, "T".++$tri);
								@$percentage = (@$reKeua / $anggaran) * 100;
							echo number_format($reKeua);
							?>
						</td>
						<td class="text-center"><?php if($anggaran) echo @round($percentage, 2); ?></td>
					</tr>
					<?php  
					$totalPAngg += $anggaran;
					$TotalreKeua += $reKeua;
					endforeach;
					@$TotRTR += @$RTR->nilai_capaian;
					endforeach;
					$totalPercentage = @($TotalreKeua / $totalPAngg) * 100;
					?>
					<tr>
						<th colspan="6" class="text-center">RATA-RATA CAPAIAN DARI <?php echo count($DIndikator) ?> INDIKATOR</th>
						<td class="bg-red"><?php echo $TotRTR; ?></td>
						<th class="text-center" colspan="2">TOTAL PER SASARAN</th>
						<th><?php echo number_format($totalPAngg) ?></th>
						<th><?php echo @number_format(@$TotalreKeua) ?></th>
						<th class="text-center"><?php if($totalPAngg) echo @round($totalPercentage, 2); ?></th>
					</tr>
					<?php
					endforeach;
				    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>