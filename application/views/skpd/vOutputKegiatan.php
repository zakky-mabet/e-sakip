<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<form action="<?php echo base_url("skpd/kegiatan/ouput_createupdate"); ?>" method="POST" role="form">
   	<div class="col-md-10">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-white">Entry Kebijakan</span>
            </li>
            <?php 
            /**
             * Loop Kegiatan
             *
             * @var string
             **/
            foreach(  $this->kgiatan->getKegiatanProgramByLogin() as $key => $kegiatan) : ?>
            <li class="time-label">
                  <span class="bg-gray">Kegiatan</span><span class="bg-blue"> <small><?php echo $kegiatan->deskripsi ?></small></span>
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
	                                <th class="text-center">OUTPUT</th>
	                                <th class="text-center" width="140">SATUAN</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $kegiatan->id_kegiatan; ?>" data-id="<?php echo $kegiatan->id_kegiatan; ?>" data-tahun-awal="<?php echo $this->tjuan->periode_awal ?>" data-tahun-akhir="<?php echo $this->tjuan->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) ) :
					            /* Loop Output terisi */
					            $cekLoop = true;
					            foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) :
					            	echo form_hidden("update[ID][]", $output->id_output_kegiatan_program);
					            ?>
	                        	<tr class="dt-<?php echo $output->id_output_kegiatan_program; ?>">
	                        		<td><?php echo ++$keyOutput ?>.</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $output->id_output_kegiatan_program; ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $output->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="update[deskripsi][<?php echo $output->id_output_kegiatan_program; ?>]" class="form-control" rows="4" required="required"><?php echo $output->deskripsi ?></textarea>
	                        		</td>
	                        		<td>
	                        			<select name="update[satuan][<?php echo $output->id_output_kegiatan_program; ?>]" class="form-control input-sm" required="required">
	                        				<option value="">-- PILIH --</option>
	                        			<?php foreach( $this->mprogram->getAllSatuan() as $satuan) : ?>
	                        				<option value="<?php echo $satuan->id ?>" <?php if($satuan->id==$output->satuan) echo 'selected'; ?>><?php echo $satuan->nama ?></option>
	                        			<?php endforeach; ?>
	                        			</select>
	                        		</td>
	                        		<td class="text-center">
										<a href="#" class="btn btn-default" title="Hapus kegiatan ini?" 
										id="btn-delete"
										data-id="<?php echo $output->id_output_kegiatan_program; ?>"
										data-key="delete-output-kegiatan"
										data-remove="tr.dt-<?php echo $output->id_output_kegiatan_program; ?>">
											<i class="fa fa-times"></i>
										</a>
										<?php if( $cekLoop) : 
										$cekLoop = false;
										?>
										<button id="btn-add-indikator-program" type="button" class="btn btn-default" 
										data-id="<?php echo $kegiatan->id_kegiatan; ?>" 
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
		                        				<input type="checkbox" name="create[tahun][<?php echo $kegiatan->id_kegiatan; ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $kegiatan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $kegiatan->id_kegiatan; ?>]" class="form-control" rows="4" required="required"></textarea>
	                        		</td>
	                        		<td>
	                        			<select name="create[satuan][<?php echo $kegiatan->id_kegiatan; ?>]" class="form-control input-sm" required="required">
	                        				<option value="">-- PILIH --</option>
	                        			<?php foreach( $this->mprogram->getAllSatuan() as $satuan) : ?>
	                        				<option value="<?php echo $satuan->id ?>"><?php echo $satuan->nama ?></option>
	                        			<?php endforeach; ?>
	                        			</select>
	                        		</td>
	                        		<td class="text-center">
										<button id="btn-add-indikator-program" type="button" class="btn btn-default" 
										data-id="<?php echo $kegiatan->id_kegiatan; ?>" 
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
            /* End Loop Kegiatan */
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