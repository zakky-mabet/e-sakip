<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');
?>
<p class="text-center"><strong>Rencana Kinerja Tahunan (Tahun <?php echo $this->tahun ?>)</strong></p>
				<table class="mini-font table table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>
							<th class="text-center" valign="top">Sasaran</th>
							<th class="text-center" colspan="3">Indikator Kinerja</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Target <?php echo $this->tahun ?></th>
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
					<tr>
						<td rowspan="<?php echo $col1 ?>"><?php echo ++$key ?>.</td>
						<td rowspan="<?php echo $col1 ?>"><?php echo $sasaran->deskripsi ?></td>
					</tr>
			        <?php 
			        /**
			         * Loop Program
			         *
			         * @var string
			         **/
			        foreach(  $DIndikator as $keyIndikator => $indikator) : 
			        	$target = $this->tjuan->getTargetSasaranBySasaranTahun($indikator->id_indikator_sasaran, $this->tahun);
			       ?>
					<tr>
						<td colspan="2" width="40"><?php echo $key.".".++$keyIndikator ?></td>
						<td><?php echo $indikator->deskripsi ?></td>
						<td class="text-center"><?php echo $indikator->nama_satuan ?></td>
						<td class="text-center"><?php echo @$target->nilai_target ?></td>
					</tr>
			        <?php  
			    	endforeach;
			    	// end indikator
			     	endforeach;
			     	// end sasaran
			        ?>
					</tbody>
				</table>
<?php
$this->load->view('skpd/report/print/layout/footer');

/* End of file print-people.php */
/* Location: ./application/views/people/print-people.php */