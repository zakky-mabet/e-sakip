<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>

	<form action="<?php echo base_url("skpd/sasaran/createupdate") ?>" method="POST" role="form">
   	<div class="col-md-10">
   	
	
        <ul class="timeline">
           
            <?php if (count($this->msasaran->getMisiLogin())==0): ?>
			
            	<div style="padding-top: 50px" class="col-md-8 col-md-offset-3">
	            	<div class="alert alert-danger">
	            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            		<strong>Maaf!</strong> Silahkan Entri Tujuan Rencana Strategis terdahulu.
	            	</div>
            	</div>

           	<?php else: ?>
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
	                                <th class="text-center" width="20">PERMASALAHAN</th>
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
	                        		<td class="text-center"><?php echo ++$keyTjuan ?></td>
	                        		<td>
	                        		<?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" required="required" name="update[tahun][<?php echo $tujuan->id_sasaran ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $tujuan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        		
	                        			<textarea name="update[deskripsi][<?php echo $tujuan->id_sasaran ?>]" class="form-control" rows="4" required="required"><?php echo $tujuan->deskripsi ?></textarea>
	                        		</td>

	                        		<td class="text-center">

	                        		<!-- permasalahan -->
	                        			<a href="<?php echo base_url('skpd/sasaran/permasalahan/'.$tujuan->id_sasaran) ?>" data-toggle="tooltip" data-placement="top" title="Permasalahan" style="margin-top: 40px" class="btn btn-warning" type="button"><i class="fa fa-warning"></i></a>

		                        			
	                        		</td>
	                        		<td class="text-center">
										<a style="margin-top: 40px" href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Sasaran ini?" 
										id="btn-delete"
										data-id="<?php echo $tujuan->id_sasaran ?>"
										data-key="delete-sasaran"
										data-remove="tr.dt-<?php echo $tujuan->id_sasaran; ?>">
											<i class="fa fa-times"></i>
										</a>

										<button onclick="hide('param'); return false;" style="margin-top: 40px" id="param"  type="button" class="btn btn-default btn-add-sasaran" 
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
	                        		<td><?php echo $key ?></td>
	                        		<td>
	                        		<?php for($tahun = $this->msasaran->periode_awal; $tahun <= $this->msasaran->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" checked="checked" required="required" name="create[tahun][<?php echo $misi->id_tujuan ?>][]" value="<?php echo $tahun ?>"> <?php echo $tahun ?>
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
	
<div class="modal" id="modal-masalah">
	<div class="modal-dialog modal-lg modal-default">
		<form id="form-update" method="POST" >
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-warning"></i> Sasaran !</h4>
				<span id="sasaran"></span>
			</div>
			<div class="modal-body">
					
	                	<h5><b>Permasalahan</b></h5>               	
		                <p><textarea class="form-control" id="deskripsi_permasalahan" rows="4" name="deskripsi_permasalahan"></textarea></p>
	              
			</div>
			<div class="modal-footer bg-silver">
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
				<input type="submit" id="set-update-data" value="Simpan"  class="btn btn-success">
			</div>
			</form>
		</div>
	</div>
</div>

<?php endif ?>
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

<div class="modal" id="modal-succes">
	<div class="modal-dialog modal-sm modal-success">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-check"></i> Berhasil!</h4>
				<span>Data Berhasil disimpan.</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Tutup</button>
				
			</div>
		</div>
	</div>
</div>

<script>
        function hide(param) {

        document.getElementById(param).style.display = 'none';

        }
</script>