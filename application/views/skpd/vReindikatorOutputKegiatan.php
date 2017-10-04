<div class="row">
	<div class="col-md-6 col-md-offset-2">
		<?php echo $this->session->flashdata('alert'); ?>
	</div>
	<?php echo form_open(base_url("skpd/rekegiatan/saverealisasioutput")); ?>
	<div class="col-md-10">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<li class="<?php if($this->tahun==$tahun) echo 'active'; ?>">
					<a href="#tab-<?php echo $tahun; ?>" data-toggle="tab"><strong><?php echo $tahun ?></strong></a>
				</li>
            <?php endfor; ?>
				<li class="dropdown pull-right">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  		PERIODE <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','rekegiatan'); ?>">
	                    <a href="<?php echo base_url("skpd/rekegiatan/") ?>"> Tahunan</a>
	                  </li>
	                  <li class="<?php echo active_link_method('triwulan','rekegiatan'); ?>">
	                    <a href="<?php echo base_url("skpd/rekegiatan/triwulan") ?>">Triwulan</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
				<?php  
				if( $this->router->fetch_method() == 'index' )
				{
					$this->load->view('skpd/realisasikegiatan/vReKegiatanOutputTahun', $this->data);
				} else {
					$this->load->view('skpd/realisasikegiatan/vReKegiatanOutputTriwulan', $this->data);
				}
				?>

            </div>
		</div>
	</div>
   	<div class="col-md-2 top50x">
		<div id="stickerButton100x" class="text-center">
			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
   	<?php echo form_close(); ?>
</div>
