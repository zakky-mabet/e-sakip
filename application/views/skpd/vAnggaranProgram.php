<div class="row">
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
                  		Program <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
	                  <li class="<?php echo active_link_method('index','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program") ?>"> Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('anggaran','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/anggaran/{$this->periode_awal}") ?>">Anggaran Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('indikator','program'); ?>">
	                    <a href="<?php echo base_url('skpd/program/indikator'); ?>">Indikator Kinerja Program</a>
	                  </li>
	                  <li class="<?php echo active_link_method('target','program'); ?>">
	                    <a href="<?php echo base_url("skpd/program/target") ?>">Target Indikator Kinerja Program</a>
	                  </li>
					</ul>
              	</li>
            </ul>
            <div class="tab-content">
            <?php for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++) : ?>
				<div class="tab-pane <?php if($this->tahun==$tahun) echo 'active'; ?>" id="tab-<?php echo $tahun; ?>">
			    <?php 
			    /**
			     * Loop Tujuan
			     *
			     * @var string
			     **/
			    foreach($this->tjuan->getTujuanLogin() as $keyTjuan => $tujuan) : ?>
					<table class="table table-bordered">
						<thead class="bg-blue">
							<tr>
								<th rowspan="3" width="50"><div class="text-vertical"><?php echo $tahun ?></div></th>
							</tr>
							<tr style="color: black" class="bg-silver">
								<td colspan="4" width="100"><strong>Tujuan :</strong> <?php echo $tujuan->deskripsi ?></td>
							</tr>
							<tr style="color: black" class="bg-silver">
								<td colspan="4" width="100"><strong>Sasaran :</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
							</tr>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Program</th>
								<th class="text-center" width="200">Anggaran</th>
								<th class="text-center" width="250">Sumber</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1.</td>
								<td>Lorem ipsum dolor sit amet, consectetur.</td>
								<td class="text-center">Rp. 23.000.000</td>
								<td><input type="text" class="form-control"></td>
							</tr>
						</tbody>
					</table>
				<?php  
				endforeach;
				?>
				</div>
			<?php endfor; ?>
            </div>
		</div>
	</div>
   	<div class="col-md-2 top50x">
   		<div id="stickerButton100x">
   			<button class="btn bg-blue btn-app"><i class="fa fa-save"></i> Simpan</button>
   		</div>
   	</div>
</div>
