<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<form action="<?php echo base_url("skpd/program/createupdate") ?>" method="POST" role="form">
   	<div class="col-md-10">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-grey">Entry Tujuan</span>
            </li>
            <?php 
            /**
             * Loop Misi
             *
             * @var string
             **/
            foreach( $this->mprogram->getSasaranByLogin() as $key => $sasaran) : ?>
            <li class="time-label">
                  <span class="bg-gray">Sasaran</span><span class="bg-blue"> <small><?php echo $sasaran->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default" data-id="<?php echo $sasaran->id_sasaran ?>">
	                        <thead>
	                            <tr class="bg-gray">
	                                <th class="text-center" width="30">NO.</th>
	                                <th class="text-center" width="170">AKTIF</th>
	                                <th class="text-center">PROGRAM</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $sasaran->id_sasaran ?>" data-tahun-awal="<?php echo $this->tjuan->periode_awal ?>" data-tahun-akhir="<?php echo $this->tjuan->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->mprogram->getProgramBySasaran($sasaran->id_sasaran) ) :
					            /* Loop Tujuan terisi */
					            $cekLoop = true;
					            foreach( $this->mprogram->getProgramBySasaran($sasaran->id_sasaran) as $keyProgram => $program) :
					            	echo form_hidden("update[ID][]", $program->id_program);
					            ?>
	                        	<tr class="dt-<?php echo $program->id_program; ?>">
	                        		<td>1.</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $program->id_program ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $program->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="update[deskripsi][<?php echo $program->id_program ?>]" class="form-control" rows="3" required="required"><?php echo $program->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
										<a href="#" class="btn btn-default" title="Hapus Program ini?" 
										id="btn-delete"
										data-id="<?php echo $program->id_program ?>"
										data-key="delete-program"
										data-remove="tr.dt-<?php echo $program->id_program; ?>">
											<i class="fa fa-times"></i>
										</a>
										<?php if( $cekLoop) : 
										$cekLoop = false;
										?>
										<button id="btn-add-program" type="button" class="btn btn-default" 
										data-id="<?php echo $sasaran->id_sasaran ?>" 
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
		                        				<input type="checkbox" name="create[tahun][<?php echo $sasaran->id_sasaran ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $sasaran->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $sasaran->id_sasaran ?>]" class="form-control" rows="3" required="required"></textarea>
	                        		</td>
	                        		<td class="text-center">
										<button id="btn-add-program" type="button" class="btn btn-default" 
										data-id="<?php echo $sasaran->id_sasaran ?>" 
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