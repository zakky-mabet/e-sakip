<div class="row">
	<?php echo form_open(base_url("skpd/realisasi_sasaran/save")); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading">Data Program dan Kegiatan Tahun <?php echo $tahun ?></h4>
					<h5 class="box-heading">
						<b>Sasaran </b> : <?php echo $get_sasaran_program_dan_kegiatan->deskripsi ?>		
					</h5>
				</div>
				<div class="col-md-6 text-right">
					<div class="btn-group">
	                  <button type="button" class="btn btn-info">Pilih Tahun</button>
	                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
	                    <span class="caret"></span>
	                    <span class="sr-only">Toggle Dropdown</span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
						<?php for($tahun_btn = $this->mrealisasi_sasaran->periode_awal; $tahun_btn <= $this->mrealisasi_sasaran->periode_akhir; $tahun_btn++) : ?>

	                    	<li><a href="<?php echo site_url('skpd/realisasi_sasaran/program_dan_kegiatan/'.$param.'/'.$tahun_btn) ?>"><?php echo $tahun_btn ?></a></li>

						<?php endfor ?>	
					
	                  </ul>
	                </div>
				</div>
              
			</div>
			<div class="box-body">
					<?php
					
					 foreach ($this->mrealisasi_sasaran->get_sasaran_program($get_sasaran_program_dan_kegiatan->id_sasaran) as $key => $program): 
					?>
					<table class="table table-bordered bg-white">
						<tr>
							<th class="text-center bg-blue">No.</th>
							<th class="text-center bg-blue" colspan="2">Program</th>
							<th class="text-center bg-blue">Anggaran</th>
							<th class="text-center bg-blue">Penyerapan</th>
						</tr>
				
				 		<tr>
							<td style="vertical-align: middle;" class="text-center"><?php echo ++$key ?></td>
							<td colspan="2"><?php echo $program->deskripsi ?></td>
							<td style="vertical-align: middle;" class="text-center"><?php echo number_format($this->mrealisasi_sasaran->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $tahun), 0, '.', '.'); ?></td>
							<td style="vertical-align: middle;" class="text-center">
								<?php echo number_format($this->mrealisasi_sasaran->program_penyerapan_per_kegiatan($program->id_program, $tahun), 0, '.', '.');
								 ?>
							</td>
						</tr>

				 		<tr style="font-weight: 600;">
							<td rowspan="10000"></td>
							<td style="vertical-align: middle; " class="text-center bg-yellow">No</td>
							<td style="vertical-align: middle;" class="text-center bg-yellow">Kegiatan</td>
							<td style="vertical-align: middle;" class="text-center bg-yellow">Anggaran</td>
							<td style="vertical-align: middle;" class="text-center bg-yellow">Penyerapan</td>
						</tr>
					<?php foreach ($this->mrealisasi_sasaran->get_sasaran_kegiatan($program->id_program, $tahun) as $key => $kegiatan): 
					?>			
							
						<tr>
							 <td class="text-center" style="vertical-align: middle;"><?php echo ++$key ?></td>
							 <td style="vertical-align: middle;"><?php echo $kegiatan->deskripsi ?></td>
							 <td class="text-center " style="vertical-align: middle;"><?php echo number_format($kegiatan->nilai_anggaran, 0, '.', '.'); ?></td>
							 <td class="text-center" style="vertical-align: middle;">
							 	<?php echo number_format($this->mrealisasi_sasaran->penyerapan_per_kegiatan($kegiatan->id_kegiatan, $tahun), 0, '.', '.');  ?>
							 </td>
				 		</tr>
						<tr>
							<td class="text-center" style="vertical-align: middle;">Output</td>
							<td colspan="3">
								<textarea class="form-control" name=""></textarea>
							</td>
				 		</tr>

					<?php endforeach ?>
					</table>	
					<?php endforeach ?>

		
				
		</div>
	</div>		
</div>
	<?php echo form_close(); ?>
</div>



								
			