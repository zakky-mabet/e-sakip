<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');
?>
<p class="text-center"><strong>Capaian Indikator Kinerja Strategis Tahun <?php echo $this->tahun ?></strong></p>
				<table class="mini-font table table-bordered" style="width: 100%;">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>	
							<th class="text-center">Sasaran Strategis</th>
							<th class="text-center" colspan="2">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Target Tahunan</th>
							<th class="text-center">Triwulan</th>
							<th class="text-center">Target</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">Capaian (%)</th>
						</tr>
						<tr>
							<th class="text-center">a</th>
							<th class="text-center">b</th>
							<th class="text-center">c</th>
							<th class="text-center">d</th>
							<th class="text-center">e</th>
							<th class="text-center">f</th>
							<th class="text-center">g</th>
							<th class="text-center">h</th>
							<th class="text-center">i</th>
							<th class="text-center">j</th>
						</tr>
					</thead>
					<tbody>
			        <?php 
			        /**
			         * Loop Sasaran
			         *
			         * @var string
			         **/
			        foreach(  $this->mprogram->getSasaranByLogin() as $key => $sasaran) : 
			        	$DIndikator = $this->tjuan->getInodikatorSasaranBySasaran($sasaran->id_sasaran);
			        	$col1 = (count($DIndikator) + 1) + (count($DIndikator)*5);
			        ?>
					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php echo ++$key; ?>.</td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $sasaran->deskripsi; ?></td>
					</tr>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $DIndikator as $keyIndikator => $indikator) : 
			            	$targetThn = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $this->tahun);
			            	$col2 = (count($DIndikator)*5);

			            	$targetTri = $this->tjuan->getIndikatorTargetTriwulanByIndikatorSasaran($indikator->id_indikator_sasaran, $this->tahun);

			            	$realisasi = @$this->tjuan->getRealisasiIndikatorSasaran($targetThn->id_target_sasaran, $this->tahun);

			            if( $col1 >= 2 )
			            	$col2--;
			            ?>
					<tr>
						<td rowspan="6" class="text-center"><?php echo $key.".".++$keyIndikator ?></td>
						<td rowspan="6"><?php echo $indikator->deskripsi; ?></td>
						<td rowspan="6" class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td rowspan="6" class="text-center"><?php echo @$targetThn->nilai_target ?></td>	
					</tr>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(range(1, 4) as $tri) : 
			            	$nilaiTri = 'nilai_target_triwulan'.$tri;
			            	$reaTri = 'realisasi_triwulan'.$tri;
			            	$capTri = 'capaian'.$tri;
			            ?>
						<tr>
							<td class="text-center" width="80">Triwulan <?php echo $tri ?> :</td>
							<td class="text-center"><?php echo @$targetTri->$nilaiTri; ?></td>
							<td class="text-center"><?php echo @$targetTri->$reaTri; ?></td>
							<td class="text-center"><?php echo @$targetTri->$capTri ?></td>
						</tr>
						<?php  
						endforeach;
						?>
						<tr>
							<th colspan="2" class="text-center">Kondisi Akhir (F)</th>
							<td class="text-center"><?php echo @$realisasi->nilai_realisasi ?></td>
							<td class="text-center"><?php echo @$realisasi->nilai_capaian ?></td>
						</tr>
					<?php endforeach;
			        ?>
			        <?php endforeach; ?>
					</tbody>
				</table>
<?php
$this->load->view('skpd/report/print/layout/footer');

/* End of file capaianiku.php */
/* Location: ./application/views/skpd/report/print/capaianiku.php */