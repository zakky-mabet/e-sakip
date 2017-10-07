<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');
?>

<table style="<?php if($this->input->get('output') == 'pdf') echo 'padding-top: 10px;' ?>">
	<tbody>
		<tr>
			<td width="60"><strong>Visi</strong></td>
			<td width="30" class="text-center">:</td>
			<td><strong>"<?php echo $visi->deskripsi ?>"</strong></td>
		</tr>
		<tr>
			<td><strong>Misi</strong></td>
			<td class="text-center">:</td>
			<td style="vertical-align: top">
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
			<td style="vertical-align: top">
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
<hr>
				<table class="mini-font table table-bordered">

						<tr>
							<th rowspan="2" class="text-center" valign="top">No.</th>
							<th rowspan="2" class="text-center" valign="top">Tujuan</th>
							<th rowspan="2" colspan="2" class="text-center" valign="top">Sasaran</th>
							<th rowspan="2" class="text-center" colspan="2">Indikator Kinerja</th>
							<th rowspan="2" class="text-center">Satuan</th>
							<th colspan="5" class="text-center">Target Per Tahun</th>
						</tr>
						<tr>
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) 
							echo '<th class="text-center">'.$tahun.'</th>';
						?>
						</tr>

			            <?php 
			            /**
			             * Loop Tujuan
			             *
			             * @var string
			             **/
			            foreach(  $this->tjuan->getTujuanLogin() as $keyTujuan => $tujuan) : 
			            	$DSasaran = $this->tjuan->getSasaranByTujuan($tujuan->id_tujuan);
			            	$DIndikator = $this->tjuan->getInodikatorSasaranBySasaran($DSasaran[0]->id_sasaran);

			            $col2 = (count($DIndikator)+1);
			            $col1 = (count($DSasaran)+1) + $col2;
			            if( $col2 >= 2 )
			            	$col1--;
			            ?>
						<tr>
							<td rowspan="<?php echo $col1 ?>"><?php echo ++$keyTujuan; ?>.</td>
							<td rowspan="<?php echo $col1 ?>"><?php echo $tujuan->deskripsi; ?></td>
						</tr>
			            <?php 
			            /**
			             * Loop Sasaran
			             *
			             * @var string
			             **/
			            foreach(  $DSasaran as $keySasaran => $sasaran) : 
			            ?>
						<tr>
							<td rowspan="<?php echo $col2; ?>"><?php echo $keyTujuan.".".++$keySasaran ?></td>
							<td rowspan="<?php echo $col2; ?>"><?php echo $sasaran->deskripsi ?></td>
						</tr>
			            <?php 
			            /**
			             * Loop Program
			             *
			             * @var string
			             **/
			            foreach(  $DIndikator as $keyIndikator => $indikator) : 
			            ?>
						<tr>
							<td><?php echo $keyTujuan.".".$keySasaran.".".++$keyIndikator; ?>.</td>
							<td><?php echo $indikator->deskripsi ?></td>
							<td class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<?php  
						foreach(range($this->periode_awal, $this->periode_akhir) as $tahun) :
							$target = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $tahun);
						?>
							<td class="text-center"><?php echo @$target->nilai_target ?></td>
						<?php endforeach; ?>
						</tr>
			            <?php  
			            // end indikator
			        	endforeach;
			        	// end sasaran
						endforeach;
						// end tujuan 
						endforeach;
						?>

				</table>

<?php
$this->load->view('skpd/report/print/layout/footer');

/* End of file print-people.php */
/* Location: ./application/views/people/print-people.php */