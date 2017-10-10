<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(base_url("skpd/pkperubahanprogram/savepkanggaran")); ?>
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
								<th colspan="5" class="text-center">Anggaran <?php echo $tahun ?></th>
							</tr>
							<tr>
								<th class="text-center" width="130">RENSTRA</th>
								<th class="text-center" width="130">RKT</th>
								<th class="text-center" width="130">PK</th>
								<th class="text-center" width="130">PK Perubahan</th>
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
							$rkt = $this->kgiatan->getTotalRktAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
							$PK = @$this->kgiatan->getTotalPKAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
							$PKPerubahan = $this->kgiatan->getPKPerubahanAnggaranProgram($kegiatan->id_kegiatan, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyKegiatan ?>.</td>
								<td><?php echo $program->deskripsi; ?></td>
								<td class="text-center"><?php echo @number_format(@$anggaran) ?></td>
								<td class="text-center"><?php echo @number_format( @$rkt) ?></td>
								<td class="text-center"><?php echo @number_format(@$PK) ?></td>
								<td>
									<input type="text" name="anggaran[<?php echo @$PKPerubahan->id_pk_anggaran_kegiatan_perubahan ?>]" class="form-control input-sm inputmask" value="<?php echo @number_format($PKPerubahan->nilai_anggaran) ?>">
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
		<div id="stickerButton100x" class="text-center">
			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
   <?php echo form_close(); ?>
</div>
