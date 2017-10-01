<div class="row">
	<div class="col-md-12">
		<div class="box" id="stickerButton100x">
			<div class="box-header">
				<div class="col-md-6">
					<h4 class="box-heading"> <i class="fa fa-files-o"></i> Rencana Strategis  </h4>
					<p style="margin-left: 23px;">Periode <?php echo $this->periode_awal.'-'.$this->periode_akhir ?></p>
				</div>
				<div class="col-md-3 pull-right">
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
			<div class="clearfix"></div>
		</div>
		<div class="box no-border">
			<div class="box-body no-padding">
				<table class="table">
					<tbody>
						<tr>
							<td><strong>Visi</strong></td>
							<td width="50" class="text-center">:</td>
							<td><strong>"<?php echo $visi->deskripsi ?>"</strong></td>
						</tr>
						<tr>
							<td><strong>Misi</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->tjuan->getMisiLogin() as $key => $misi)
									echo '<li>'.$misi->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
						<tr>
							<td><strong>Strategi</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->mstrategi->getStrategiByLogin() as $key => $strategi)
									echo '<li>'.$strategi->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
						<tr>
							<td><strong>Kebijakan</strong></td>
							<td class="text-center">:</td>
							<td>
								<ol class="minleft20x">
								<?php foreach($this->kbjakan->getKebijakanByLogin() as $key => $kebijakan)
									echo '<li>'.$kebijakan->deskripsi.'</li>';
								?>
								</ol>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table mini-font table-bordered table table-condensed">
					<thead class="bg-blue">
						<tr>
							<th rowspan="2" class="text-center">No.</th>
							<th rowspan="2" class="text-center">Tujuan</th>
							<th rowspan="2" class="text-center"></th>
							<th rowspan="2" class="text-center">Sasaran</th>
							<th rowspan="2" class="text-center"></th>
							<th rowspan="2" class="text-center">Indikator Kinerja</th>
							<th rowspan="2" class="text-center">Satuan</th>
							<th colspan="5" class="text-center">Target Per Tahun</th>
						</tr>
						<tr>
							<th class="text-center">2016</th>
							<th class="text-center">2017</th>
							<th class="text-center">2018</th>
							<th class="text-center">2019</th>
							<th class="text-center">2020</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>