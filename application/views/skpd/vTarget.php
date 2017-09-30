<div class="row">
	<?php echo form_open(base_url("skpd/target/save")); ?>
	<div class="col-md-10">

		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->mtarget->periode_awal; $tahun <= $this->mtarget->periode_akhir; $tahun++) : ?>
				<li class="<?php if(date('Y')==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
				
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
			            foreach ($this->mtarget->getIndikatorSasarantoTarget($sasaran->id_sasaran, $tahun ) as $key => $indikator) : 

			            	?>
							<tr>
								<td class="text-center"><?php echo ++$key ?></td>
								<td><?php echo $indikator->deskripsi.$indikator->tahunan?></td>
								<td class="text-center"><?php echo $this->mtarget->getsatuan($indikator->id_satuan)->nama ?></td>
								<td class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i>	<?php endif ?>  </td>
								<td>
								<?php echo form_hidden("update[ID][]", $indikator->id_target_sasaran);?>
								<input type="text" name="update[nilai_target][<?php echo $indikator->id_target_sasaran ?>]" value="<?php echo $indikator->nilai_target  ?>" class="form-control"></td>
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