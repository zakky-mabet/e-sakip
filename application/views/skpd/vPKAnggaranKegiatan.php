<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(base_url("skpd/pkprogram/savepkanggaran")); ?>
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
				 * Loop All Program
				 *
				 * @var string
				 **/
				foreach($this->mprogram->getProgramByLogin() as $keProgram => $program) :
				?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="8" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Program :</strong> <?php echo $program->deskripsi ?></td>
							</tr>
							<tr>
								<th rowspan="2" class="text-center">No.</th>
								<th rowspan="2" class="text-center">Kegiatan</th>
								<th colspan="3" class="text-center" width="300">Anggaran <?php echo $tahun ?></th>
								<th rowspan="2" class="text-center"> Sebab Perubahan</th>	
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
						foreach( $this->kgiatan->getKegiatanProgramByProgram($program->id_program) as $keyKegiatan => $kegiatan) :
							$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
							$rkt = $this->mprogram->getRktAnggaranKegiatanByProgramTahun($kegiatan->id_kegiatan, $tahun);
							$PK = $this->kgiatan->getPKAnggaranProgram($kegiatan->id_kegiatan, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyKegiatan ?>.</td>
								<td><?php echo $kegiatan->deskripsi; ?></td>
								<td class="text-center"><?php echo @number_format($anggaran) ?></td>
								<td><?php echo number_format( @$rkt->anggaran_rkt) ?></td>
								<td>
									<input type="text" name="anggaran[<?php echo @$PK->id_pk_anggaran_kegiatan ?>]" class="form-control inputmask" value="<?php echo @$PK->nilai_anggaran ?>" <?php if(!$PK) echo 'disabled' ?>>
								</td>
								<td>
									<textarea name="sebab[<?php echo @$PK->id_pk_anggaran_kegiatan ?>]" rows="2" class="form-control" <?php if(!$PK) echo 'disabled' ?>><?php echo @$PK->sebab ?></textarea>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
						</li>
				<?php  
				/* End Program */
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
