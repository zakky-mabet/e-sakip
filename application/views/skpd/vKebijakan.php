<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<form action="<?php echo base_url("skpd/kebijakan/createupdate"); ?>" method="POST" role="form">
   	<div class="col-md-10">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-white">Entry Kebijakan</span>
            </li>
            <?php 
            /**
             * Loop Misi
             *
             * @var string
             **/
            foreach(  $this->tjuan->getMisiLogin() as $key => $misi) : ?>
            <li class="time-label">
                  <span class="bg-gray">Misi</span><span class="bg-blue"> <small><?php echo $misi->deskripsi ?></small></span>
            </li>
            <?php 
            /**
             * Loop Tujuan
             *
             * @var string
             **/
            foreach(  $this->tjuan->getTujuanByMisi( $misi->id_misi) as $tujuan) : ?>
            <li class="time-label" style="margin-left: 10px;">
                  <span class="bg-gray">Tujuan</span><span class="bg-blue"><small><?php echo $tujuan->deskripsi ?></small></span>
            </li>
            <?php 
            /**
             * Loop Tujuan
             *
             * @var string
             **/
            foreach(  $this->tjuan->getSasaranByTujuan( $tujuan->id_tujuan) as $sasaran) : ?>
            <li class="time-label" style="margin-left: 20px;">
                  <span class="bg-gray">Sasaran</span><span class="bg-blue"><small><?php echo $sasaran->deskripsi ?></small></span>
            </li>
            <?php 
            /**
             * Loop Strategi
             *
             * @var string
             **/
            foreach(  $this->mstrategi->getStrategiBySasaran( $sasaran->id_sasaran) as $key => $strategi) : ?>
            <li class="time-label" style="margin-left: 30px;">
                  <span class="bg-gray">Strategi</span><span class="bg-blue"><small><?php echo $strategi->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default">
	                        <thead>
	                            <tr class="bg-gray">
	                                <th width="30">NO.</th>
	                                <th class="text-center" width="170">AKTIF</th>
	                                <th class="text-center">KEBIJAKAN</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $strategi->id_strategi ?>" data-id="<?php echo $strategi->id_strategi ?>" data-tahun-awal="<?php echo $this->tjuan->periode_awal ?>" data-tahun-akhir="<?php echo $this->tjuan->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->kbjakan->getKebijakanByStrategi($strategi->id_strategi) ) :
					            /* Loop Indikator terisi */
					            $cekLoop = true;
					            foreach( $this->kbjakan->getKebijakanByStrategi($strategi->id_strategi) as $keyKebijakan => $kebijakan) :
					            	echo form_hidden("update[ID][]", $kebijakan->id_kebijakan);
					            ?>
	                        	<tr class="dt-<?php echo $kebijakan->id_kebijakan; ?>">
	                        		<td><?php echo ++$keyKebijakan ?>.</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $kebijakan->id_kebijakan ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $kebijakan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="update[deskripsi][<?php echo $kebijakan->id_kebijakan ?>]" class="form-control" rows="4" required="required"><?php echo $kebijakan->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
										<a href="#" class="btn btn-default" title="Hapus Kebijakan ini?" 
										id="btn-delete"
										data-id="<?php echo $kebijakan->id_kebijakan ?>"
										data-key="delete-kebijakan"
										data-remove="tr.dt-<?php echo $kebijakan->id_kebijakan; ?>">
											<i class="fa fa-times"></i>
										</a>
										<?php if( $cekLoop) : 
										$cekLoop = false;
										?>
										<button id="btn-add-kebijakan" type="button" class="btn btn-default" 
										data-id="<?php echo $kebijakan->id_kebijakan ?>" 
										data-parent="<?php echo $key ?>"
										data-key="1"
										title="Tambah Form">
											<i class="fa fa-plus"></i>
										</button>
									<?php endif; ?>
	                        		</td>
	                        	</tr>
					            <?php
					        	endforeach;
					        	else :
					            ?>
								<!-- End Update -->
	                        	<tr>
	                        		<td>1.</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="create[tahun][<?php echo $strategi->id_strategi ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $strategi->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $strategi->id_strategi ?>]" class="form-control" rows="4" required="required"></textarea>
	                        		</td>
	                        		<td class="text-center">
										<button id="btn-add-kebijakan" type="button" class="btn btn-default" 
										data-id="<?php echo $strategi->id_strategi ?>" 
										data-parent="<?php echo $key ?>"
										data-key="1"
										title="Tambah Form">
											<i class="fa fa-plus"></i>
										</button>
	                        		</td>
	                        	</tr>
	                        	<?php endif; ?>
	                        </tbody>
	                    </table>
	                </div>
                </div>
            </li>
            <?php 
            /* End Loop Strategi */
        	endforeach;
            /* End Loop Sasaran */
        	endforeach;
            /* End Loop Tujuan */
        	endforeach; 
            /* End Loop Misi */
            endforeach; ?>
    	</ul>
   	</div>
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
   	</form>
</div>


<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-yes" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>