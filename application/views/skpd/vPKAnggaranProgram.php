<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(current_url()); ?>
	<div class="col-md-10">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<li class="<?php if($this->tahun==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			            <?php 
			            /**
			             * Loop Tujuan
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getTujuanLogin() as $keySasaran => $tujuan) : ?>
			            <li class="time-label">
			                  <span class="bg-gray">Tujuan</span><span class="bg-blue"> <small><?php echo $tujuan->deskripsi ?></small></span>
			            </li>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getSasaranByTujuan($tujuan->id_tujuan) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="8" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th rowspan="2" class="text-center">No.</th>
								<th rowspan="2" class="text-center">Program</th>
								<th colspan="3" class="text-center" width="300">Anggaran <?php echo $tahun ?></th>
							</tr>
							<tr>
								<th class="text-center" width="170">RENSTRA</th>
								<th class="text-center" width="170">RKT</th>
								<th class="text-center" width="170">PK</th>
							</tr>	
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop Program
						 *
						 * @var string
						 **/
						foreach( $this->mprogram->getProgramBySasaran($sasaran->id_sasaran) as $keyProgram => $program) :
							$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
							$rkt = $this->mprogram->getRktAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
							$PK = $this->mprogram->getPKAnggaranProgram($program->id_program, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyProgram ?>.</td>
								<td><?php echo $program->deskripsi; ?></td>
								<td class="text-center"><?php echo @number_format($anggaran) ?></td>
								<td class="text-center"><?php echo number_format( @$rkt->anggaran_rkt) ?></td>
								<td>
									<input type="text" name="anggaran[<?php echo @$PK->nilai_anggaran ?>]" class="form-control input sm" value="<?php echo @number_format(@$PK->nilai_anggaran) ?>" disabled>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
						</li>
				<?php  
				/* End Program */
				endforeach;
				/* End Tujuan */
				endforeach;
				?>
					</ul>
				</div>
			<?php endfor; ?>
            </div>
		</div>
	</div>
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
   <?php echo form_close(); ?>
</div>
