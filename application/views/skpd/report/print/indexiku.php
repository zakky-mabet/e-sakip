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
				<table class="table mini-font table-responsive table-bordered">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="50" valign="top">No.</th>	
							<th class="text-center">Indikator Kinerja Utama</th>
							<th class="text-center">Formulasi</th>
						</tr>
					</thead>
					<tbody>
					<?php  
					/**
					 * undocumented class variable
					 *
					 * @var string
					 **/
					foreach($this->mprogram->getIndikatorSasaranByLogin() as $key => $indikator) :
						$formulasi = $this->mprogram->getFormulasiByIndikatorSasaran($indikator->id_indikator_sasaran);
					?>
					<tr>
						<td class="text-center"><?php echo ++$key ?>.</td>
						<td><?php echo $indikator->deskripsi ?></td>
						<td><?php echo @$formulasi->cara_pengukuran; ?></td>
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