<div class="row">
	<?php echo form_open(base_url("skpd/rktprogram/saverktoutputkegiatan")); ?>
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
					<h4>Tahun : <strong><?php echo $tahun ?></strong></h4>
		            <?php 
		            /**
		             * Loop Kegiatan
		             *
		             * @var string
		             **/
		            foreach(  $this->kgiatan->getKegiatanProgramByLogin() as $key => $kegiatan) : ?>
					<table class="table table-bordered">
						<thead>
							<tr style="color: black" class="bg-silver">
								<td colspan="6" width="100"><strong>Kegiatan :</strong> <?php echo $kegiatan->deskripsi ?></td>
							</tr>
							<tr class="bg-blue">
								<th class="text-center" width="50">No.</th>			
								<th class="text-center">Output</th>
								<th class="text-center" width="100">Satuan</th>
								<th class="text-center" width="120">Target Renstra</th>
								<th class="text-center" width="150">Target RKT</th>
								<th class="text-center" width="250">Sebab Perubahan</th>
							</tr>

						</thead>
						<tbody>
						<?php  
						/**
						 * Loop RKT Indikator Kinerja Program
						 *
						 * @var string 
						 **/
						if( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) ) :
							foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) :
						 	$targetOutput = $this->kgiatan->getTargetOutputByKegiatanProgram($output->id_output_kegiatan_program, $tahun);
						 	$rkt = $this->kgiatan->getRktOutputKegiatan($output->id_output_kegiatan_program, $tahun);
						?>
 							<tr>
								<td><?php echo ++$keyOutput ?>.</td>
								<td><?php echo $output->deskripsi ?></td>
								<td class="text-center"><?php echo $output->nama_satuan ?></td>
								<td class="text-center"><?php echo @$targetOutput->target ?></td>
								<td>
									<input type="text"  name="target[<?php echo @$rkt->rkt_id_output_kegiatan ?>]" value="<?php echo @$rkt->nilai_target_rkt ?>" class="form-control">
								</td>
								<td>
									<textarea name="sebab[<?php echo @$rkt->rkt_id_output_kegiatan ?>]" rows="2" class="form-control"><?php echo @$rkt->sebab ?></textarea>
								</td>
							</tr>
						<?php  
						endforeach;
						else :
						?>
							<tr>
								<td colspan="6" class="text-center">
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
