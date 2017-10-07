<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');
?>
<p class="text-center"><strong>Target Indikator Kinerja Utama (Tahun <?php echo $this->tahun ?>)</strong></p>
				<table class=" table table-bordered mini-font" style="width: 100%">
					<thead class="bg-blue">
						<tr>
							<th rowspan="2" class="text-center" width="70" valign="top">No.</th>	
							<th rowspan="2" class="text-center" width="400">Program</th>
							<th rowspan="2" class="text-center">Pagu Anggaran</th>
							<th colspan="2" class="text-center">Triwulan 1</th>
							<th colspan="2" class="text-center">Triwulan 2</th>
							<th colspan="2" class="text-center">Triwulan 3</th>
							<th colspan="2" class="text-center">Triwulan 4</th>
						</tr>
						<tr>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
							<th class="text-center">Realisasi</th>
							<th class="text-center">%</th>
						</tr>
						<tr>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
							<th class="text-center">6</th>
							<th class="text-center">7</th>
							<th class="text-center">8</th>
							<th class="text-center">9</th>
							<th class="text-center">10</th>
							<th class="text-center">11</th>
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
				        	$col1 = (count($DIndikator) + 1);
				        ?>
						<tr class="bg-gray">
							<td class="text-center bg-blue">Sasaran <?php echo ++$key; ?></td>
							<td colspan="10"><?php echo $sasaran->deskripsi ?></td>
						</tr>
						<?php  
						/**
						 * Loop Program
						 *
						 * @var string
						 **/
						$totalPAngg = 0;
						foreach($this->mprogram->getProgramBySasaran( $sasaran->id_sasaran) as $keyProgram => $program) :
							$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
						?>
						<tr>
							<td class="text-center"><?php echo ++$keyProgram; ?></td>
							<td><?php echo $program->deskripsi; ?></td>
							<td class="text-center"><?php echo @number_format($anggaran) ?></td>
							<?php foreach(range(1, 4) as $tri => $tTahun) : ?>
							<td class="text-center"><?php echo @number_format(@$this->kgiatan->getTotalReAnggaranKegiatan($program->id_program, $this->tahun, "T".++$tri)) ?></td>
							<td class="text-center">-</td>
							<?php endforeach; ?>
						</tr>
						<?php  
						$totalPAngg += $anggaran;
						endforeach;
						?>
						<tr>
							<td colspan="2"><strong class="pull-right">Total :</strong></td>
							<th class="text-center"><?php echo number_format($totalPAngg) ?></th>
							<?php foreach(range(1, 4) as $tri => $tTahun) : ?>
							<th class="text-center"><?php echo @number_format(@$this->kgiatan->getSumTotalReAnggaranKegiatan($sasaran->id_sasaran, $this->tahun, "T".++$tri)) ?></th>
							<td class="text-center"><i class="fa fa-question"></i></td>
							<?php endforeach; ?>
						</tr>
						<?php
						endforeach;
						?>
					</tbody>
				</table>
<?php
$this->load->view('skpd/report/print/layout/footer');
/* End of file print-people.php */
/* Location: ./application/views/people/print-people.php */