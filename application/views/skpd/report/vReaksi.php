<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Rencana Rencana Aksi   </h4>
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
						<a href="<?php echo current_url().'?output=excel&thn='.$this->input->get('thn') ?>" target="_blank" class="btn btn-default">
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
					<p><strong>Rencana Rencana Aksi  (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class="mini-font table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">No.</th>	
							<th class="text-center" width="180">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center" width="70">Target</th>
							<th class="text-center" width="180">Program</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center" width="180">Kegiatan</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center">Output Kegiatan</th>
							<th class="text-center" width="70">Target</th>
							<th class="text-center">Penanggung Jawab</th>
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
			        foreach(  $DIndikator as $keyIndikator => $indikator) : 
			        	$Dporgram =$this->mprogram->getProgramBySasaran( $indikator->id_sasaran);
			        	$PK = $this->mprogram->getPKIndikatorTargetTriwulan($indikator->id_indikator_sasaran, $this->tahun);

			        	$multipleProgram = array();
			        	foreach($Dporgram as $row)
			        		$multipleProgram[] = $row->id_program;

			        	$col1 = (count($Dporgram) + 1) + $this->mprogram->getKegiatanProgramByMultipleProgram($multipleProgram);

						$col2 = ($this->mprogram->getKegiatanProgramByMultipleProgram($multipleProgram));
			       ?>
 					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php   ?></td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $indikator->deskripsi ?></td>
						<td rowspan="<?php echo $col1 ?>" class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td rowspan="<?php echo $col1 ?>">
							T1 = <strong><?php echo @$PK->nilai_target_triwulan1 ?></strong><br>
							T2 = <strong><?php echo @$PK->nilai_target_triwulan2 ?></strong><br>
							T3 = <strong><?php echo @$PK->nilai_target_triwulan3 ?></strong><br>
							T4 = <strong><?php echo @$PK->nilai_target_triwulan4 ?></strong>
						</td>
					</tr>
			        <?php  
					/**
					 * Loop Program
					 *
					 * @var string
					 **/
					if(($col1-$col2) == 2)
						$col1 += 1;
					foreach($Dporgram as $keyProgram => $program) :
						$DKegiatan = $this->kgiatan->getKegiatanProgramByProgram($program->id_program);
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
					?>
					<tr style="<?php if($keyProgram==0) echo 'border-top: 0px !important;'; ?>">
						<td rowspan="<?php echo ($col1-$col2) ?>"><?php echo $program->deskripsi ?></td>
						<td rowspan="<?php echo ($col1-$col2) ?>"><?php echo @number_format($anggaran) ?></td>
					</tr>
					<?php
					foreach( $DKegiatan as $keyKegiatan => $kegiatan) :
						$anggKegiatan = $this->kgiatan->getAnggaranKegiatan($kegiatan->id_kegiatan, $this->tahun);
						$pjk = $this->kgiatan->getPenanggungJawabKegiatanByKegiatanTahun($kegiatan->id_kegiatan, $this->tahun);
					?>
					<tr>
						<td><?php echo $kegiatan->deskripsi ?></td>
						<td><?php echo @number_format(@$anggKegiatan->nilai_anggaran) ?></td>
						<td>
							<?php 
							$outputID = 0;
							foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) 
							{
								echo $output->deskripsi."<br>";
								$outputID = $output->id_output_kegiatan_program;
							}
							?>
						</td>
						<td>
							<?php for($triwulan = 1; $triwulan <=4; $triwulan++) 
							{
								$PKOT = $this->kgiatan->getPKOutputKegiatan($outputID, $this->tahun, "T".$triwulan);
								echo 'T'.@$triwulan.' = <strong>'.@$PKOT->nilai_target.'</strong><br>';
							}
							?>
						</td>
						<td><?php echo @$pjk->penanggung_jawab ?></td>
					</tr>
					<?php  
					endforeach;
					endforeach;
					endforeach;
					endforeach;
				    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>