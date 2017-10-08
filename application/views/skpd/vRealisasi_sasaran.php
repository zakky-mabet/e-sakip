<div class="row">
	<?php echo form_open(base_url("skpd/realisasi_sasaran/save")); ?>
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
			                  <span class="bg-blue">Entri Capaian Kinerja Indikator Sasaran Per Tahun</span>
			            </li>
			            <?php 
			        
			            foreach($this->mrealisasi_sasaran->getAllSasaran( ) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th style="vertical-align: middle;" rowspan="1" width="50" class="text-center"><?php echo $tahun ?></th>
								<td colspan="5" width="100" style="vertical-align: middle; color: black" class="bg-silver" ><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
								<td  colspan="2" class="bg-silver text-right">

									<button data-toggle="tooltip" data-placement="top" title="Analisis" class="btn btn-sm btn-warning get-modal-analisis" data-id-sasaran="<?php echo $sasaran->id_sasaran ?>"  data-tahun-sasaran="<?php echo $tahun ?>" type="button"><i class="fa fa-pencil"></i> Analisis </button>

									<a href="<?php echo base_url('skpd/realisasi_sasaran/program_dan_kegiatan/'.$sasaran->id_sasaran.'/'.$tahun); ?>" class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i> Kegiatan </a>
								</td>
							</tr>
							<tr>
								<th style="vertical-align: middle;" class="text-center" width="10">No.</th>
								<th style="vertical-align: middle;" class="text-center" width="300">Indikator</th>
								<th style="vertical-align: middle;" class="text-center" width="20">Satuan</th>
								<th style="vertical-align: middle;" class="text-center" width="20">IKU</th>
								<th style="vertical-align: middle;" class="text-center" width="10"><small>Target Renstra <?php echo $tahun; ?> </small></th>
								<th style="vertical-align: middle;" class="text-center" width="30"> <small>Realisasi <?php echo $tahun; ?></small> </th>
								<th style="vertical-align: middle;" class="text-center" width="30"><small>Capaian (%)</small> </th>
								<th style="vertical-align: middle;" class="text-center" width="100"><small>Keterangan</small> </th>
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
								<td style="vertical-align: middle;" class="text-center">						
								<?php echo ++$key ?></td>
								<td style="vertical-align: middle;" ><?php echo $indikator->deskripsi ?></td>
								<td  style="vertical-align: middle;"  class="text-center"><?php echo $this->mrealisasi_sasaran->getsatuan($indikator->id_satuan)->nama ?></td>
								<td  style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>
								<td  style="vertical-align: middle;" class="text-center" ><?php echo $indikator->nilai_target  ?></td>
								<td>
								<?php echo form_hidden("update[ID][]", $indikator->id_realisasi_indikator_sasaran);?>
								<input style="vertical-align: middle;" type="text" name="update[nilai_realisasi][<?php echo $indikator->id_realisasi_indikator_sasaran ?>]" value="<?php echo $indikator->nilai_realisasi  ?>" class="form-control"></td>
								<td  style="vertical-align: middle;" >
								
								<input type="text" name="update[nilai_capaian][<?php echo $indikator->id_realisasi_indikator_sasaran ?>]" value="<?php echo $indikator->nilai_capaian  ?>" class="form-control"></td>
								<td  style="vertical-align: middle;" >
							
								<input type="text" name="update[keterangan][<?php echo $indikator->id_realisasi_indikator_sasaran ?>]" value="<?php echo $indikator->keterangan  ?>" class="form-control" data-toggle="tooltip" data-placement="top" title="<?php echo $indikator->keterangan  ?>"></td>
							</tr>
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
										
							<div class="modal" id="modal-analisis<?php echo $value->id_sasaran.$tahun ?>">
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
					</div>					

<?php endforeach; endforeach; ?>
<?php endfor; ?> 


					