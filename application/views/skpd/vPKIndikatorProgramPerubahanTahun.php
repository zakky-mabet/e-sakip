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
								<th class="text-center" width="100">Target Renstra</th>
								<th class="text-center" width="80">Target RKT</th>
								<th class="text-center" width="120">Target PK</th>
								<th class="text-center" width="120">Target Perubahan</th>
								<th class="text-center" width="200">Sebab Perubahan</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop RKT Indikator Kinerja Program
						 *
						 * @var string
						 **/
						if( $this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) ) :
						foreach($this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) as $keyInd => $indikator) :
							$nilaitarget = $this->mprogram->getNilaiTargetIndikatorByIndikatorTahun($indikator->id_indikator_kinerja_program, $tahun);
							$rkt = $this->mprogram->getRktIndikatorProgram($indikator->id_indikator_kinerja_program, $tahun);
							$PKtahun = $this->mprogram->getPKIndikatorProgram($indikator->id_indikator_kinerja_program, $tahun);
							$PKPerubahan = $this->mprogram->getPKPerubahanIndikatorProgram($indikator->id_indikator_kinerja_program, $tahun);
						?>
 							<tr>
								<td><?php echo ++$keyInd ?>.</td>
								<td><?php echo $indikator->deskripsi; ?></td>
								<td class="text-center"><?php echo $indikator->satuan ?></td>
								<td class="text-center"><?php echo @$nilaitarget ?></td>
								<td class="text-center"><?php echo @$rkt->nilai_target_rkt ?></td>
								<td class="text-center"><?php echo @$PKtahun->nilai_target ?></td>
								<td>
									<input type="text" name="target[<?php echo @$PKPerubahan->id_pk_program_perubahan ?>]" class="form-control input-sm" value="<?php echo (@$PKPerubahan->nilai_target != '') ? @$PKPerubahan->nilai_target : @$PKtahun->nilai_target ?>">
								</td>
								<td class="text-center">
									<textarea name="sebab[<?php echo @$PKPerubahan->id_pk_program_perubahan ?>]" rows="2" class="form-control"><?php echo @$PKPerubahan->sebab ?></textarea>
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