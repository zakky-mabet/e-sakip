<div class="row">
	<?php echo form_open(base_url("skpd/realisasi_sasaran/savetriwulan")); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">

		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mrealisasi_sasaran->periode_awal; $tahun <= $this->mrealisasi_sasaran->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
            	<li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		PERIODE <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','realisasi_sasaran'); ?>">
	                    <a href="<?php echo base_url("skpd/realisasi_sasaran/") ?>"> Tahunan</a>
	                  </li>
	                  <li class="<?php echo active_link_method('realisasi_sasaran','triwulan'); ?>">
	                    <a href="<?php echo base_url("skpd/realisasi_sasaran/triwulan") ?>">Triwulan</a>
	                  </li>
	                   <li class="<?php echo active_link_method('realisasi_sasaran','bulanan'); ?>">
	                    <a href="<?php echo base_url("skpd/realisasi_sasaran/bulanan") ?>">Bulanan</a>
	                  </li>
	                  <li class="<?php echo active_link_method('realisasi_sasaran','lampiran'); ?>">
	                    <a href="<?php echo base_url("skpd/realisasi_sasaran/lampiran") ?>">Lampiran dan Foto</a>
	                  </li>
					</ul>
              	</li>
				
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mrealisasi_sasaran->periode_awal; $tahun <= $this->mrealisasi_sasaran->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if(date('Y')==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			          
			            <li class="time-label">
			                  <span class="bg-blue">Entri Capaian Kinerja Indikator Sasaran Per Triwulan</span>
			            </li>
			            <?php 
			        
			            foreach($this->mrealisasi_sasaran->getAllSasaran() as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th style="vertical-align: middle;" rowspan="1" width="50" class="text-center"><?php echo $tahun ?></th>
								<td colspan="8" width="100" style="vertical-align: middle; color: black" class="bg-silver" ><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
								
							</tr>
							<tr>
								<th style="vertical-align: middle;" class="text-center" width="10">No.</th>
								<th style="vertical-align: middle;" class="text-center" width="300">Indikator</th>
								<th style="vertical-align: middle;" class="text-center" width="20">Satuan</th>
								<th style="vertical-align: middle;" class="text-center" width="20">IKU</th>
								<th colspan="5" style="vertical-align: middle;" class="text-center" > Target, Realisasi dan Capaian Tahun <?php echo $tahun; ?></th>
								
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach ($this->mrealisasi_sasaran->getIndikatorSasarantoTarget($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
							<tr>
								<td rowspan="5"  style="vertical-align: middle;" class="text-center">
								<?php echo ++$key ?></td>
								<td rowspan="5"  style="vertical-align: middle;" ><?php echo $indikator->deskripsi ?></td>
								<td rowspan="5"   style="vertical-align: middle;"  class="text-center"><?php echo $this->mrealisasi_sasaran->getsatuan($indikator->id_satuan)->nama ?></td>
								<td rowspan="5"   style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>
								
								<td class="text-center" width="10" style="vertical-align: middle;"><b><small>Triwulan Tahun <?php echo $tahun ?></small></b></td>
								<td class="text-center" width="15" style="vertical-align: middle;"><b><small>Target PK Triwulan </small></b></td>
								<td class="text-center" width="40" style="vertical-align: middle;"><b><small>Realisasi Triwulan Tahun <?php echo $tahun ?> </small></b></td>
								<td class="text-center" width="50" style="vertical-align: middle;"><b><small>Capaian % (Realisasi/Target) x 100</small></b></td>
								<td class="text-center" width="50" style="vertical-align: middle;"><b><small>Analisis Sasaran Tahun <?php echo $tahun ?> Triwulan</small></b></td>
									
							</tr>

							<?php foreach ($this->mrealisasi_sasaran->getIndikatorSasarantoTargetTriwulan($indikator->id_indikator_sasaran, $tahun) as $value ): ?>
								
							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 1
								</td>					
								<td style="vertical-align: middle;"  class="text-center">
								
									<?php echo $value->nilai_target_triwulan1 ?>
								</td>
								<td >
								<?php echo form_hidden("update[ID][]", $value->id_pk_indikator_target_triwulan); ?>		
									<input type="text" name="update[realisasi_triwulan1][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->realisasi_triwulan1 ?>" class="form-control" placeholder="Realisasi Triwulan 1">
								</td>
								<td >
									<input type="text" name="update[capaian1][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->capaian1 ?>" class="form-control" placeholder="Capaian Triwulan 1">
								</td>
								<td>
									<a href="<?php echo base_url('skpd/realisasi_sasaran/analisis_sasaran_triwulan/'.$sasaran->id_sasaran.'/'.$tahun.'/T1') ?>" data-toggle="tooltip" data-placement="top" title="Analisis Pencapaian Sasaran Tahun <?php echo $tahun ?> Triwulan 1" class="btn btn-sm btn-danger"  type="button"><i class="fa fa-pencil"></i> Analisis </a>
								</td>
							</tr> 

							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 2
								</td>					
								<td  style="vertical-align: middle;" class="text-center">		
									<?php echo $value->nilai_target_triwulan2 ?>
								</td>
								<td >		
									<input type="text" name="update[realisasi_triwulan2][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->realisasi_triwulan2 ?>" class="form-control" placeholder=" Realisasi Triwulan 2">
								</td>
								<td >		
									<input type="text" name="update[capaian2][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->capaian2 ?>" class="form-control" placeholder="Capaian Triwulan 2">
								</td>
								<td>
									<a href="<?php echo base_url('skpd/realisasi_sasaran/analisis_sasaran_triwulan/'.$sasaran->id_sasaran.'/'.$tahun.'/T2') ?>" data-toggle="tooltip" data-placement="top" title="Analisis Pencapaian Sasaran Tahun <?php echo $tahun ?> Triwulan 2" class="btn btn-sm btn-danger"  type="button"><i class="fa fa-pencil"></i> Analisis </a>
								</td>
							</tr>

							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 3
								</td>					
								<td style="vertical-align: middle;" class="text-center"><?php echo $value->nilai_target_triwulan3 ?></td>
								<td >		
									<input type="text" name="update[realisasi_triwulan3][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->realisasi_triwulan3 ?>" class="form-control" placeholder="Realisasi Triwulan 3">
								</td>
								<td >		
									<input type="text" name="update[capaian3][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->capaian3 ?>" class="form-control" placeholder="Capaian Triwulan 3">
								</td>
								<td>
									<a href="<?php echo base_url('skpd/realisasi_sasaran/analisis_sasaran_triwulan/'.$sasaran->id_sasaran.'/'.$tahun.'/T3') ?>" data-toggle="tooltip" data-placement="top" title="Analisis Pencapaian Sasaran Tahun <?php echo $tahun ?> Triwulan 3" class="btn btn-sm btn-danger"  type="button"><i class="fa fa-pencil"></i> Analisis </a>
								</td>
							</tr>

							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 4
								</td>					
								<td style="vertical-align: middle;"  class="text-center">		
									<?php echo $value->nilai_target_triwulan4 ?>
								</td>
								<td >		
									<input type="text" name="update[realisasi_triwulan4][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->realisasi_triwulan4 ?>" class="form-control" placeholder="Realisasi Triwulan 4">
								</td>
								<td >		
									<input type="text" name="update[capaian4][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->capaian4 ?>" class="form-control" placeholder="Capaian Triwulan 4">
								</td>
								<td>
									<a href="<?php echo base_url('skpd/realisasi_sasaran/analisis_sasaran_triwulan/'.$sasaran->id_sasaran.'/'.$tahun.'/T4') ?>" data-toggle="tooltip" data-placement="top" title="Analisis Pencapaian Sasaran Tahun <?php echo $tahun ?> Triwulan 4" class="btn btn-sm btn-danger"  type="button"><i class="fa fa-pencil"></i> Analisis </a>
								</td>
							</tr> 


							 	<?php endforeach ?> 
						<?php endforeach ?>

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
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
   <?php echo form_close(); ?>
</div>

 <?php for($tahun = $this->mrealisasi_sasaran->periode_awal; $tahun <= $this->mrealisasi_sasaran->periode_akhir; $tahun++) : ?>
<?php
		 foreach($this->mrealisasi_sasaran->getAllSasaran() as $key => $sasaran) : 
 foreach ($this->mrealisasi_sasaran->Get_realisasi_analisis($sasaran->id_sasaran, $tahun) as $key => $value): ?>
										
							<!-- <div class="modal" id="modal-analisis<?php echo $value->id_sasaran.$tahun ?>">
						<div class="modal-dialog modal-lg modal-default">
						<form action="<?php echo base_url("skpd/realisasi_sasaran/updateanalisis") ?>" method="POST" >
							<div class="modal-content">

								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title"><i class="fa fa-pencil"></i> Analisis Sasaran Tahun <?php 	echo $value->tahun_analisis ?></h4>
									<span> <b>Sasaran</b> : <?php echo $sasaran->deskripsi ?></span>
								</div>
								<div class="modal-body bg-silver">
									<?php echo form_hidden("ID", $value->id_realisasi_analisis_sasaran_tahunan);?>
									<textarea class="form-control summernote" name="deskripsi"><?php echo $value->deskripsi ?></textarea>
								</div>
								<div class="modal-footer bg-primary">
									<button type="button" class="btn btn-warning pull-left" data-dismiss="modal"> <i class="fa fa-repeat"></i> Batal</button>
									<button type="input" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
						</form>	
						</div>
					</div>			 -->		

<?php endforeach; endforeach; ?>
<?php endfor; ?>

