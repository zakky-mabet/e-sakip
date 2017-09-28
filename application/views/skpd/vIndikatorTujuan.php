<div class="row">
	<form action="" method="POST" role="form">
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
					            if( 1 == 3 ) :
					            /* Loop Indikator terisi */

					            ?>
					            
					            <?php
					        	else :
					            ?>
								<!-- End Update -->
	                        	<tr>
	                        		<td><?php echo $key ?>.1</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $tujuan->id_tujuan ?>]" class="form-control" rows="4" required="required"></textarea>
	                        		</td>
	                        		<td>
	                        			<select name="create[satuan][]" class="form-control input-sm" required="required">
	                        				<option value=""></option>
	                        			</select>
	                        		</td>
	                        		<td><input type="text" name="" value="" class="form-control input-sm"></td>
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