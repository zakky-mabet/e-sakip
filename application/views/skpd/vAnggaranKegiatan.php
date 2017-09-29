<div class="row">
	<?php echo form_open(base_url("skpd/kegiatan/saveanggaran")); ?>
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
                  		Kegiatan <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                  <li class="<?php echo active_link_method('index','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan"); ?>"> Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('penanggungjawab','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/penanggungjawab/{$this->periode_awal}"); ?>"><small>Penanggung Jawab Kegiatan</small></a>
                  </li>
                  <li class="<?php echo active_link_method('anggaran','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/anggaran/{$this->periode_awal}"); ?>">Anggaran Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('output','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/output"); ?>">Output Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('target','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/target/{$this->periode_awal}"); ?>">Target Output Kegiatan</a>
                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mprogram->getSasaranByLogin() as $keySasaran => $sasaran) : ?>
			            <li class="time-label">
			                  <span class="bg-gray">Sasaran</span><span class="bg-blue"> <small><?php echo $sasaran->deskripsi ?></small></span>
			            </li>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $this->mprogram->getProgramBySasaran($sasaran->id_sasaran) as $key => $program) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="4" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Program :</strong> <?php echo $program->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Kegiatan</th>
								<th class="text-center" width="250">Nilai Anggaran</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop Kegiatan
						 *
						 * @var string
						 **/
						foreach($this->kgiatan->getKegiatanProgramByProgram( $program->id_program ) as $keyKegiatan => $kegiatan) :
							$ang = $this->kgiatan->getAnggaranKegiatan($kegiatan->id_kegiatan, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyKegiatan ?>.</td>
								<td><?php echo $kegiatan->deskripsi; ?></td>
								<td><input type="text" name="anggaran[<?php echo @$ang->id_anggaran_kegiatan ?>]" value="<?php echo number_format(@$ang->nilai_anggaran) ?>" class="form-control inputmask"></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
						</li>
				<?php  
				/* End Program */
				endforeach;
				/* End Sasaran */
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
