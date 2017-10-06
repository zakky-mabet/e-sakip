<div class="row">
	<?php echo form_open(base_url("skpd/program/savenilaitarget")); ?>
	<div class="col-md-10">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<li class="<?php if($this->tahun==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
				<li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		Program <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program") ?>"> Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('anggaran','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/anggaran/{$this->periode_awal}") ?>">Anggaran Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('indikator','program'); ?>">
	                    <a href="<?php echo base_url('skpd/program/indikator'); ?>">Indikator Kinerja Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('target','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/target") ?>">Target Indikator Kinerja Program</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
					<h4>Tahun : <strong><?php echo $tahun ?></strong></h4>
				<?php  
				/**
				 * Loop All Program
				 *
				 * @var string
				 **/
				foreach($this->mprogram->getProgramByLogin() as $keProgram => $program) :
				?>
					<table class="table table-bordered">
						<thead>
							<tr style="color: black" class="bg-silver">
								<td colspan="4" width="100"><strong>Program :</strong> <?php echo $program->deskripsi ?></td>
							</tr>
							<tr class="bg-blue">
								<th class="text-center" width="50">No.</th>			
								<th rowspan="" class="text-center">Indikator Kinerja Program</th>
								<th rowspan="" class="text-center" width="200">Satuan</th>
								<th rowspan="" class="text-center" width="250">Target</th>
							</tr>

						</thead>
						<tbody>
						<?php  
						/**
						 * Loop Indikator Kinerja Program
						 *
						 * @var string
						 **/
						if( $this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) ) :
						foreach($this->mprogram->getIndikatorKinerjaProgram($program->id_program, $tahun) as $keyInd => $indikator) :
							$nilaitarget = $this->mprogram->getNilaiTargetIndikatorByIndikatorTahun($indikator->id_indikator_kinerja_program, $tahun);
						?>
 							<tr>
								<td><?php echo ++$keyInd ?>.</td>
								<td><?php echo $indikator->deskripsi; ?></td>
								<td class="text-center"><?php echo $indikator->satuan ?></td>
								<td>
									<input type="text"  name="target[<?php echo $indikator->id_indikator_kinerja_program ?>][<?php echo $tahun ?>]" value="<?php echo $nilaitarget ?>" class="form-control">
								</td>
							</tr>
						<?php  
						endforeach;
						else :
						?>
							<tr>
								<td colspan="4" class="text-center">
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
            </div>
		</div>
	</div>
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x" class="text-center">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
   	<?php echo form_close(); ?>
</div>
