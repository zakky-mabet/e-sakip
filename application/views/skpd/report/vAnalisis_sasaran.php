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
						<a href="<?php echo current_url().'?output=print' ?>" class="btn btn-default btn-print">
							<i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?php echo current_url().'?output=pdf' ?>" target="_blank" class="btn btn-default">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>
						<!-- <a href="" class="btn btn-default">
							<i class="fa fa-file-excel-o"></i> Excel
						</a> -->
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
							<span class="uppercase font-times"> PLT. <?php echo $this->session->userdata('SKPD')->nama; ?></span> <br>
							KABUPATEN BANGKA TENGAH <br>
						</strong>
							NOMOR : 
					</p>
					<br>
					<p class="font-times">
						<b class="font-times">TENTANG
						PENETAPAN INDIKATOR KINERJA UTAMA (IKU) <br>
						DI LINGKUNGAN <span class="uppercase font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span><br>
						KABUPATEN BANGKA TENGAH</b>
					</p>
					<br>
					<p class="uppercase font-times"> <b class="font-times ">
					PLT.KEPALA DINAS PERTANIAN DAN PETERNAKAN <br>
					KABUPATEN BANGKA TENGAH</b>
					</p>
					<br>
					
					<!-- Menimbang -->
					<table>

							<tr>
								<td rowspan="2" width="200" class="text-left td-top font-times">Menimbang :</td>
								<td  width="40" class="td-top font-times">a.</td>
								<td class="text-left td-top font-times">Bahwa untuk melaksanakan ketentuan pasal 3 dan pasal 4 Peraturan Menteri Negara Pendayagunaan Aparatur Negara Nomor : PER/9/M.PAN/5/2007 tentang Pedoman Umum Penetapan Indikator Kinerja Utama (IKU) Instansi Pemerintah;</td>
							</tr>

							<tr>
								
								<td  width="40" class="td-top font-times">b.</td>
								<td class="text-left td-top font-times">Bahwa penetapan Indikator Kinerja Utama sebagaimana dimaksud pada pertimbangan huruf a, perlu di atur dan ditetapkan dengan Surat Keputusan Plt. <span class="uppercase font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span>.</td>
							</tr>
					
						
					</table>
					<!-- Mengingat -->
					<table>

							<tr>
								<td rowspan="5" width="200" class="text-left td-top font-times">Mengingat :</td>
								<td  width="40" class="td-top font-times">1.</td>
								<td class="text-left td-top font-times">	Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah;</td>
							</tr>

							<tr>
								<td  width="40" class="td-top font-times">2.</td>
								<td class="text-left td-top font-times">Undang-Undang Nomor 25 Tahun 2004 tentang Sistem Perencanaan Pembangunan Nasional;</td>
							</tr>

							<tr>
								<td  width="40" class="td-top font-times">3.</td>
								<td class="text-left td-top font-times">Peraturan Presiden RI Nomor 29 Tahun 2014 Tentang Sistem Akuntabilitas Kinerja Instansi Pemerintah; Peraturan Menteri Pendayagunaan Aparatur Negara dan</td>
							</tr>

							<tr>
								<td  width="40" class="td-top font-times">4.</td>
								<td class="text-left td-top font-times">Reformasi Birokrasi Republik Indonesia Nomor 53 Tahun 2014 tentangPetunjuk Teknis Perjanjian Kinerja, Pelaporan Kinerja dan tata Cara Reviu atas Laporan Kinerja Instansi Pemerintah Peraturan Daerah Nomor 3 Tahun 2014 tentang Rencana</td>
							</tr>

							<tr>
								<td  width="40" class="td-top font-times">5.</td>
								<td class="text-left td-top font-times">Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Bangka Tengah Tahun 2015-2020;</td>
							</tr>
				
					</table>
							<br><br>	

							<p class=" text-center uppercase font-times">Memutuskan :</p>

		

					<!-- Menetapkan -->
					<table>

							<tr>
								<td rowspan="5" width="200" class="text-left td-top font-times">Menetapkan </td>
								<td  width="40" class="td-top font-times">:</td>
								<td class="text-left td-top font-times"></td>
							</tr>

					</table>

					<table>

							<tr>
								<td rowspan="" width="200" class="text-left td-top font-times">PERTAMA </td>
								<td  width="40" class="td-top font-times">:</td>
								<td class="text-left td-top font-times"> Keputusan <span class="uppercase font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span> di Lingkungan Dinas  <span class=" font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span></td>
							</tr>

							<tr>
								<td  width="200" class="text-left td-top font-times">KEDUA </td>
								<td  width="40" class="td-top font-times">:</td>
								<td class="text-left td-top font-times">Indikator Kinerja Utama sebagaimana tercantum dalam lampiran surat keputusan ini merupakan acuan kinerja yang digunakan oleh <span class=" font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span> Kabupaten Bangka Tengah, untuk menetapkan rencana kinerja tahunan, menyampaikan rencana kinerja dan anggaran, menyusun dokumen penetapan kinerja, menyusun laporan akuntabilitas kinerja serta melakukan evaluasi pencapaian kinerja sesuai dengan dokumen Rencana Strategis <span class=" font-times">  <?php echo $this->session->userdata('SKPD')->nama; ?> </span> Kabupaten Bangka Tengah.</td>
							</tr>

							<tr>
								<td  width="200" class="text-left td-top font-times">KETIGA </td>
								<td  width="40" class="td-top font-times">:</td>
								<td class="text-left td-top font-times"> Indikator Kinerja Utama sebagaimana dimaksud pada diktum KESATU, disusun dengan mengacu kepada Indikator Kinerja Strategis Pemerintah Kabupaten Bangka Tengah.</td>
							</tr>

							<tr>
								<td  width="200" class="text-left td-top font-times">KEEMPAT </td>
								<td  width="40" class="td-top font-times">:</td>
								<td class="text-left td-top font-times"> 	Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila dikemudian hari terdapat kekeliruan dalam Keputusan ini maka akan diadakan perubahan dan perbaikan sebagaimana mestinya.</td>
							</tr>

					</table>
					<br><br>

					<div class="pull-right  text-left" style="width: 60%">
					<table>	
						<tr>
							<td  class="text-left td-top font-times"> Ditetapkan</td>
							<td width="40" class="text-center td-top font-times"> :</td>
							<td class="text-left td-top font-times"> Bangka Tengah</td>
						</tr>

						<tr>
							<td  class="text-left td-top font-times"> Pada tanggal </td>
							<td width="40" class="text-center td-top font-times"> :</td>
							<td class="text-left td-top font-times"></td>
						</tr>

					</table>
					</div>
					<br><br>
					<br>

					
					<div class="pull-right  text-left" style=" width: 50%">
					<table>	
						<tr>


							<td  class="text-center td-top font-times">
								<span class="uppercase font-times"> PLT.  <?php echo $this->session->userdata('SKPD')->nama; ?> </span> <br><br><br><br><br>

								<?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->nama_kepala; ?> <br>
								<?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->pangkat; ?> <?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->golongan; ?> <br>
								NIP. <?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->nip_kepala; ?>
							 </td>
							
						</tr>

					</table>
					</div>	
				
					<div class="col-md-12 text-center font-times">
						<br><br><br><br><br><br><br><br>	
						Lampiran	:	Keputusan Plt. <span class="uppercase font-times"><?php echo $this->session->userdata('SKPD')->nama; ?> </span> <br>
							Nomor :  <br>
							Tanggal :  <br>

							<span class="bold uppercase font-times">INDIKATOR KINERJA UTAMA (IKU)</span> <br>
							<span class="uppercase font-times bold"><?php echo $this->session->userdata('SKPD')->nama; ?> </span> <br>
							<span class="bold uppercase font-times">KABUPATEN BANGKA TENGAH</span> <br><br>

					</div>
					
					<table class="table table-bordered ">
							<thead class="bg-blue ">
								<tr >
								    <th class="text-center" style="vertical-align: middle;" rowspan="2" >NO</th>
								    <th class="text-center" style="vertical-align: middle;" rowspan="2">SASARAN <br>STRATEGIS</th>
								    <th class="text-center" style="vertical-align: middle;" rowspan="2">INDIKATOR <br> KINERJA <br> UTAMA</th>
								    <th class="text-center" style="vertical-align: middle;" rowspan="2">SATUAN</th>
								    <th class="text-center" style="vertical-align: middle;" colspan="3">PENJELASAN</th>
								    <th class="text-center" style="vertical-align: middle;" rowspan="2">KETERANGAN/KRITERIA</th>
								</tr>
								<tr>
								    <th class="text-center" style="vertical-align: middle;">ALASAN</th>
								    <th class="text-center" style="vertical-align: middle;">FORMULASI/CARA PENGUKURAN</th>
								    <th class="text-center" style="vertical-align: middle;">SUMBER DATA</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->msk_iku_report->get_all_sasaran() as $key => $sasaran): ?>
								
								<tr>
									<td rowspan="<?php echo	count($this->msk_iku_report->get_indikator_sasaran_by_id_sasaran($sasaran->id_sasaran )) ?>" class="text-center"><?php echo ++$key; ?></td>
									<td rowspan="<?php echo	count($this->msk_iku_report->get_indikator_sasaran_by_id_sasaran($sasaran->id_sasaran )) ?>"  class="text-left"><?php echo $sasaran->deskripsi ?></td>
						

								<?php foreach ($this->msk_iku_report->get_indikator_sasaran_by_id_sasaran($sasaran->id_sasaran ) as $key => $indikator): ?>	
							
									
							
									<td class="text-left"><?php echo $indikator->deskripsi ?></td>
									<td class="text-center"><?php echo $this->mpk_indikator_sasaran->getsatuan($indikator->id_satuan)->nama ?></td>
									<td class="text-left"><?php echo $indikator->alasan ?></td>
									<td class="text-left"><?php echo $indikator->cara_pengukuran ?></td>
									<td class="text-left">  Dinas <?php echo $this->session->userdata('SKPD')->nama; ?>  
									</td>
									<td class="text-left"><?php echo $indikator->keterangan ?></td>
								</tr>		

								<?php endforeach ?>

								<?php endforeach ?>
							</tbody>
						</table>

						<div class="pull-right  text-left" style=" width: 50%">
							<table>	
								<tr>


									<td  class="text-center td-top font-times">
										<span class="uppercase font-times"> PLT.  <?php echo $this->session->userdata('SKPD')->nama; ?> </span> <br><br><br><br><br>

										<?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->nama_kepala; ?> <br>
										<?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->pangkat; ?> <?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->golongan; ?> <br>
										NIP. <?php echo $this->msk_iku_report->kepala_skpd($this->session->userdata('SKPD')->ID)->nip_kepala; ?>
									 </td>
									
								</tr>

							</table>
							</div>

				
		
					
					<div style="margin-bottom:400px;"></div>

				</div>
			</div>
		</div>
	</div>
</div>