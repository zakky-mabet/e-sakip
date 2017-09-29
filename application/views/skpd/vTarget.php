<div class="row">
	<?php echo form_open(base_url("skpd/program/saveanggaran")); ?>
	<div class="col-md-10">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mtarget->periode_awal; $tahun <= $this->mtarget->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
				<li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		Program <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program") ?>"> Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('anggaran','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/anggaran/{$this->periode_awal}") ?>">Anggaran Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('indikator','program'); ?>">
	                    <a href="<?php echo base_url('skpd/program/indikator'); ?>">Indikator Kinerja Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('target','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/target") ?>">Target Indikator Kinerja Program</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->mtarget->periode_awal; $tahun <= $this->mtarget->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if(date('Y')==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			        <ul class="timeline">
			          
			            <li class="time-label">
			                  <span class="bg-blue">Entri Target</span>
			            </li>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mtarget->getAllSasaran( ) as $key => $sasaran) : ?>
			            <li>
					<table class="table table-bordered bg-white">
						<thead class="bg-blue">
							<tr>
								<th rowspan="1" width="50" class="text-center"><?php echo $tahun ?></th>
								<td colspan="4" width="100" valign="middle" class="bg-silver" style="color: black"><strong>Sasaran :</strong> <?php echo $sasaran->deskripsi ?></td>
							</tr>
							<tr>
								<th class="text-center" width="10">No.</th>
								<th class="text-center" width="300">Indikator</th>
								<th class="text-center" width="20">Satuan</th>
								<th class="text-center" width="20">IKU</th>
								<th class="text-center" width="100">Target Renstra <?php echo $tahun; ?> </th>
							</tr>
						</thead>
						<tbody>
						<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/

			            foreach ($this->mtarget->getIndikatorSasaran($sasaran->id_sasaran) as $key => $indikator) : ?>
							<tr>
								<td class="text-center"><?php echo ++$key ?></td>
								<td><?php echo $indikator->deskripsi ?></td>
								<td class="text-center"><?php echo $this->mtarget->getsatuan($indikator->id_satuan)->nama ?></td>
								<td class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>
								<td><input type="text" name="sumber[][]" value="" class="form-control"></td>
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