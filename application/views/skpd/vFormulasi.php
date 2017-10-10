<div class="row">
	<?php echo form_open(base_url("skpd/formulasi/save")); ?>
		<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<div class="col-md-10">		
		<ul class="timeline">
            <li class="time-label">
                  <span class="bg-white">Entry Formulasi</span>
            </li>
           	<?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $this->mformulasi->getAllSasaran( ) as $key => $sasaran) : ?>
            <li class="time-label" style="margin-left: 20px;">
                  <span class="bg-blue">Sasaran <?php echo ++$key.' '.$sasaran->deskripsi ?></span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
	                    <table class="table table-default table-bordered ">
	                        <thead>
	                            <tr class="bg-blue">
	                                <th width="30" class="text-center" >NO.</th>
	                                <th colspan="6" class="text-center" width="170">Indikator</th>
	                          		<th class="text-center" >Satuan</th>	
	                                <th colspan="" class="text-center"  width="150">IKU</th>
	                            
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php 
					            /**
					             * Loop Sasaran
					             *
					             * @var string
					             **/
					            foreach ($this->mformulasi->getIndikatorSasaranDANformulasi($sasaran->id_sasaran) as $key => $indikator) : 
					            	echo form_hidden("update[ID][]", $indikator->id_formulasi_sasaran);?>
	                        	<tr>
	                        		<td  class="text-center" ><?php echo  ++$key ?></td>
	                        		<td  colspan="6" rowspan="2"><?php echo $indikator->deskripsi ?></td>
	                        		
		                        	<td colspan="" class="text-center"><?php echo $this->mformulasi->getsatuan($indikator->id_satuan)->nama ?></td>
		                        	
									<td class="text-center"> <?php if ($indikator->IKU=='yes'):  ?> <i class="fa fa-check "></i><?php endif ?></td>
	                        	</tr>
	                        	<tr>
	                        		<td class="text-center" rowspan="4"></td>
	                        	</tr>
	                        	<tr>
	                        		<td style="margin-top: 300px;  vertical-align:middle; font-weight: 600;" class="text-center bg-red"  ><span >Alasan</span></td>
	                        		<td colspan="7"><textarea name="update[alasan][<?php echo $indikator->id_formulasi_sasaran ?>]" class="form-control"><?php echo $indikator->alasan ?></textarea>
	                        	</td>
	                        	</tr>
	                        	<tr>
	                        		<td style="margin-top: 300px;  vertical-align:middle; font-weight: 600;" class="text-center bg-yellow" ><b>Pengukuran</b></td>
		                        	<td colspan="7"> 
		                        		<textarea  name="update[cara_pengukuran][<?php echo $indikator->id_formulasi_sasaran ?>]" class="form-control summernote"><?php echo $indikator->cara_pengukuran ?></textarea>
		                        	</td>
	                        	</tr>
	                        	<tr>
	                        		<td style="margin-top: 300px;  vertical-align:middle;font-weight: 600;" class="text-center bg-green" ><b>Keterangan</b></td>
		                        	<td colspan="7" class="text-center" colspan="2"> 
		                        		<textarea name="update[keterangan][<?php echo $indikator->id_formulasi_sasaran ?>]" class="form-control"><?php echo $indikator->keterangan ?></textarea>
		                        	</td>
	                        	</tr>
	                        <?php endforeach ?>
	                        </tbody>
	                    </table>
	                </div>
                </div>
            </li>
        <?php endforeach ?>
    	</ul>      
	</div>
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
   <?php echo form_close(); ?>
</div>