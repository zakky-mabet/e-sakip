<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(base_url("skpd/program/saveanggaran")); ?>
	<div class="col-md-12">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<li class="<?php if($this->periode_awal==$tahun) echo 'active'; ?>">
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
				<div class="tab-pane <?php if($this->periode_awal==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mprogram->getSasaranByLogin() as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50"><?php echo $tahun ?></th>
								<td colspan="9" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo ++$key.". ". $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th rowspan="2" class="text-center">No.</th>
								<th rowspan="2" colspan="2" class="text-center">Program / Kegiatan</th>
								<th rowspan="2" class="text-center">Anggaran PK Tahun <?php echo $tahun ?></th>
								<th class="text-center" colspan="4">Penyerapan Tahun <?php echo $tahun ?></th>
							</tr>
							<tr>
							<?php foreach(range(1, 4) as $tri => $tTahun)
									echo '<td class="text-center">T'.++$tri.'</td>';
							 ?>
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
						?>
							<tr>
								<td><?php echo $key.".".++$keyProgram ?></td>
								<td colspan="8"><?php echo $program->deskripsi; ?></td>
							</tr>
					        <?php 
					        foreach( $this->kgiatan->getKegiatanProgramByProgram($program->id_program) as $keyKegiatan => $kegiatan) :
					        	$PK = @$this->kgiatan->getPKAnggaranProgram($kegiatan->id_kegiatan, $tahun);
					        ?>
							<tr>
								<td></td>
								<td width="40"><?php echo $key.".".$keyProgram.".".++$keyKegiatan ?></td>
								<td><?php echo $kegiatan->deskripsi ?></td>
								<td class="text-center">Rp. <?php echo @number_format(@$PK->nilai_anggaran) ?></td>
							<?php foreach(range(1, 4) as $tri => $tTahun) : 
							$REA = $this->kgiatan->getReAnggaranKegiatan($kegiatan->id_kegiatan, $tahun, "T".++$tri);
							?>
								<td width="120">
									<input type="text" name="sumber" class="form-control input-sm inputmask" 
									value="<?php echo @number_format(@$REA->nilai_anggaran) ?>"
									data-id="<?php echo @$REA->id_reanggaran_kegiatan ?>"
									<?php if(!$REA) echo 'disabled' ?>>
								</td>
							<?php endforeach; ?>
							</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
						</li>
				<?php  
				/* End Sasaran */
				endforeach;
				?>
					</ul>
				</div>
			<?php endfor; ?>
            </div>
		</div>
	</div>
<!--    	<div class="col-md-2 top50x">
	<div id="stickerButton100x">
		<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div> -->
   <?php echo form_close(); ?>
</div>
