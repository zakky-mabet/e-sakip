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
	                        			<select name="update[opsi_sasaran][<?php echo $tujuan->id_sasaran ?>]" class="form-control " data-placeholder="" style="width: 100%;">
						                    <option  value="">-- pilih sasaran Kota / Kab --</option>
						                    <?php foreach ($this->msasaran->master_sasaran() as $key => $sasaran): ?>
						                    	 <option <?php if ($tujuan->opsi_sasaran == $sasaran->id): ?> selected <?php endif ?>  value="<?php echo $sasaran->id ?>"> <?php echo $sasaran->deskripsi; ?> </option>
						                    <?php endforeach ?>
						                </select> <br>

	                        			<textarea name="update[deskripsi][<?php echo $tujuan->id_tujuan ?>]" class="form-control" rows="4" required="required"><?php echo $tujuan->deskripsi ?></textarea>
	                        		</td>
	                        		<td class="text-center">
	                        			<button data-toggle="tooltip" data-placement="top" title="Permasalahan" style="margin-top: 40px" class="btn btn-warning" type="button"><i class="fa fa-warning"></i></button>
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
	                        			<select name="create[opsi_sasaran][<?php echo $misi->id_tujuan ?>]" class="form-control " data-placeholder="" style="width: 100%;">
						                    <option  value="">-- pilih sasaran Kota / Kab --</option>
						                    <?php foreach ($this->msasaran->master_sasaran() as $key => $sasaran): ?>
						                    	 <option value="<?php echo $sasaran->id ?>"> <?php echo $sasaran->deskripsi; ?> </option>
						                    <?php endforeach ?>
						                </select> <br>
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

<script>
	
	function add_form_sasaran(data, key, nomor, parent) {

	var html = '<tr id="baris-'+data+'-'+nomor+'"><td>'+ nomor +'</td>';
	html += '<td>';

	for( var tahun = $('tbody#data-' + data).data('tahun-awal'); tahun <= $('tbody#data-' + data).data('tahun-akhir'); tahun++)
	{
		html += '<div class="col-md-6"><label>';
		html += '<input type="checkbox" name="create[tahun]['+data+']['+tahun+']" value="'+tahun+'"> ' + tahun;
		html += '</label></div>'
	}
		html += '</td><td>';
		html += '<select name="create[opsi_sasaran]['+ data +']" class="form-control " style="width: 100%;"><option  value="" >-- pilih sasaran Kota / Kab --</option><?php foreach ($master_sasaran as $key => $sasaran): ?><option  value="<?php echo $sasaran->id ?>"> <?php echo $sasaran->deskripsi; ?></option><?php endforeach ?></select> <br>';
		html += '<textarea name="create[deskripsi]['+data+']" class="form-control" rows="4"></textarea>';
		html += '</td><td class="text-center">',
		html += '<a href="javascript:void(0)" id="delete-form" data-delete="tr#baris-'+data+'-'+nomor+'" title="Hapus tujuan ini?" class="btn btn-default"><i class="fa fa-times"></i></a>';
	    html += '</td>';
	    html += '</tr>';

	$(html).appendTo('tbody#data-' + data).hide().fadeIn(500).addClass('bg-silver');

	setInterval(function() {
		$('tr#baris-'+data+'-'+nomor).fadeIn(500).removeClass('bg-silver');
	}, 400);

	$('a#delete-form').on('click', function()
	{
		key--;
		nomor--;
		$($(this).data('delete')).addClass('bg-red').fadeOut(300, function() {
			$(this).remove();
		});
	});
}

</script>