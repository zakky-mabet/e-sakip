<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>

	<form action="<?php echo base_url("skpd/sasaran/indikatorcreateupdate") ?>" method="POST" role="form">
   	<div class="col-md-10">
   		
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-default">Entry Indikator Sasaran</span>
            </li>           
            <?php 
            /**
             * Loop Tujuan
             *
             * @var string
             **/
            foreach( $this->msasaran->get_tujuandansasaran() as $key => $tujuan) : ?>
            <li class="time-label">
                  <span class="bg-gray">Tujuan <?php echo ++$key ?>.</span><span class="bg-blue"> <small><?php echo $tujuan->deskripsi ?></small></span>
            </li>
            <?php $nos=1; foreach ($this->msasaran->get_sasaran($tujuan->id_sasaran) as $keys => $sasaran): ?>
            
           	<li class="time-label">
                  <span class="bg-gray">Sasaran <?php echo $key ?>. </span><span class="bg-blue"> <small><?php echo $sasaran->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                   <table class="table table-default" data-id="<?php echo $sasaran->id_sasaran ?>">
	                        <thead>
	                            <tr class="bg-blue">
	                                <th class="text-center" width="10">NO.</th>
	                                <th class="text-center" width="20">AKTIF</th>
	                                <th class="text-center" width="200">INDIKATOR</th>
	                                <th class="text-center" width="90">SATUAN</th>
	                                <th class="text-center" width="15">PK</th>
	                                <th class="text-center" width="15">IKU</th>
	                                <th class="text-center" width="15">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $sasaran->id_sasaran; ?>" data-tahun-awal="<?php echo $this->msasaran->periode_awal ?>" data-tahun-akhir="<?php echo $this->msasaran->periode_akhir ?>">
	                        	
	                        	<?php if ($this->msasaran->get_sasaran_indikator($sasaran->id_sasaran) ): ?>

	                        	<?php $no=1; foreach ($this->msasaran->get_sasaran_indikator($sasaran->id_sasaran) as $key => $indikator): 
	                        		echo form_hidden("update[ID][]", $indikator->id_indikator_sasaran);
	                        	?>
	                        	<tr class="dt-<?php echo $indikator->id_indikator_sasaran; ?>">
	                        		<td class="text-center"><?php echo $no++ ?></td>
	                        		<td>               
				                       <?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $indikator->id_indikator_sasaran ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $indikator->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        		
	                        			<textarea required="required" name="update[deskripsi][<?php echo $indikator->id_indikator_sasaran ?>]" class="form-control" rows="4" ><?php echo $indikator->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
	                        			<select required="required" name="update[id_satuan][<?php echo $indikator->id_indikator_sasaran ?>]" class="form-control " data-placeholder="" style="width: 100%;">
	                        			 <option  value="">-- PILIH --</option>
						                    <?php foreach ($this->msasaran->satuan() as $key => $value): ?>
						                    	 <option <?php if ($indikator->id_satuan == $value->id): ?> selected <?php endif ?>  value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
						                    <?php endforeach ?>
						                </select>
	                        		</td>
	                        		<td class="text-center">
				                            <input <?php if ($indikator->PK=='yes') {echo 'checked';} ?>  name="update[pk][<?php echo $indikator->id_indikator_sasaran ?>]" value="yes" type="checkbox" class="minimal"> PK
	                        		</td>
	                        		<td>
				                            <input <?php if ($indikator->IKU=='yes') {echo 'checked';} ?> name="update[iku][<?php echo $indikator->id_indikator_sasaran ?>]" value="yes" type="checkbox" class="minimal" > IKU
				                       
	                        		</td>
	                        		<td>
	                        			<a style="margin-top: 40px" href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Indikator Sasaran ini?" 
										id="btn-delete"
										data-id="<?php echo $indikator->id_indikator_sasaran ?>"
										data-key="deleteindikator"
										data-remove="tr.dt-<?php echo $indikator->id_indikator_sasaran; ?>">
											<i class="fa fa-times"></i>
										</a>
										<button style="margin-top: 40px" id="btn-add-indikator-sasaran" type="button" class="btn btn-default" 
										data-id="<?php echo $sasaran->id_sasaran ?>" 
										data-parent="<?php echo $key ?>"
										data-key="1" data-toggle="tooltip" data-placement="top"
										title="Tambah Form">
											<i class="fa fa-plus"></i>
										</button>
	                        		</td>
	                        	</tr>
	                        	<?php endforeach ?>
	                        	<?php else :?>
	                        		<tr>
	                        		<td class="text-center"><?php echo $key ?></td>
	                        		<td>               
				                       <?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" checked="checked" required="required"
		                        				  name="create[tahun][<?php echo $sasaran->id_sasaran ?>][]" value="<?php echo $tahun ?>">  <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			
	                        			<textarea  name="create[deskripsi][<?php echo $sasaran->id_sasaran ?>]" class="form-control" rows="" required="required"></textarea>
	                        		</td>
	                        		<td class="text-center">
	                        			<select required="required" name="create[id_satuan][<?php echo $sasaran->id_sasaran ?>]" class="form-control " data-placeholder="" style="width: 100%;">
	                        				<option value="">-- pilih satuan --</option>
						                    <?php foreach ($this->msasaran->satuan() as $key => $value): ?>
						                    	 <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
						                    <?php endforeach ?>
						                </select>
	                        		</td>
	                        		<td class="text-center">
				                            <input name="create[pk][<?php echo $sasaran->id_sasaran ?>]" value="yes" type="checkbox" class="minimal"> PK
	                        		</td>
	                        		<td>
				                            <input name="create[iku][<?php echo $sasaran->id_sasaran ?>]" value="yes" type="checkbox" class="minimal" > IKU
	                        		</td>
	                        		<td>
	                        		<?php if (count($this->msasaran->get_tujuandansasaran()) == 0): ?>
	                        			
	                        		
	                        			<a style="margin-top: 40px" href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Sasaran ini?" 
										id="btn-delete"
										data-id="<?php echo $tujuan->id_sasaran ?>"
										data-key="delete-sasaran"
										data-remove="tr.dt-<?php echo $tujuan->id_sasaran; ?>">
											<i class="fa fa-times"></i>
										</a>
										<button style="margin-top: 40px"  id="btn-add-indikator-sasaran" type="button"  class="btn btn-default" 
										data-id="<?php echo $sasaran->id_sasaran ?>" 
										data-parent="<?php echo $key ?>"
										data-key="1"
										title="Tambah Form"
										data-toggle="tooltip" data-placement="top">
										<i class="fa fa-plus"></i>
										</button>

										<?php endif ?>
	                        		</td>
	                        	</tr>
	                        	<?php endif ?>
	                        </tbody>
	                   	</table>
	                </div>
                </div>
            </li>

            
            <?php endforeach ?>
            
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

