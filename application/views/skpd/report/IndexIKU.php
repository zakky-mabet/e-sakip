<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Indikator Kinerja Utama  </h4>
					<p style="margin-left: 23px;">Periode <?php echo $this->periode_awal.'-'.$this->periode_akhir ?></p>
				</div>
				<div class="col-md-7">
					<div class="col-md-4">
						<label>Tahun</label>
						<select name="thn" class="form-control input-sm" onchange="window.location = '<?php echo current_url() ?>?thn=' + this.value">
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
						{
							$selected = ($tahun == $this->tahun) ? 'selected' : '';
							echo '<option value="'.$tahun.'" '.$selected.'>'.$tahun.'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-6 pull-right top2x">
						<a href="" class="btn btn-default">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<a href="" class="btn btn-default">
							<i class="fa fa-file-excel-o"></i> Excel
						</a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="box no-border">
			<div class="box-body no-padding">
				<div class="clearfix"></div>
				<hr>
				<div class="col-md-12 text-center">
					<p><strong>Target Indikator Kinerja Utama (Tahun <?php echo $this->tahun ?>)</strong></p>
				</div>
				<table class="table table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>	
							<th class="text-center">Indikator Kinerja Utama</th>
							<th class="text-center">Formulasi</th>
						</tr>
					</thead>
					<tbody>
					<?php  
					/**
					 * undocumented class variable
					 *
					 * @var string
					 **/
					foreach($this->mprogram->getIndikatorSasaranByLogin() as $key => $indikator) :
						$formulasi = $this->mprogram->getFormulasiByIndikatorSasaran($indikator->id_indikator_sasaran);
					?>
					<tr>
						<td><?php echo ++$key ?>.</td>
						<td><?php echo $indikator->deskripsi ?></td>
						<td><?php echo @$formulasi->cara_pengukuran; ?></td>
					</tr>
					<?php  
					endforeach;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>