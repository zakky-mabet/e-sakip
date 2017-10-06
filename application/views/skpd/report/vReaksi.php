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
					<p><strong>Rencana Rencana Aksi  (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class="mini-font table table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">No.</th>	
							<th class="text-center">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center" width="100">Target</th>
							<th class="text-center">Program</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center">Kegiatan</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center">Output Kegiatan</th>
							<th class="text-center">Target</th>
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
			        	$col2 = (count($Dporgram) + 1);
			       ?>
 					<tr>
						<td rowspan="<?php echo $col2 ?>"><?php echo $col2 ?></td>
						<td rowspan="<?php echo $col2 ?>"><?php echo $indikator->deskripsi ?></td>
						<td rowspan="<?php echo $col2 ?>" class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td rowspan="<?php echo $col2 ?>">
						<?php for($triwulan = 1; $triwulan <=4; $triwulan++) : 
						$PKtahun = $this->mprogram->getPKIndikatorProgram($indikator->id_indikator_sasaran, $this->tahun, "T".$triwulan);
						?>
							Triwulan : <?php echo @$target->nilai_target ?><br>
						<?php endfor; ?>
						</td>
					</tr>
			        <?php  
					/**
					 * Loop Program
					 *
					 * @var string
					 **/
					$totalPAngg = 0;
					foreach($Dporgram as $keyProgram => $program) :
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
					?>
					<tr>
						<td><?php echo $program->deskripsi ?></td>
						<td><?php echo @number_format(@$anggaran) ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php  
					$totalPAngg += $anggaran;
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