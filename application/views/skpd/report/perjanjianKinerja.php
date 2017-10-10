<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Perjanjian Kinerja  </h4>
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
						<a href="<?php echo current_url().'?output=print'; ?>" target="_blank" class="btn btn-default btn-print">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?php echo current_url().'?output=pdf'; ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<!-- <a href="<?php echo current_url().'?output=excel'; ?>" target="_blank" class="btn btn-default">
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
				<div class="col-md-12">
					<p class="text-center"><strong>PERJANJIAN KINERJA </strong></p>
					<table class="bottom2x">
						<tr>
							<th>SKPD</th>
							<th class="text-center" width="30">:</th>
							<th><?php echo strtoupper($this->session->userdata('SKPD')->nama) ?></th>
						</tr>
						<tr>
							<th>TAHUN ANGGARAN</th>
							<th class="text-center" width="30">:</th>
							<th><?php echo $this->tahun ?></th>
						</tr>
					</table>
				</div>
				<table class="table table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">NO.</th>	
							<th class="text-center">SASARAN STRATEGIS</th>
							<th class="text-center">INDIKATOR KINERJA</th>
							<th class="text-center">SATUAN</th>
							<th class="text-center">TARGET</th>
						</tr>
						<tr>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
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
				<table class="table table-responsive table-bordered top2x">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">NO.</th>	
							<th class="text-center">PROGRAM</th>
							<th class="text-center">ANGGARAN (Rp.)</th>
							<th class="text-center">SUMBER</th>
						</tr>
					</thead>
					<tbody>
		            <?php 
		            /**
		             * Loop Kegiatan
		             *
		             * @var string
		             **/
		            $totalAngg = 0;
		            foreach(  $this->mprogram->getProgramByLogin() as $key => $program) : 
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
						$sumber = $this->mprogram->getSumberAnggaranProgram($program->id_program, $this->tahun);
		            	?>
					<tr>
						<td><?php echo ++$key; ?></td>
						<td><?php echo $program->deskripsi ?></td>
						<td class="text-center"><?php echo @number_format($anggaran) ?></td>
						<td><?php echo @$sumber->sumber_anggaran; ?></td>
					</tr>
		            <?php  
		            $totalAngg += @$anggaran;
		            endforeach;
		            ?>
		            <tr>
		            	<td colspan="2"><strong class="pull-right">Total :</strong></td>
		            	<td colspan="2"><?php echo number_format($totalAngg) ?></td>
		            </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>