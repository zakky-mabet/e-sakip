<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-4">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Surat Keputusan Indikator Kinerja Utama </h4>
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
				<div class="col-md-12 text-center ">
					<p class="font-times">
						<strong class="font-times">
							KEPUTUSAN <br>
							<span class="uppercase"> PLT. <?php echo $this->session->userdata('SKPD')->nama; ?></span> <br>
							KABUPATEN BANGKA TENGAH <br>
						</strong>
							NOMOR : TM/SK/09/2017/0007
					</p>
					<br>
					<p class="font-times">
						<b class="font-times">TENTANG
						PENETAPAN INDIKATOR KINERJA UTAMA (IKU) <br>
						DI LINGKUNGAN <span class="uppercase">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span><br>
						KABUPATEN BANGKA TENGAH</b>
					</p>

	


				</div>
			</div>
		</div>
	</div>
</div>