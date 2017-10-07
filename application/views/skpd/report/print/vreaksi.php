<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');
?>
<p class="text-center"><strong>Rencana Rencana Aksi  (Tahun <?php echo $this->tahun ?>)</strong></p>
				<table class="mini-font table table-bordered" style="width: 100%">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">No.</th>	
							<th class="text-center">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center" width="70">Target</th>
							<th class="text-center">Program</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center">Kegiatan</th>
							<th class="text-center">Anggaran</th>
							<th class="text-center">Output Kegiatan</th>
							<th class="text-center" width="70">Target</th>
							<th class="text-center">Penanggung Jawab</th>
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
				    ?>
					<tr class="bg-gray">
						<td><?php echo ++$key ?></td>
						<td colspan="11"><strong>Sasaran : </strong><?php echo $sasaran->deskripsi ?></td>
					</tr>
			        <?php 
			        /**
			         * Loop Program
			         *
			         * @var string
			         **/
			        foreach(  $DIndikator as $keyIndikator => $indikator) : 
			        	$Dporgram =$this->mprogram->getProgramBySasaran( $indikator->id_sasaran);
			        	$PK = $this->mprogram->getPKIndikatorTargetTriwulan($indikator->id_indikator_sasaran, $this->tahun);

			        	$multipleProgram = array();
			        	foreach($Dporgram as $row)
			        		$multipleProgram[] = $row->id_program;

			        	$col1 = (count($Dporgram) + 1) + $this->mprogram->getKegiatanProgramByMultipleProgram($multipleProgram);

						$col2 = ($this->mprogram->getKegiatanProgramByMultipleProgram($multipleProgram));
			       ?>
 					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php   ?></td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $indikator->deskripsi ?></td>
						<td rowspan="<?php echo $col1 ?>" class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td rowspan="<?php echo $col1 ?>">
							T1 = <strong><?php echo @$PK->nilai_target_triwulan1 ?></strong><br>
							T2 = <strong><?php echo @$PK->nilai_target_triwulan2 ?></strong><br>
							T3 = <strong><?php echo @$PK->nilai_target_triwulan3 ?></strong><br>
							T4 = <strong><?php echo @$PK->nilai_target_triwulan4 ?></strong>
						</td>
					</tr>
			        <?php  
					/**
					 * Loop Program
					 *
					 * @var string
					 **/
					if(($col1-$col2) == 2)
						$col1 += 1;
					foreach($Dporgram as $keyProgram => $program) :
						$DKegiatan = $this->kgiatan->getKegiatanProgramByProgram($program->id_program);
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
					?>
					<tr style="<?php if($keyProgram==0) echo 'border-top: 0px !important;'; ?>">
						<td rowspan="<?php echo ($col1-$col2) ?>"><?php echo $program->deskripsi ?></td>
						<td rowspan="<?php echo ($col1-$col2) ?>"><?php echo @number_format($anggaran) ?></td>
					</tr>
					<?php
					foreach( $DKegiatan as $keyKegiatan => $kegiatan) :
						$anggKegiatan = $this->kgiatan->getAnggaranKegiatan($kegiatan->id_kegiatan, $this->tahun);
						$pjk = $this->kgiatan->getPenanggungJawabKegiatanByKegiatanTahun($kegiatan->id_kegiatan, $this->tahun);
					?>
					<tr>
						<td><?php echo $kegiatan->deskripsi ?></td>
						<td><?php echo @number_format(@$anggKegiatan->nilai_anggaran) ?></td>
						<td>
							<?php 
							$outputID = 0;
							foreach( $this->kgiatan->getOutputByKegiatanProgram($kegiatan->id_kegiatan) as $keyOutput => $output) 
							{
								echo $output->deskripsi."<br>";
								$outputID = $output->id_output_kegiatan_program;
							}
							?>
						</td>
						<td>
							<?php for($triwulan = 1; $triwulan <=4; $triwulan++) 
							{
								$PKOT = $this->kgiatan->getPKOutputKegiatan($outputID, $this->tahun, "T".$triwulan);
								echo 'T'.@$triwulan.' = <strong>'.@$PKOT->nilai_target.'</strong><br>';
							}
							?>
						</td>
						<td><?php echo @$pjk->penanggung_jawab ?></td>
					</tr>
					<?php  
					endforeach;
					endforeach;
					endforeach;
					endforeach;
				    ?>
					</tbody>
				</table>
<?php
$this->load->view('skpd/report/print/layout/footer');

/* End of file vreaksi.php */
/* Location: ./application/views/skpd/report/print/vreaksi.php */