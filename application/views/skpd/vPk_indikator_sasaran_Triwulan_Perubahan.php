<div class="row">
	<?php echo form_open(base_url("skpd/pk_indikator_sasaran_perubahan/save")); ?>
	
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">

		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mpk_indikator_sasaran_perubahan->periode_awal; $tahun <= $this->mpk_indikator_sasaran_perubahan->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
            <li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		PERIODE <span class="caret" ></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','pk_indikator_sasaran_perubahan'); ?>">
	                    <a href="<?php echo base_url("skpd/pk_indikator_sasaran_perubahan/") ?>"> Tahunan</a>
	                  </li>
	                  <li class="<?php echo active_link_method('pk_indikator_sasaran_perubahan','triwulan'); ?>">
	                    <a href="<?php echo base_url("skpd/pk_indikator_sasaran_perubahan/triwulan") ?>">Triwulan</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mpk_indikator_sasaran_perubahan->periode_awal; $tahun <= $this->mpk_indikator_sasaran_perubahan->periode_akhir; $tahun++) : ?>
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
			            foreach(  $this->mpk_indikator_sasaran_perubahan->getAllSasaran( ) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50" class="text-center"><?php echo $tahun ?></th>
								<td colspan="7" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th style="vertical-align: middle;" class="text-center" width="10">No.</th>
								<th style="vertical-align: middle;" class="text-center" width="160">Indikator</th>
								<th style="vertical-align: middle;" class="text-center" width="14">Satuan</th>
								<th style="vertical-align: middle;" class="text-center" width="20">IKU</th>
								<th colspan="4" style="vertical-align: middle;" class="text-center" > <small>Target PK  Triwulan Tahun <?php echo $tahun; ?></small> </th>
									
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach ($this->mpk_indikator_sasaran_perubahan->getIndikatorSasarantoTarget($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
			        
							<tr>      
								<td rowspan="5" style="vertical-align: middle;" class="text-center"> 
								<?php echo ++$key ?></td>
								<td rowspan="5" style="vertical-align: middle;"><?php echo $indikator->deskripsi ?></td>
								<td rowspan="5" style="vertical-align: middle;"  class="text-center"><?php echo $this->mpk_indikator_sasaran_perubahan->getsatuan($indikator->id_satuan)->nama ?></td>
								<td rowspan="5"  style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes') :  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>

													
								<td class="text-center" width="10" style="vertical-align: middle;"><b><small>Triwulan Tahun <?php echo $tahun ?></small></b></td>
								<td class="text-center" width="15" style="vertical-align: middle;"><b><small>Target PK </small></b></td>
								<td class="text-center" width="40" style="vertical-align: middle;"><b><small>Target PK Perubahan </small></b></td>
								<td class="text-center" width="50" style="vertical-align: middle;"><b><small>Sebab Perubahan</small></b></td>
							</tr>
			            	
							<?php foreach ($this->mpk_indikator_sasaran_perubahan->getIndikatorSasarantoTargetTriwulan($indikator->id_indikator_sasaran, $tahun) as $value ): ?>
								
							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 1
								</td>					
								<td style="vertical-align: middle;"  class="text-center">
								
									<?php echo $value->nilai_target_triwulan1 ?>
								</td>
								<td >
								<?php echo form_hidden("update[ID][]", $value->id_pk_indikator_target_triwulan); ?>		
									<input type="text" name="update[nilai_target_triwulan_perubahan1][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->nilai_target_triwulan_perubahan1 ?>" class="form-control" placeholder="Triwulan 1">
								</td>
								<td >
									<input type="text" name="update[sebab_perubahan1][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->sebab_perubahan1 ?>" class="form-control" placeholder="Sebab Perubahan ">
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
									<input type="text" name="update[nilai_target_triwulan_perubahan2][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->nilai_target_triwulan_perubahan2 ?>" class="form-control" placeholder="Triwulan 2">
								</td>
								<td >		
									<input type="text" name="update[sebab_perubahan2][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->sebab_perubahan2 ?>" class="form-control" placeholder="Sebab Perubahan">
								</td>
							</tr>
							<tr>
								<td  style="vertical-align: middle;" class="text-center" >		
									Triwulan 3
								</td>					
								<td style="vertical-align: middle;" class="text-center"><?php echo $value->nilai_target_triwulan3 ?></td>
								<td >		
									<input type="text" name="update[nilai_target_triwulan_perubahan3][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->nilai_target_triwulan_perubahan3 ?>" class="form-control" placeholder="Triwulan 3">
								</td>
								<td >		
									<input type="text" name="update[sebab_perubahan3][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->sebab_perubahan3 ?>" class="form-control" placeholder="Sebab Perubahan">
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
									<input type="text" name="update[nilai_target_triwulan_perubahan4][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->nilai_target_triwulan_perubahan4 ?>" class="form-control" placeholder="Triwulan 4">
								</td>
								<td >		
									<input type="text" name="update[sebab_perubahan4][<?php echo $value->id_pk_indikator_target_triwulan ?>]" value="<?php echo $value->sebab_perubahan4 ?>" class="form-control" placeholder=" Sebab Perubahan">
								</td>
							</tr> 
							<!-- 	<?php endforeach ?> -->
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