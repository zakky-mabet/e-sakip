<div class="row">
	<?php echo form_open(base_url("skpd/realisasi_sasaran/savebulanan")); ?>
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
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mrealisasi_sasaran->periode_awal; $tahun <= $this->mrealisasi_sasaran->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if(date('Y')==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			          
			            <li class="time-label">
			                  <span class="bg-blue">Entri Progres Sasaran Per Bulan</span>
			            </li>
			            
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">

							<tr>
								<th style="vertical-align: middle;" class="text-center" width="10">No.</th>
								<th style="vertical-align: middle;" class="text-center" width="300">Sasaran</th>
								<th colspan="2" style="vertical-align: middle;" class="text-center" width="300">Bulan dan Progres</th>
							</tr>
							
						</thead>
						<tbody>
							<?php 
			        
			            foreach($this->mrealisasi_sasaran->getAllSasaran( ) as $key => $sasaran) : ?>

							<tr>
								<th rowspan="13" style="vertical-align: middle;" class="text-center" width="10"> <?php echo ++$key ?></th>
								<th rowspan="13" style="vertical-align: middle;" width="400"><?php echo $sasaran->deskripsi ?></th>
								<th style="vertical-align: middle;" class="text-center bg-red" width="20">Bulan</th>
								<th style="vertical-align: middle;" class="text-center bg-red"  width="20">Progres</th>
							</tr>

						

						<?php foreach($this->mrealisasi_sasaran->get_realisasi_bulanan($sasaran->id_sasaran, $tahun ) as $key => $value ) : 	        
			           	?>	
			          		
			          		<?php $bulan = array('januari','februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september','oktober','november', 'desember') ?>

			          		<?php foreach ($bulan as $nama_bulan): ?>
			          		
							<tr>
								<td style="vertical-align: middle;" class="text-center"><?php echo ucfirst($nama_bulan) ?></td>
								<td style="vertical-align: middle;" class="text-center">
									
									<a class="btn btn-warning btn-sm" data-bulan="<?php echo $nama_bulan ?>" data-id-sasaran="<?php echo $value->id_realisasi_analisis_sasaran_bulanan?>" data-key="bulan"  data-tahun-sasaran="<?php echo $tahun ?>" data-sasaran="<?php echo $sasaran->deskripsi ?>"><i class="fa fa-pencil"></i> Analisis</a>

								</td>
							</tr>
							
							<?php endforeach;  endforeach;  endforeach;  ?>
					
						</tbody>
					</table>
						</li>

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
					
	<div class="modal" id="realisasi"  tabindex="-1" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg modal-default">
			<form id="form-update"  method="POST">			
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="fa fa-pencil"></i> </h4>
					<span> <b>Sasaran</b> : <span class="sasaran"></span> </span>
				</div>
				<div class="modal-body bg-silver">
					<input type="hidden" name="" value="">
					<textarea class="form-control deskripsi" id="tampildata" rows="20" name=""></textarea>
				</div>
				<div class="modal-footer bg-primary">
					<button  type="submit" class="btn btn-warning pull-left" data-dismiss="modal"> <i class="fa fa-repeat"></i> Batal</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
			</form>		
		</div>
	</div>					
