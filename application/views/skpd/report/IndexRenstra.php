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
					<p><strong>Rencana Strategis  (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<div class="pad">
				<table>
					<tbody>
						<tr>
							<td width="60"><strong>Visi</strong></td>
							<td width="30" class="text-center">:</td>
							<td><strong>"<?php echo $visi->deskripsi ?>"</strong></td>
						</tr>
						<tr>
							<td><strong>Misi</strong></td>
							<td class="text-center">:</td>
							<td style="vertical-align: top">
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
							<td style="vertical-align: top">
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
				</div>
				<table class="mini-font table table-bordered">
						<tr class="bg-blue">
							<th rowspan="2" class="text-center" valign="top">No.</th>
							<th rowspan="2" class="text-center" valign="top">Tujuan</th>
							<th rowspan="2" colspan="2" class="text-center" valign="top">Sasaran</th>
							<th rowspan="2" class="text-center" colspan="2">Indikator Kinerja</th>
							<th rowspan="2" class="text-center">Satuan</th>
							<th colspan="5" class="text-center">Target Per Tahun</th>
						</tr>
						<tr class="bg-blue">
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
							echo '<th class="text-center">'.$tahun.'</th>';
						?>
						</tr>

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
				</table>
			</div>
		</div>
	</div>
</div>