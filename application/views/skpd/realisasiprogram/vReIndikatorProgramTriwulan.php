            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
				<?php  
				/**
				 * Loop All Program
				 *
				 * @var string
				 **/
				foreach($this->mprogram->getProgramByLogin() as $keProgram => $program) :
				?>
					<table class="table table-bordered">
						<thead class="bg-blue">
							<tr class="bg-blue">
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="10" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Program :</strong> <?php echo $program->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center" width="50">No.</th>			
								<th class="text-center">Indikator Kinerja Program</th>
								<th class="text-center" width="80">Satuan</th>
								<th class="text-center" width="100">Target</th>
								<th class="text-center" width="120" colspan="2">Realisasi</th>
								<th class="text-center" width="120">Capaian <sup>(%)</sup></th>
								<th class="text-center" width="200">Keterangan</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop RKT Indikator Kinerja Program
						 *
						 * @var string
						 **/
						echo form_hidden('type', 'triwulan');
						if( $this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) ) :
						foreach($this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) as $keyInd => $indikator) :
							$nilaitarget = $this->mprogram->getNilaiTargetIndikatorByIndikatorTahun($indikator->id_indikator_kinerja_program, $tahun);

							$RE = $this->mprogram->getReIndikatorProgram($indikator->id_indikator_kinerja_program, $tahun);
						?>
 							<tr>
								<td rowspan="6"><?php echo ++$keyInd ?>.</td>
								<td rowspan="6"><?php echo $indikator->deskripsi; ?></td>
								<td rowspan="6" class="text-center"><?php echo $indikator->satuan ?></td>
								<td rowspan="6" class="text-center"><?php echo @$nilaitarget ?></td>
							</tr>
							<?php  
							foreach( $this->mprogram->getReIndikatorProgramTriwulan($RE->id_reindikator_program) as $tri ) :
							?>
							<tr>
								<td><?php echo $tri->triwulan; ?></td>
								<td>
									<input type="text" name="realisasi[<?php echo @$tri->id_reindikator_program ?>]" class="form-control input-sm" value="<?php echo @$tri->realisasi ?>">
								</td>
								<td>
									<input type="text" name="capaian[<?php echo @$tri->id_reindikator_program ?>]" class="form-control input-sm" value="<?php echo @$tri->capaian ?>">
								</td>
								<td>
									<textarea name="ket[<?php echo @$tri->id_reindikator_program ?>]" class="form-control" rows="2"><?php echo @$tri->keterangan ?></textarea>
								</td>
							</tr>
							<?php  
							endforeach;
							?>
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