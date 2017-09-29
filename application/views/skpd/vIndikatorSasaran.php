<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>

	<form action="<?php echo base_url("skpd/sasaran/createupdate") ?>" method="POST" role="form">
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
                  <span class="bg-blue">Tujuan <?php echo ++$key ?>. <small><?php echo $tujuan->deskripsi ?></small></span>
            </li>
            <?php foreach ($this->msasaran->get_sasaran($tujuan->id_sasaran) as $keys => $sasaran): ?>
            
           	<li class="time-label">
                  <span class="bg-blue">Sasaran <?php echo ++$keys ?> <small><?php echo $sasaran->deskripsi ?></small></span>
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
	                                <th class="text-center" width="150">SATUAN</th>
	                                <th class="text-center" width="15">PK</th>
	                                <th class="text-center" width="15">IK</th>
	                                <th class="text-center" width="15">KEOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	
	                        	<?php if ($this->msasaran->get_sasaran_indikator($sasaran->id_sasaran) ): ?>

	                        	<?php foreach ($this->msasaran->get_sasaran_indikator($sasaran->id_sasaran) as $key => $indikator): 
	                        		echo form_hidden("update[ID][]", $indikator->id_indikator_sasaran);
	                        	?>
	                        	<tr>
	                        		<td>1</td>
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
	                        			<select name="update[opsi_sasaran][]" class="form-control " data-placeholder="" style="width: 100%;">
						                    <?php foreach ($this->msasaran->master_indikator() as $key => $values): ?>
						                    	 <option <?php if ($indikator->id == $values->id): ?> selected <?php endif ?>  value="<?php echo $values->id ?>"><?php echo $values->deskripsi ?></option>
						                    <?php endforeach ?>
						                </select> <br>

	                        			<textarea name="update[deskripsi][]" class="form-control" rows="4" required="required"><?php echo $indikator->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
	                        			<select name="update[opsi_sasaran][]" class="form-control " data-placeholder="" style="width: 100%;">
						                    <?php foreach ($this->msasaran->satuan() as $key => $value): ?>
						                    	 <option <?php if ($indikator->id_satuan == $value->id): ?> selected <?php endif ?>  value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
						                    <?php endforeach ?>
						                </select>
	                        		</td>
	                        		<td class="text-center">
				                            <input <?php if ($indikator->PK=='yes') {echo 'checked';} ?>  name="update[pk][1][]" value="" type="checkbox" class="minimal"> PK
	                        		</td>
	                        		<td>
				                            <input <?php if ($indikator->IKU=='yes') {echo 'checked';} ?> name="update[iku][1][]" value="" type="checkbox" class="minimal" > IKU
				                       
	                        		</td>
	                        		<td></td>
	                        	</tr>
	                        	
	                        	<?php endforeach ?>
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

