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
					            if( $this->msasaran->getTujuanSasaran($misi->id_tujuan) ) :
					            /* Loop Tujuan terisi */
					            $Jmltujuan = count($this->msasaran->getTujuanSasaran($misi->id_tujuan));
					            foreach( $this->msasaran->getTujuanSasaran($misi->id_tujuan) as $keyTjuan => $tujuan) : 
					            	echo form_hidden("update[ID][]", $tujuan->id_sasaran);
					            	
					            ?>
	                        	<tr class="dt-<?php echo $tujuan->id_sasaran; ?>">
	                        		<td><?php echo $key ?>.<?php echo ($key+$keyTjuan) ?></td>
	                        		<td>
	                        		<?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $tujuan->id_sasaran ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $tujuan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        		
	                        			<textarea name="update[deskripsi][<?php echo $tujuan->id_sasaran ?>]" class="form-control" rows="4" required="required"><?php echo $tujuan->deskripsi ?></textarea>
	                        		</td>

	                        		<td class="text-center">

	                        		<!-- permasalahan -->
	                        			<button data-toggle="tooltip" data-placement="top" title="Permasalahan" style="margin-top: 40px" class="btn btn-warning get-modal-masalah" data-id-sasaran="<?php echo $tujuan->id_sasaran ?>" type="button"><i class="fa fa-warning"></i></button>
	                        			
	                        		</td>
	                        		<td class="text-center">
										<a style="margin-top: 40px" href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Sasaran ini?" 
										id="btn-delete"
										data-id="<?php echo $tujuan->id_sasaran ?>"
										data-key="delete-sasaran"
										data-remove="tr.dt-<?php echo $tujuan->id_sasaran; ?>">
											<i class="fa fa-times"></i>
										</a>
										<button style="margin-top: 40px" id="btn-add-sasaran" type="button" class="btn btn-default" 
										data-id="<?php echo $tujuan->id_tujuan ?>" 
										data-parent="<?php echo $key ?>"
										data-key="<?php echo ($keyTjuan+1) ?>" data-toggle="tooltip" data-placement="top"
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


<?php  foreach( $this->msasaran->getTujuanSasaran($misi->id_tujuan) as $keyTjuan => $permasalahan) : ?>
		
	<?php foreach ($this->msasaran->getpermasalahan($permasalahan->id_sasaran) as $value) : ?>
				
	
<div class="modal" id="modal-masalah<?php echo $permasalahan->id_sasaran ?>">
	<div class="modal-dialog modal-lg modal-default">
		<form action="<?php echo base_url("skpd/sasaran/createupdatemasalah") ?>" method="POST" >
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-warning"></i> Sasaran !</h4>
				<span><?php echo $permasalahan->deskripsi ?></span>
			</div>
			<div class="modal-body">
				
					<div class="callout callout-default">
	                	<h5><b>Permasalahan</b></h5>
	                	<h1 id="tampildata"></h1>
	                	<?php echo form_hidden("update[ID][]", $value->id_permasalahan); ?>
		                <p><textarea class="form-control" name="update[deskripsi][<?php echo $value->id_permasalahan ?>]"><?php echo $value->deskripsi_permasalahan; ?></textarea></p>
	              	</div>
	              	<div class="callout callout-default">
						  <table class="table table-bordered" >
	                        <thead>
	                            <tr class="bg-blue">
	                                <th class="text-center" width="20">NO</th>
	                                <th class="text-center" width="100">AKAR PERMASALAHAN</th>
	                                <th class="text-center" width="100">KELOLA</th>
	                             
	                            </tr>
	                        </thead>
	                        <tbody>
	                        
	                        <?php if (count($this->msasaran->getAkarpermasalahan($value->id_permasalahan))==0 ): ?>


	                        <tr>
	                        	<td colspan="3" valign="middle"  >
	                        		 <div class="callout callout-danger" width="80%">
						                <p>Maaf! Belum Ada Akar Permasalahan, Silahkan Input Permasalahah terlebih dahulu</p>
						              </div>
	                        	</td>
	                        </tr>
	                        
	                        	
	                        <?php else:  ?>
	                        	<?php foreach ($this->msasaran->getAkarpermasalahan($value->id_permasalahan) as $key => $valueakar): ?>

	                        <tr>
	                        	<td class="text-center" style="vertical-align: middle;" >
	                        		<b><?php echo ++$key ?></b>
	                        	</td>
	                        	<td>
	                        		<?php echo form_hidden("updateakar[ID][]", $valueakar->id); ?>
	                        		<textarea name="updateakar[deskripsi][<?php echo $valueakar->id ?>]" class="form-control"  ><?php echo $valueakar->deskripsi_akar; ?></textarea>
	                        	</td>
	                        	<td class="text-center" style="vertical-align: middle;" >
	                        		<a href="#" class="get-delete-akar" data-id="<?php echo $valueakar->id ?>" data-toggle="tooltip" data-placement="top" title="Hapus"><span class="btn btn-small btn-danger"><i class="fa fa-trash"></i>
	                        	</td>
	                        
	                        </tr>
	                        <?php endforeach ?>
		                    <?php endif ?>
	                        
	                        </tbody>
	                        </table>
	              	</div>
				
			</div>
			<div class="modal-footer bg-silver">
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
				 <input type="submit" value="Simpan"  class="btn btn-success">
			</div>
			</form>
		</div>
	</div>
</div>


		<?php endforeach ?>
	<?php endforeach ?>

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