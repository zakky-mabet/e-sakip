<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-12">
					<form action="<?php echo current_url(); ?>" method="GET">
					<div class="col-md-6">
						<label>Jenis Tabulasi</label>
						<select name="jenis" class="form-control input-sm">
							<option value="">-- PILIH --</option>
						<?php  
						foreach($this->jenisTabulasi as $key =>$tabulasi) 
						{
							$selected = ($key == $this->jenis) ? 'selected' : '';
							echo '<option value="'.$key.'" '.$selected.'>'.$tabulasi.'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-2">
						<label>Tahun</label>
						<select name="thn" class="form-control input-sm">
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
						{
							$selected = ($tahun == $this->tahun) ? 'selected' : '';
							echo '<option value="'.$tahun.'" '.$selected.'>'.$tahun.'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-4 pull-right top2x">
						<button type="submit" class="btn btn-default">
							<i class="fa fa-search"></i> Lihat Data
						</button>
						<a href="<?php echo current_url().'?output=print&thn='.$this->tahun ?>" target="_blank" class="btn btn-default btn-print">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?php echo current_url().'?output=pdf&thn='.$this->tahun ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<!-- <a href="<?php echo current_url().'?output=excel&thn='.$this->tahun ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-excel-o"></i> Excel
						</a> -->
					</div>
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="box no-border">
			<div class="box-body no-padding">
				<div class="clearfix"></div>
				<hr>
				<?php  
				/**
				 * Ambil Template Tabulasi
				 *
				 * @var string
				 **/
				if( $this->jenis != FALSE)
					$this->load->view("skpd/report/tabulasi/{$this->jenis}");
				?>
			</div>
		</div>
	</div>
</div>