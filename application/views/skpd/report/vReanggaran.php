<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Pagu dan Realisasi Anggaran  </h4>
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
					<p><strong>Pagu dan Realisasi Anggaran (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class=" table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th rowspan="2" class="text-center" width="70" valign="top">No.</th>	
							<th rowspan="2" class="text-center" width="400">Program</th>
							<th rowspan="2" class="text-center">Pagu Anggaran</th>
							<th colspan="2" class="text-center">Triwulan 1</th>
							<th colspan="2" class="text-center">Triwulan 2</th>
							<th colspan="2" class="text-center">Triwulan 3</th>
							<th colspan="2" class="text-center">Triwulan 4</th>
						</tr>
						<tr>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
						</tr>
						<tr>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
							<th class="text-center">6</th>
							<th class="text-center">7</th>
							<th class="text-center">8</th>
							<th class="text-center">9</th>
							<th class="text-center">10</th>
							<th class="text-center">11</th>
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
						<tr class="bg-gray">
							<td class="text-center bg-blue">Sasaran <?php echo ++$key; ?></td>
							<td colspan="10"><?php echo $sasaran->deskripsi ?></td>
						</tr>
						<?php  
						/**
						 * Loop Program
						 *
						 * @var string
						 **/
						$totalPAngg = 0;
						foreach($this->mprogram->getProgramBySasaran( $sasaran->id_sasaran) as $keyProgram => $program) :
							$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
						?>
						<tr>
							<td class="text-center"><?php echo ++$keyProgram; ?></td>
							<td><?php echo $program->deskripsi; ?></td>
							<td class="text-center"><?php echo @number_format($anggaran) ?></td>
							<?php foreach(range(1, 4) as $tri => $tTahun) : 
							$REA = @$this->kgiatan->getTotalReAnggaranKegiatan($program->id_program, $this->tahun, "T".++$tri);
							@$percentage = (@$REA / $anggaran) * 100;
							?>
							<td class="text-center"><?php echo @number_format(@$REA) ?></td>
							<td class="text-center"><?php if($anggaran) echo @round($percentage, 2); ?></td>
							<?php endforeach; ?>
						</tr>
						<?php  
						$totalPAngg += $anggaran;
						endforeach;
						?>
						<tr>
							<td colspan="2"><strong class="pull-right">Total :</strong></td>
							<th class="text-center"><?php echo number_format($totalPAngg) ?></th>
							<?php foreach(range(1, 4) as $tri => $tTahun) : 
							$TOTREA = @$this->kgiatan->getSumTotalReAnggaranKegiatan($sasaran->id_sasaran, $this->tahun, "T".++$tri);
							$totalPercentage = @($TOTREA / $totalPAngg) * 100;
							?>
							<th class="text-center"><?php echo @number_format(@$TOTREA); ?></th>
							<td class="text-center"><?php if($totalPAngg) echo @round($totalPercentage, 2); ?></td>
							<?php endforeach; ?>
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