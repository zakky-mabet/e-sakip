<div class="row">
	<form action="<?php echo base_url("skpd/tujuan/createupdateindikator"); ?>" method="POST" role="form">
   	<div class="col-md-10">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-grey">Entry Indikator Tujuan</span>
            </li>
            <?php 
            /**
             * Loop Misi
             *
             * @var string
             **/
            foreach(  $this->tjuan->getTujuanLogin() as $key => $tujuan) : ?>
            <li class="time-label">
                  <span class="bg-green">Tujuan <?php echo ++$key ?> <small><?php echo $tujuan->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default" data-id="<?php echo $tujuan->id_tujuan ?>">
	                        <thead>
	                            <tr class="bg-gray">
	                                <th class="text-center">NO.</th>
	                                <th class="text-center">INDIKATOR</th>
	                                <th class="text-center" width="140">SATUAN</th>
	                                <th class="text-center" width="140">TARGET</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $tujuan->id_tujuan ?>" data-tahun-awal="<?php echo $this->tjuan->periode_awal ?>" data-tahun-akhir="<?php echo $this->tjuan->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->tjuan->getIndikatorByTujuan($tujuan->id_tujuan) ) :
					            /* Loop Indikator terisi */
					            $cekLoop = true;
					            foreach( $this->tjuan->getIndikatorByTujuan($tujuan->id_tujuan) as $keyIndikator => $indikator) :
					            	echo form_hidden("update[ID][]", $indikator->id_indikator_tujuan);
					            ?>
	                        	<tr class="dt-<?php echo $indikator->id_indikator_tujuan; ?>">
	                        		<td><?php echo ++$keyIndikator ?>.</td>
	                        		<td>
	                        			<textarea name="update[indikator][<?php echo $indikator->id_indikator_tujuan ?>]" class="form-control" rows="4" required="required"><?php echo $indikator->indikator; ?></textarea>
	                        		</td>
	                        		<td>
	                        			<select name="update[satuan][<?php echo $indikator->id_indikator_tujuan ?>]" class="form-control input-sm" required="required">
	                        				<option value="">-- PILIH --</option>
	                        			<?php foreach( $this->tjuan->getAllSatuan() as $satuan) : ?>
	                        				<option value="<?php echo $satuan->id ?>" <?php if($indikator->id_satuan==$satuan->id) echo 'selected'; ?>><?php echo $satuan->nama ?></option>
	                        			<?php endforeach; ?>
	                        			</select>
	                        		</td>
	                        		<td><input type="text" name="update[nilai][<?php echo $indikator->id_indikator_tujuan ?>]" value="<?php echo $indikator->nilai_target ?>" class="form-control input-sm"></td>
	                        		<td class="text-center">
										<a href="#" class="btn btn-default" title="Hapus Indikator ini?" 
										id="btn-delete"
										data-id="<?php echo $indikator->id_indikator_tujuan ?>"
										data-key="delete-indikator-tujuan"
										data-remove="tr.dt-<?php echo $indikator->id_indikator_tujuan; ?>">
											<i class="fa fa-times"></i>
										</a>
										<?php if( $cekLoop) : 
										$cekLoop = false;
										?>
										<button id="btn-add-indikator-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $tujuan->id_tujuan ?>" 
										data-parent="<?php echo $key ?>"
										data-key="<?php echo $keyIndikator ?>"
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
	                        			<textarea name="create[indikator][<?php echo $tujuan->id_tujuan ?>]" class="form-control" rows="4" required="required"></textarea>
	                        		</td>
	                        		<td>
	                        			<select name="create[satuan][<?php echo $tujuan->id_tujuan ?>]" class="form-control input-sm" required="required">
	                        				<option value="">-- PILIH --</option>
	                        			<?php foreach( $this->tjuan->getAllSatuan() as $satuan) : ?>
	                        				<option value="<?php echo $satuan->id ?>"><?php echo $satuan->nama ?></option>
	                        			<?php endforeach; ?>
	                        			</select>
	                        		</td>
	                        		<td><input type="text" name="create[nilai][<?php echo $tujuan->id_tujuan ?>]" value="" class="form-control input-sm"></td>
	                        		<td class="text-center">
										<button id="btn-add-indikator-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $tujuan->id_tujuan ?>" 
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
   			<button class="btn bg-green btn-app"><i class="fa fa-save"></i> Simpan</button>
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