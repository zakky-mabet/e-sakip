<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Rencana Strategis  </h4>
					<p style="margin-left: 23px;">Periode <?php echo $this->periode_awal.'-'.$this->periode_akhir ?></p>
				</div>
				<div class="col-md-3 pull-right">
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
			<div class="clearfix"></div>
		</div>
		<div class="box no-border">
			<div class="box-body no-padding">
				<table class="table">
					<tbody>
						<tr>
							<td><strong>Visi</strong></td>
							<td width="50" class="text-center">:</td>
							<td><strong>"<?php echo $visi->deskripsi ?>"</strong></td>
						</tr>
						<tr>
							<td><strong>Misi</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->tjuan->getMisiLogin() as $key => $misi)
									echo '<li>'.$misi->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
						<tr>
							<td><strong>Strategi</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->mstrategi->getStrategiByLogin() as $key => $strategi)
									echo '<li>'.$strategi->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
						<tr>
							<td><strong>Kebijakan</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->kbjakan->getKebijakanByLogin() as $key => $kebijakan)
									echo '<li>'.$kebijakan->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="mini-font table table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th rowspan="2" class="text-center" valign="top">No.</th>
							<th rowspan="2" class="text-center" valign="top">Tujuan</th>
							<th rowspan="2" colspan="2" class="text-center" valign="top">Sasaran</th>
							<th rowspan="2" class="text-center" colspan="2">Indikator Kinerja</th>
							<th rowspan="2" class="text-center">Satuan</th>
							<th colspan="5" class="text-center">Target Per Tahun</th>
						</tr>
						<tr>
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
							echo '<th class="text-center">'.$tahun.'</th>';
						?>
						</tr>
					</thead>
					<tbody>
			            <?php 
			            /**
			             * Loop Tujuan
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getTujuanLogin() as $keyTujuan => $tujuan) : 
			            	$DSasaran = $this->tjuan->getSasaranByTujuan($tujuan->id_tujuan);
			            	$DIndikator = $this->tjuan->getInodikatorSasaranBySasaran($DSasaran[0]->id_sasaran);

			            $col2 = (count($DIndikator)+1);
			            $col1 = (count($DSasaran)+1) + $col2;
			            if( $col2 >= 2 )
			            	$col1--;
			            ?>
						<tr>
							<td rowspan="<?php echo $col1 ?>"><?php echo ++$keyTujuan; ?>.</td>
							<td rowspan="<?php echo $col1 ?>"><?php echo $tujuan->deskripsi; ?></td>
						</tr>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $DSasaran as $keySasaran => $sasaran) : 
			            ?>
						<tr>
							<td rowspan="<?php echo $col2; ?>"><?php echo $keyTujuan.".".++$keySasaran ?></td>
							<td rowspan="<?php echo $col2; ?>"><?php echo $sasaran->deskripsi ?></td>
						</tr>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $DIndikator as $keyIndikator => $indikator) : 
			            ?>
						<tr>
							<td><?php echo $keyTujuan.".".$keySasaran.".".++$keyIndikator; ?>.</td>
							<td><?php echo $indikator->deskripsi ?></td>
							<td class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) :
							$target = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $tahun);
						?>
							<td class="text-center"><?php echo @$target->nilai_target ?></td>
						<?php endforeach; ?>
						</tr>
			            <?php  
			            // end indikator
			        	endforeach;
			        	// end sasaran
						endforeach;
						// end tujuan 
						endforeach;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>