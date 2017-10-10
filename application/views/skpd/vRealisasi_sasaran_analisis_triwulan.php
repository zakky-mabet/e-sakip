<div class="row">
	<?php echo form_open(base_url("skpd/realisasi_sasaran/save_analisis_triwulan/".$id_sasaran.'/'.$tahun.'/'.$triwulan)); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-12">

		<?php if (count($this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)) == 0): ?>
			<div class="col-md-6 col-md-offset-3" style="margin-top: 40px;">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Maaf !</strong> Data Tidak Tersedia !
				</div>
			</div>
		
		<?php else: ?>
		<div class="box">
	        <div class="box-header with-border">
	        	<h5 class="bold">Analisis Pencapaian Sasaran : <?php echo $this->mrealisasi_sasaran->get_sasaran_for_analisis_triwulan($id_sasaran)->deskripsi ?> Tahun <?php echo $tahun ?> Triwulan <?php if ($triwulan == 'T1') { echo '1';}  elseif ($triwulan == 'T2') { echo '2'; } elseif ($triwulan == 'T3') { echo '3'; } elseif ($triwulan == 'T4') { echo '4'; }?></h5>

	        </div>
	        <div class="box-body">	         
			<!-- tabs -->
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs" style="width: 160px; ">
					<li class="active"><a href="#1" data-toggle="tab">Penjelasan Umum Sasaran dan Indikator</a></li>
					<li><a href="#2" data-toggle="tab">Instrumen / Cara Pengukuran Indikator</a></li>
					<li><a href="#3" data-toggle="tab">Kinerja Nyata VS Rencana</a></li>
					<li><a href="#4" data-toggle="tab">Kinerja Nyata Dengan Tahun Sebelumnya</a></li>
					<li><a href="#5" data-toggle="tab">Perbadingan Kinerja Dengan Kinerja Instansi lainnya</a></li>
					<li><a href="#6" data-toggle="tab">Output Program / Kegiatan / Anggaran</a></li>
					<li><a href="#7" data-toggle="tab">Faktor Pendukung</a></li>
					<li><a href="#8" data-toggle="tab">Faktor Penghambat</a></li>
					<li><a href="#9" data-toggle="tab">Solusi</a></li>
					
				</ul>
				<div class="tab-content">
					<!-- tab 1 -->
					<div class="tab-pane active" id="1">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Penjelasan Umum Sasaran dan Indikator, serta relevansi dan kecukupan untuk mengukur pencapaian sasaran</a></h3>
									<?php echo form_hidden("update_analisis[ID][]", $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan); ?>	
					                <div class="timeline-body">
					                  <textarea name="update_analisis[penjelasan_umum][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->penjelasan_umum ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 2 -->
					<div class="tab-pane " id="2">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Penjelasan Tentang Instrumen / Cara Pengukuran Indikator</a></h3>

					                <div class="timeline-body">
	
					                <table class="table table-bordered table-hover">
					                	<thead>
					                		<tr class="bg-blue">
					                			<th class="text-center" style="vertical-align: middle;">No</th>
					                			<th class="text-center" style="vertical-align: middle;">Indikator</th>
					                			<th class="text-center" style="vertical-align: middle;">Satuan</th>
					                			<th class="text-center" style="vertical-align: middle;">IKU</th>
					                		</tr>
					                	</thead>
					                	<tbody>

					                	<?php foreach ($this->mrealisasi_sasaran->cara_ukur_indikator($id_sasaran) as $key => $value): ?>
					                		
					                		<tr>
					                			<td class="text-center" style="vertical-align: middle;"><?php echo ++$key; ?></td>
					                			<td style="vertical-align: middle;"><?php echo $value->deskripsi ?></td>
					                			<td class="text-center" style="vertical-align: middle;"><?php echo $this->mrkt->getsatuan($value->id_satuan)->nama ?></td>
					                			<td class="text-center" style="vertical-align: middle;"><?php if ($value->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?></td>
					                		</tr>
					                		<tr>
					                			<td class="text-center" style="vertical-align: middle;">Formulasi</td>
					                			<td colspan="3" style="vertical-align: middle;"> <?php echo $value->cara_pengukuran ?></td>
					                		</tr>

					                		<?php endforeach ?>
					                	</tbody>
					                </table>

					                  <textarea name="update_analisis[instrumen][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->instrumen ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div>

					<!-- tab 3 -->
					<div class="tab-pane" id="3">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Kinerja Nyata Dengan Kinerja Yang Direncanakan</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[kerja_nyata_vs_rencana][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->kerja_nyata_vs_rencana ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 4 -->
					<div class="tab-pane" id="4">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Kinerja Nyata Dengan Tahun Sebelumnya</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[kerja_nyata_tahun_sebelum][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  		<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->kerja_nyata_tahun_sebelum ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 5 -->
					<div class="tab-pane" id="5">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Perbadingan Kinerja Dengan Kinerja Instansi lainnya/Kota lainnya/Tingkat Nasional/Internasional</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[perbandingan][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->perbandingan ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 6 -->
					<div class="tab-pane" id="6">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Output Program / Kegiatan / Anggaran serta pernyataan keberhasilan/kegagalan Program/Kegiatan dalam menunjang pencapaian kinerja</a></h3>

					                <div class="timeline-body">
					                <?php
					
									 foreach ($this->mrealisasi_sasaran->get_sasaran_program($id_sasaran) as $key => $program): 
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
											<td style="vertical-align: middle;" class="text-center bg-yellow">No</td>
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
												<?php echo form_hidden("update[ID][]", $kegiatan->id_anggaran_kegiatan);?>
												<textarea class="form-control" name="update[output][<?php echo $kegiatan->id_anggaran_kegiatan ?>]" ><?php echo $kegiatan->output ?></textarea>
											</td>
								 		</tr>

									<?php endforeach; ?>
									</table>	
										<?php endforeach; ?>
					                <textarea name="update_analisis[output_PKA][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->output_PKA ?>
					                </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 7 -->
					<div class="tab-pane" id="7">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Faktor-faktor Pendukung Pencapaian Kinerja Sasaran</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[pendukung][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->pendukung ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 8 -->
					<div class="tab-pane" id="8">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Faktor-faktor Penghambat Pencapaian Kinerja Sasaran</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[penghambat][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->penghambat ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div> 

					<!-- tab 9 -->
					<div class="tab-pane" id="9">                
						<ul class="timeline" style="margin-left: 150px">						   
							 <li>
					              <i class="fa fa-pencil bg-silver"></i>
					            <div class="timeline-item">
					                <h3 class="timeline-header"><a href="#">Solusi/Rekomendasi/Tindak lanjut untuk Pencapaian Kinerja Sasaran</a></h3>

					                <div class="timeline-body">
					                  <textarea name="update_analisis[solusi][<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->id_analisis_sasaran_pertriwulan ?>]" class="form-control summernote" id="" >
					                  	<?php echo $this->mrealisasi_sasaran->reanalisis_triwulan($id_sasaran, $tahun, $triwulan)->solusi ?>
					                  </textarea>
					                </div>
					                <div class="timeline-footer">
					                  <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Simpan</button>
					                </div>
					            </div>
					        </li>
						</ul>
					</div>  
					
				</div>
			</div>
			<!-- /tabs -->	
		</div>
	  </div>
	  <?php endif ?>	
	</div>
   	<!-- <div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div> -->
   <?php echo form_close(); ?>
</div>
