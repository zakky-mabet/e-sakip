<div class="row">
	<?php echo form_open(base_url("skpd/rkt/save")); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">

		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mrkt->periode_awal; $tahun <= $this->mrkt->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
				
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mrkt->periode_awal; $tahun <= $this->mrkt->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if(date('Y')==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			          
			            <li class="time-label">
			                  <span class="bg-blue">Entri Target Indikator Rencana Kinerja Tahunan </span>
			            </li>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mrkt->getAllSasaran( ) as $key => $sasaran) : ?>
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
								<th style="vertical-align: middle;" class="text-center" width="10"><small>Target Renstra <?php echo $tahun; ?> </small></th>
								<th style="vertical-align: middle;" class="text-center" width="50"> <small>Target RKT <?php echo $tahun; ?></small> </th>
								<th style="vertical-align: middle;" class="text-center" width="100"><small>Sebab Perubahan</small> </th>
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach ($this->mrkt->getIndikatorSasarantoTarget($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
							<tr>
								<td style="vertical-align: middle;" class="text-center"><?php echo ++$key ?></td>
								<td style="vertical-align: middle;" ><?php echo $indikator->deskripsi ?></td>
								<td  style="vertical-align: middle;"  class="text-center"><?php echo $this->mrkt->getsatuan($indikator->id_satuan)->nama ?></td>
								<td  style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>
								<td  style="vertical-align: middle;" class="text-center" ><?php  echo $indikator->nilai_target  ?></td>
								<td>
								<input type="text" name="update[nilai_target_rkt][<?php echo $indikator->rkt_id_target ?>]" value="<?php echo $indikator->nilai_target_rkt  ?>" class="form-control"></td>
								<td  style="vertical-align: middle;" >
								<?php echo form_hidden("update[ID][]", $indikator->rkt_id_target);?>
								<input type="text" name="update[sebab][<?php echo $indikator->rkt_id_target ?>]" value="<?php echo $indikator->sebab  ?>" class="form-control"></td>
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