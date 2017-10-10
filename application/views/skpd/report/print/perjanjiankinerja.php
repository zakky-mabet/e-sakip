<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');


$bupati = $this->bupati->thisBupati();

$kepala = $this->setting->getKepalaOpd();
?>
<style>div.mail-footer > table {  margin-top: 100px; }</style>
    <div class="content">
        <div class="mail-heading">
            <h5 class="mail-name upper">PERNYATAAN PERJANJIAN KINERJA</h5><br>
            <h5 class="mail-name upper"><?php echo strtoupper($this->session->userdata('SKPD')->nama) ?></h5> <br>
            <h5 class="main-name upper">PERJANJIAN KINERJA TAHUN <?php echo $this->tahun ?></h5>
        </div>
        <div class="mail-content">
			<p class="indent">Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan, dan akuntabel serta berorientasi pada hasil, kami yang bertanda tangan di bawah ini :</p>
            <table style="margin-top: 10px; margin-bottom:0px;">
                <tr>
                    <td width="70">Nama</td>
                    <td class="text-center" width="20">:</td>
                    <td><strong><?php echo $kepala->nama_kepala ?></strong></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td class="text-center">:</td>
                    <td><?php echo $kepala->jabatan ?></td>
                </tr>
            </table>
            <p>Selanjutnya disebut sebagai PIHAK PERTAMA</p>
            <table style="margin-top: 10px; margin-bottom:0px;">
                <tr>
                    <td width="70">Nama</td>
                    <td class="text-center" width="20">:</td>
                    <td><strong><?php echo $bupati->nama_bupati ?></strong></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td class="text-center">:</td>
                    <td>BUPATI <?php echo $this->setting->get('kabupaten') ?></td>
                </tr>
            </table>
            <p class="indent">Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami.</p>
            <p class="indent">Pihak kedua akan melakukan supervisi yang diperlukan serta akan melakukan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.</p>
        </div>
        <div class="mail-footer">
            <table style="width: 100%; margin-top: 50px;">
                <tr>
                    <td style="width: 40%; padding-top: 30px;" class="text-center">
                        <strong style=" line-height: 2px;">PIHAK KEDUA</strong><br>
                        <strong></strong>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;" class="text-center">
                        <strong>Bangka Tengah, <?php echo date_id(date('Y-m-d')) ?></strong><br><br>
                        <strong>PIHAK PERTAMA</strong><br>
                        <strong></strong>
                    </td>
                </tr>
                <tr><td colspan="3" style="height: 70px;"></td></tr>
                <tr>
                    <td style="width: 40%;" class="text-center">
                        <strong style=" line-height: 2px;"><?php echo $bupati->nama_bupati ?></strong><br>
                        <strong><?php if($bupati->nip_bupati!=FALSE) echo 'NIP. '.$bupati->nip_bupati ?></strong>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;" class="text-center">
                        <strong style=" line-height: 2px;"><?php echo $kepala->nama_kepala ?></strong><br>
                        <strong><?php if($kepala->nip_kepala!=FALSE) echo 'NIP. '.$kepala->nip_kepala ?></strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="mail-heading">
            <h5 class="mail-name upper">PERJANJIAN KINERJA</h5>
        </div>
            <table style="margin-top: 10px; margin-bottom:0px;">
                <tr>
                    <td width="150"><strong>SKPD</strong></td>
                    <td class="text-center" width="20">:</td>
                    <td><strong><?php echo strtoupper($this->session->userdata('SKPD')->nama) ?></strong></td>
                </tr>
                <tr>
                    <td width="150"><strong>TAHUN ANGGARAN</strong></td>
                    <td class="text-center" width="20">:</td>
                    <td><strong><?php echo $this->tahun ?></strong></td>
                </tr>
            </table>
    </div>
				<table class="mini-font table table-bordered" style="width: 100%">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">NO.</th>	
							<th class="text-center">SASARAN STRATEGIS</th>
							<th class="text-center">INDIKATOR KINERJA</th>
							<th class="text-center">SATUAN</th>
							<th class="text-center">TARGET</th>
						</tr>
						<tr>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
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
				<table class="mini-font table table-bordered" style="width: 100%">
					<thead class="bg-blue">
						<tr>
							<th class="text-center" width="30" valign="top">NO.</th>	
							<th class="text-center">PROGRAM</th>
							<th class="text-center">ANGGARAN (Rp.)</th>
							<th class="text-center">SUMBER</th>
						</tr>
					</thead>
					<tbody>
		            <?php 
		            /**
		             * Loop Kegiatan
		             *
		             * @var string
		             **/
		            $totalAngg = 0;
		            foreach(  $this->mprogram->getProgramByLogin() as $key => $program) : 
						$anggaran = $this->mprogram->getTotalAnggaranKegiatanByProgramTahun($program->id_program, $this->tahun);
						$sumber = $this->mprogram->getSumberAnggaranProgram($program->id_program, $this->tahun);
		            	?>
					<tr>
						<td><?php echo ++$key; ?></td>
						<td><?php echo $program->deskripsi ?></td>
						<td class="text-center"><?php echo @number_format($anggaran) ?></td>
						<td><?php echo @$sumber->sumber_anggaran; ?></td>
					</tr>
		            <?php  
		            $totalAngg += @$anggaran;
		            endforeach;
		            ?>
		            <tr>
		            	<td colspan="2"><strong class="pull-right">Total :</strong></td>
		            	<td colspan="2"><?php echo number_format($totalAngg) ?></td>
		            </tr>
					</tbody>
				</table>
    <div class="content">
        <div class="mail-footer">
            <table style="width: 100%; margin-top: 50px;">
                <tr>
                    <td style="width: 40%; padding-top: 30px;" class="text-center">
                        <strong style=" line-height: 2px;">PIHAK KEDUA</strong><br>
                        <strong></strong>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;" class="text-center">
                        <strong>Bangka Tengah, <?php echo date_id(date('Y-m-d')) ?></strong><br><br>
                        <strong>PIHAK PERTAMA</strong><br>
                        <strong></strong>
                    </td>
                </tr>
                <tr><td colspan="3" style="height: 70px;"></td></tr>
                <tr>
                    <td style="width: 40%;" class="text-center">
                        <strong style=" line-height: 2px;"><?php echo $bupati->nama_bupati ?></strong><br>
                        <strong><?php if($bupati->nip_bupati!=FALSE) echo 'NIP. '.$bupati->nip_bupati ?></strong>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;" class="text-center">
                        <strong style=" line-height: 2px;"><?php echo $kepala->nama_kepala ?></strong><br>
                        <strong><?php if($kepala->nip_kepala!=FALSE) echo 'NIP. '.$kepala->nip_kepala ?></strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>


<?php
$this->load->view('skpd/report/print/layout/footer');
/* End of file print-people.php */
/* Location: ./application/views/people/print-people.php */