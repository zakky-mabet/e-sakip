<div class="row">
	<?php echo form_open(base_url("skpd/pk_indikator_sasaran/savetriwulan")); ?>
	
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">

		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mpk_indikator_sasaran->periode_awal; $tahun <= $this->mpk_indikator_sasaran->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
            <li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		PERIODE <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','pk_indikator_sasaran'); ?>">
	                    <a href="<?php echo base_url("skpd/pk_indikator_sasaran/") ?>"> Tahunan</a>
	                  </li>
	                  <li class="<?php echo active_link_method('pk_indikator_sasaran','triwulan'); ?>">
	                    <a href="<?php echo base_url("skpd/pk_indikator_sasaran/triwulan") ?>">Triwulan</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mpk_indikator_sasaran->periode_awal; $tahun <= $this->mpk_indikator_sasaran->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if(date('Y')==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			          
			            <li class="time-label">
			                  <span class="bg-blue">Entri Target Indikator Penetapan Kinerja Tahunan </span>
			            </li>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mpk_indikator_sasaran->getAllSasaran( ) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50" class="text-center"><?php echo $tahun ?></th>
								<td colspan="6" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th style="vertical-align: middle;" class="text-center" width="10">No.</th>
								<th style="vertical-align: middle;" class="text-center" width="300">Indikator</th>
								<th style="vertical-align: middle;" class="text-center" width="20">Satuan</th>
								<th style="vertical-align: middle;" class="text-center" width="20">IKU</th>
								
								<th style="vertical-align: middle;" class="text-center" width="60"> <small>Target PK Tahun <?php echo $tahun; ?></small> </th>
								<th colspan="2" style="vertical-align: middle;" class="text-center" > <small>Target PK  Triwulan Tahun <?php echo $tahun; ?></small> </th>
								
						
							
										
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach ($this->mpk_indikator_sasaran->getIndikatorSasarantoTargetTriwulan($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
			            
							<tr>

								<td rowspan="5" style="vertical-align: middle;" class="text-center"><?php echo ++$key ?></td>

								<td rowspan="5" style="vertical-align: middle;"><?php echo $indikator->deskripsi ?></td>
								<td rowspan="5" style="vertical-align: middle;"  class="text-center"><?php echo $this->mpk_indikator_sasaran->getsatuan($indikator->id_satuan)->nama ?></td>
								<td rowspan="5"  style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes') :  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>

								<td rowspan="5" style="vertical-align: middle;"  class="text-center"> <?php echo $indikator->nilai_target_pk  ?></td>							
								<td class="text-center"><b>Triwulan</b></td>
								<td class="text-center"><b>Target PK</b></td>
							</tr>

						 	<tr>

								<td width="30" style="vertical-align: middle;" class="text-center" >		
									Triwulan 1
								</td>					
								<td width="80">
								<?php echo form_hidden("update[ID][]", $indikator->id_pk_indikator_target_triwulan); ?>		
									<input type="text" name="update[nilai_target_triwulan1][<?php echo $indikator->id_pk_indikator_target_triwulan ?>]" value="<?php echo $indikator->nilai_target_triwulan1 ?>" class="form-control" placeholder="Triwulan 1">
								</td>
							</tr>
							<tr>
							
								<td width="30" style="vertical-align: middle;" class="text-center" >		
									Triwulan 2
								</td>					
								<td width="80">		
									<input type="text" name="update[nilai_target_triwulan2][<?php echo $indikator->id_pk_indikator_target_triwulan ?>]" value="<?php echo $indikator->nilai_target_triwulan2 ?>" class="form-control" placeholder="Triwulan 2">
								</td>
							</tr>
							<tr>
								
								<td width="30" style="vertical-align: middle;" class="text-center" >		
									Triwulan 3
								</td>					
								<td width="80">		
									<input type="text" name="update[nilai_target_triwulan3][<?php echo $indikator->id_pk_indikator_target_triwulan ?>]" value="<?php echo $indikator->nilai_target_triwulan3 ?>" class="form-control" placeholder="Triwulan 3">
								</td>
							</tr>
							<tr>
							
								<td width="30" style="vertical-align: middle;" class="text-center" >		
									Triwulan 4
								</td>					
								<td width="80">		
									<input type="text" name="update[nilai_target_triwulan4][<?php echo $indikator->id_pk_indikator_target_triwulan ?>]" value="<?php echo $indikator->nilai_target_triwulan4 ?>" class="form-control" placeholder="Triwulan 4">
								</td>
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