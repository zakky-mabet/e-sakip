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
								<th class="text-center" width="100">Target Renstra</th>
								<th class="text-center" width="80">Target RKT</th>
								<th class="text-center" width="120">Target PK</th>
								<th class="text-center" width="200">Sebab Perubahan</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop  PK Output Kegiatan
						 *
						 * @var string
						 **/
						if( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) ) :
							foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) :
						 	$targetOutput = $this->kgiatan->getTargetOutputByKegiatanProgram($output->id_output_kegiatan_program, $tahun);
						 	$rkt = $this->kgiatan->getRktOutputKegiatan($output->id_output_kegiatan_program, $tahun);
						 	$PKTahun = $this->kgiatan->getPKOutputKegiatan($output->id_output_kegiatan_program, $tahun);
						?>
 							<tr>
								<td><?php echo ++$keyOutput ?>.</td>
								<td><?php echo $output->deskripsi ?></td>
								<td class="text-center"><?php echo $output->nama_satuan ?></td>
								<td class="text-center"><?php echo @$targetOutput->target ?></td>
								<td class="text-center"><?php echo @$rkt->nilai_target_rkt ?></td>
								<td>
									<input type="text" name="target[<?php echo @$PKTahun->id_ouput_pk ?>]" class="form-control input-sm" value="<?php echo @$PKTahun->nilai_target ?>">
								</td>
								<td class="text-center">
									<textarea name="sebab[<?php echo @$PKTahun->id_ouput_pk ?>]" rows="2" class="form-control"><?php echo @$PKTahun->sebab ?></textarea>
								</td>
							</tr>
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