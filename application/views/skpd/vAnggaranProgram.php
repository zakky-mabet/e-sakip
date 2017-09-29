<div class="row">
	<?php echo form_open(base_url("skpd/program/saveanggaran")); ?>
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
			        <ul class="timeline">
			            <?php 
			            /**
			             * Loop Tujuan
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getTujuanLogin() as $keyTjuan => $tujuan) : ?>
			            <li class="time-label">
			                  <span class="bg-gray">Tujuan</span><span class="bg-blue"> <small><?php echo $tujuan->deskripsi ?></small></span>
			            </li>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getSasaranByTujuan( $tujuan->id_tujuan) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="4" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Program</th>
								<th class="text-center" width="200">Anggaran</th>
								<th class="text-center" width="250">Sumber</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop Program
						 *
						 * @var string
						 **/
						foreach($this->mprogram->getProgramBySasaran( $sasaran->id_sasaran) as $keyProgram => $program) :
							$anggaran = $this->mprogram->getAnggaranKegiatanByProgramTahun($program->id_program, $tahun);
						?>
							<tr>
								<td><?php echo ++$keyProgram ?>.</td>
								<td><?php echo $program->deskripsi; ?></td>
								<td class="text-center">Rp. <?php echo @number_format($anggaran->nilai_anggaran) ?></td>
								<td><input type="text" name="sumber[<?php echo @$program->id_program ?>][<?php echo $tahun ?>]" value="" class="form-control"></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
						</li>
				<?php  
				/* End Sasaran */
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
