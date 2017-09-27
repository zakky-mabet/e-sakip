<div class="row">
	<form action="<?php echo base_url("skpd/tujuan/createupdate") ?>" method="POST" role="form">
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
            foreach( $this->tjuan->getMisiLogin() as $key => $misi) : ?>
            <li class="time-label">
                  <span class="bg-green">Misi <?php echo ++$key ?>. <small><?php echo $misi->deskripsi ?></small></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default" id="table-dynamic-<?php echo $misi->id_misi ?>" data-id="<?php echo $misi->id_misi ?>">
	                        <thead>
	                            <tr class="bg-gray">
	                                <th class="text-center">NO.</th>
	                                <th class="text-center" width="170">AKTIF</th>
	                                <th class="text-center">TUJUAN</th>
	                                <th class="text-center" width="150">KELOLA</th>
	                            </tr>
	                        </thead>
	                        <tbody id="data-<?php echo $misi->id_misi ?>" data-tahun-awal="<?php echo $this->tjuan->periode_awal ?>" data-tahun-akhir="<?php echo $this->tjuan->periode_akhir ?>">
								<!-- UPDATE -->
					            <?php 
					            if( $this->tjuan->getTujuanByMisi($misi->id_misi) ) :
					            /* Loop Tujuan terisi */
					            $Jmltujuan = count($this->tjuan->getTujuanByMisi($misi->id_misi));
					            foreach( $this->tjuan->getTujuanByMisi($misi->id_misi) as $keyTjuan => $tujuan) : 
					            	echo form_hidden("update[ID][]", $tujuan->id_tujuan);
					            ?>
	                        	<tr>
	                        		<td><?php echo $key ?>.1</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="update[tahun][<?php echo $tujuan->id_tujuan ?>][]" value="<?php echo $tahun ?>" <?php if(in_array($tahun, explode(',', $tujuan->tahun))) echo 'checked'; ?>> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="update[deskripsi][<?php echo $tujuan->id_tujuan ?>]" class="form-control" rows="4"><?php echo $tujuan->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
										<button type="button" class="btn btn-default" title="Hapus tujuan ini?" data-id="<?php echo $misi->id_misi ?>">
											<i class="fa fa-times"></i>
										</button>
										<?php 
										    if ($keyTjuan == $Jmltujuan - 1) :
										 ?>
										<button id="btn-add-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $misi->id_misi ?>" 
										data-parent="<?php echo $key ?>"
										data-key="<?php echo $key ?>"
										title="Tambah Form">
											<i class="fa fa-plus"></i>
										</button>
									<?php endif;?>
	                        		</td>
	                        	</tr>					            
					            <?php endforeach;
					        	else :
					            ?>
								<!-- End Update -->
	                        	<tr>
	                        		<td><?php echo $key ?>.1</td>
	                        		<td>
	                        		<?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
	                        			<div class="col-md-6">
		                        			<label>
		                        				<input type="checkbox" name="create[tahun][<?php echo $misi->id_misi ?>][]" value="<?php echo $tahun ?>"> <?php echo $tahun ?>
		                        			</label>
										</div>
	                        		<?php endfor; ?>
	                        		</td>
	                        		<td>
	                        			<textarea name="create[deskripsi][<?php echo $misi->id_misi ?>]" class="form-control" rows="4"></textarea>
	                        		</td>
	                        		<td class="text-center">
										<button id="btn-add-tujuan" type="button" class="btn btn-default" 
										data-id="<?php echo $misi->id_misi ?>" 
										data-parent="<?php echo $key ?>"
										data-key="<?php echo $key ?>"
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
