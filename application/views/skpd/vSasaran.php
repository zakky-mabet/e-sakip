<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>

	<form action="<?php echo base_url("skpd/sasaran/createupdate") ?>" method="POST" role="form">
   	<div class="col-md-10">
   	
	
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-default">Entry Sasaran</span>
            </li>
            <?php 
            /**
             * Loop Misi
             *
             * @var string
             **/

            foreach( $this->msasaran->getMisiLogin() as $key => $misi) : ?>
            <li class="time-label">
                  <span class="bg-blue">Tujuan <?php echo ++$key ?>. <small><?php echo $misi->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default" data-id="<?php echo $misi->id_tujuan ?>">
	                        <thead>
	                            <tr class="bg-blue">
	                                <th class="text-center">NO.</th>
	                                <th class="text-center" width="170">AKTIF</th>
	                                <th class="text-center">SASARAN</th>
	                                <th class="text-center">PERMASALAHAN</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $misi->id_tujuan ?>" data-tahun-awal="<?php echo $this->msasaran->periode_awal ?>" data-tahun-akhir="<?php echo $this->msasaran->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->msasaran->getTujuanByMisi($misi->id_tujuan) ) :
					            /* Loop Tujuan terisi */
					            $Jmltujuan = count($this->msasaran->getTujuanByMisi($misi->id_tujuan));
					            foreach( $this->msasaran->getTujuanByMisi($misi->id_tujuan) as $keyTjuan => $tujuan) : 
					            	echo form_hidden("update[ID][]", $tujuan->id_tujuan);
					            ?>
	                        	<tr class="dt-<?php echo $tujuan->id_tujuan; ?>">
	                        		<td><?php echo $key ?>.<?php echo ($key+$keyTjuan) ?></td>
	                        		<td>
	                        		<?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $tujuan->id_tujuan ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $tujuan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="update[deskripsi][<?php echo $tujuan->id_tujuan ?>]" class="form-control" rows="4" required="required"><?php echo $tujuan->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
	                        			<button class="btn btn-warning" type="button"><i class="fa fa-warning"></i></button>
	                        		</td>
	                        		<td class="text-center">
										<a href="#" class="btn btn-default" title="Hapus Sasaran ini?" 
										id="btn-delete"
										data-id="<?php echo $tujuan->id_sasaran ?>"
										data-key="delete-sasaran"
										data-remove="tr.dt-<?php echo $tujuan->id_sasaran; ?>">
											<i class="fa fa-times"></i>
										</a>
										<button id="btn-add-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $misi->id_tujuan ?>" 
										data-parent="<?php echo $key ?>"
										data-key="<?php echo ($keyTjuan+1) ?>"
										title="Tambah Form">
											<i class="fa fa-plus"></i>
										</button>
	                        		</td>
	                        	</tr>					            
					            <?php endforeach;
					        	else :
					            ?>
								<!-- End Update -->
	                        	<tr>
	                        		<td><?php echo $key ?>.1</td>
	                        		<td>
	                        		<?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="create[tahun][<?php echo $misi->id_tujuan ?>][]" value="<?php echo $tahun ?>"> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $misi->id_tujuan ?>]" class="form-control" rows="4" required="required"></textarea>
	                        		</td>
	                        		<td class="text-center">
										<button id="btn-add-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $misi->id_tujuan ?>" 
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