<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(base_url("skpd/kegiatan/savatargetoutput")); ?>
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
			            <?php 
			            /**
			             * Loop Kegiatan
			             *
			             * @var string
			             **/
			            foreach(  $this->kgiatan->getKegiatanProgramByLogin() as $key => $kegiatan) : ?>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="4" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Kegiatan :</strong> <?php echo $kegiatan->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Kegiatan</th>
								<th class="text-center" width="250">Target</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop Kegiatan
						 *
						 * @var string
						 **/
						foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) :
							$target = $this->kgiatan->getTargetOutputByKegiatanProgram($kegiatan->id_kegiatan, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyOutput ?>.</td>
								<td><?php echo $output->deskripsi ?></td>
								<td><input type="text" name="target[<?php echo @$target->id_target_output ?>]" value="<?php echo @$target->target ?>" class="form-control" <?php if($target==FALSE) echo 'desabled'; ?>></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php  
				/* End Kegiatan */
				endforeach;
				?>
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
