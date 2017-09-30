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

							echo form_hidden('type', 'triwulan');
						?>
 							<tr>
								<td rowspan="5"><?php echo ++$keyInd ?>.</td>
								<td rowspan="5"><?php echo $indikator->deskripsi; ?></td>
								<td rowspan="5" class="text-center"><?php echo $indikator->satuan ?></td>
								<td rowspan="5" class="text-center"><?php echo $nilaitarget ?></td>
								<td rowspan="5" class="text-center"><?php echo @$rkt->nilai_target_rkt ?></td>
							</tr>
							<?php for($triwulan = 1; $triwulan <=4; $triwulan++) : 
							$PKtahun = $this->mprogram->getPKIndikatorProgram($indikator->id_indikator_kinerja_program, $tahun, "T".$triwulan);
							?>
							<tr>
								<td>
									<small>Triwulan <?php echo $triwulan ?></small>
									<input type="text" name="target[<?php echo @$PKtahun->id_pk_program ?>]" class="form-control input-sm" value="<?php echo @$PKtahun->nilai_target ?>">
								</td>
								<td class="text-center">
									<textarea name="sebab[<?php echo @$PKtahun->id_pk_program ?>]" rows="2" class="form-control"><?php echo @$PKtahun->sebab ?></textarea>
								</td>
							</tr>
							<?php endfor; ?>
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