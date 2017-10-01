<div class="row">
<style type="text/css" media="screen">
	.anic {
		  -webkit-animation: fade-in 0.27s linear infinite alternate;
		  -moz-animation: fade-in 0.27s linear infinite alternate;
		  animation: fade-in 0.27s linear infinite alternate;
		}
		@-moz-keyframes fade-in {
		  0% {
		    opacity: 0;
		  }
		  65% {
		    opacity: 1;
		  }
		}
		@-webkit-keyframes fade-in {
		  0% {
		    opacity: 0;
		  }
		  65% {
		    opacity: 1;
		  }
		}
		@keyframes fade-in {
		  0% {
		    opacity: 0;
		  }
		  65% {
		    opacity: 1;
		  }
}

</style>
	<?php echo form_open(base_url("skpd/pk_indikator_sasaran/save")); ?>
	<div style="font-size: 5em; color: red" class="col-md-6 col-md-offset-3 text-center anic">
			ON PROGRESS !!!
	</div>

	<!-- <div class="col-md-6 col-md-offset-3">
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
								
								<th style="vertical-align: middle;" class="text-center" width="50"> <small>Target PK <?php echo $tahun; ?></small> </th>
								<th style="vertical-align: middle;" class="text-center" width="50"> <small>Target PK Tahun <?php echo $tahun; ?> </small> </th>
								
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach ($this->mpk_indikator_sasaran->getIndikatorSasarantoTarget($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
			        
							<tr>
								<td style="vertical-align: middle;" class="text-center"><?php echo ++$key ?></td>

								<td style="vertical-align: middle;"><?php echo $indikator->deskripsi ?></td>
								<td  style="vertical-align: middle;"  class="text-center"><?php echo $this->mpk_indikator_sasaran->getsatuan($indikator->id_satuan)->nama ?></td>
								<td  style="vertical-align: middle;"  class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>

								<td  style="vertical-align: middle;"  class="text-center"> <?php echo $indikator->nilai_target_pk  ?></td>
							<?php foreach ($this->mpk_indikator_sasaran->getIndikatorSasarantoTargetTriwulan($sasaran->id_sasaran, $tahun ) as $key => $indikatortriwulan) :  ?>
								

							
								<td>		
								<?php echo $indikatortriwulan->tahun_triwulan.'<br>'.$indikatortriwulan->id_indikator_sasaran ?>					
								<input type="text" name="update[nilai_target_pk][<?php echo $indikator->id_pk_target ?>]" value="" class="form-control"></td>
								<?php endforeach ?>
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
   	</div> -->
   <?php echo form_close(); ?>
</div>