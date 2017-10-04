            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
		            <?php 
		            /**
		             * Loop Kegiatan
		             *
		             * @var string
		             **/
		            foreach(  $this->kgiatan->getKegiatanProgramByLogin() as $key => $kegiatan) : ?>
					<table class="table table-bordered">
						<thead class="bg-blue">
							<tr class="bg-blue">
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="10" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Program :</strong> <?php echo $kegiatan->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center" width="50">No.</th>			
								<th class="text-center">Output Kegiatan</th>
								<th class="text-center" width="80">Satuan</th>
								<th class="text-center" width="100">Target</th>
								<th class="text-center" colspan="2">Realisasi</th>
								<th class="text-center" width="100">Capaian (%)</th>
								<th class="text-center" width="200">Keterangan</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop  PK Output Kegiatan
						 *
						 * @var string
						 **/
						echo form_hidden('type', 'triwulan');
						if( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) ) :
							foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) :
						 	$targetOutput = $this->kgiatan->getTargetOutputByKegiatanProgram($output->id_output_kegiatan_program, $tahun);
						 	$REO = $this->kgiatan->getReOutputKegiatan($output->id_output_kegiatan_program, $tahun);
						?>
 							<tr>
								<td rowspan="5"><?php echo ++$keyOutput ?>.</td>
								<td rowspan="5"><?php echo $output->deskripsi ?></td>
								<td rowspan="5" class="text-center"><?php echo $output->nama_satuan ?></td>
								<td rowspan="5" class="text-center"><?php echo @$targetOutput->target ?></td>
							</tr>
							<?php  
							foreach( $this->kgiatan->getReOutputKegiatanTriwulan($REO->id_reoutput_kegiatan) as $tri ) :
							?>
							<tr>
								<td><?php echo $tri->triwulan; ?></td>
								<td width="100">
									<input type="text" name="realisasi[<?php echo @$tri->id_reoutput_kegiatan ?>]" class="form-control input-sm" value="<?php echo @$tri->realisasi ?>">
								</td>
								<td>
									<input type="text" name="capaian[<?php echo @$tri->id_reoutput_kegiatan ?>]" class="form-control input-sm" value="<?php echo @$tri->capaian ?>">
								</td>
								<td>
									<textarea name="ket[<?php echo @$tri->id_reoutput_kegiatan ?>]" class="form-control" rows="2"><?php echo @$tri->keterangan ?></textarea>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php  
						endforeach;
						else :
						?>
							<tr>
								<td colspan="12" class="text-center">
									<strong>Maaf!</strong> Data indikator Program belum tersedia
								</td>
							</tr>
						<?php endif; ?>
						</tbody>
					</table>
				<?php  
				endforeach;
				?>
				</div>
			<?php endfor; ?>