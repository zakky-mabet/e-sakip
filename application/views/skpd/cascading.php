<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h2 class="page-header">Alur Pengisian Data</h2>
		<div class="flow-wrapper" id="row1">
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;1</span>
				<a href="<?php echo base_url("skpd/visi") ?>">VISI</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;2</span>
				<a href="<?php echo base_url('skpd/misi') ?>">MISI</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;3</span>
				<a href="<?php echo base_url('skpd/tujuan') ?>">TUJUAN</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;4</span>
				<a href="<?php echo base_url('skpd/sasaran') ?>">SASARAN</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;5</span>
				<a href="<?php echo base_url('skpd/sasaran/indikator_sasaran') ?>">INDIKATOR KINERJA SASARAN</a>
			</div>
			<div class="renstra flow last hvr-pulse-grow">
				<span>&nbsp;6</span>
				<a href="<?php echo base_url('skpd/target') ?>">TARGET</a>
			</div>
		</div>
		<div class="flow-wrapper" id="row2">
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;7</span>
				<a href="<?php echo base_url('skpd/program') ?>">PROGRAM DAN ANGGARAN</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span style="position:absolute; top:10px;">&nbsp;8</span>
				<a href="<?php echo base_url('skpd/kegiatan') ?>">KEGIATAN</a>
			</div>
			<div class="renstra flow center hvr-pulse-grow">
				<span>&nbsp;9</span>
				<a href="<?php echo base_url("kegiatan/anggaran/{$this->periode_awal}") ?>">ANGGARAN KEGIATAN</a>
			</div>
			<div class="rkt flow center hvr-pulse-grow">
				<span>10</span>
				<a href="<?php echo base_url('skpd/rkt') ?>">TARGET RKT</a>
			</div>
			   <div class="rkt flow center hvr-pulse-grow">
				<span>11</span>
				<a href="<?php echo base_url('skpd/rktprogram/anggaranprogramrkt') ?>">ANGGARAN PROGRAM RKT</a>
			</div>
			<div class="rkt flow last hvr-pulse-grow">
				<span>12</span>
				<a href="<?php echo base_url('rktprogram/anggarankegiatanrkt') ?>">ANGGARAN KEGIATAN RKT</a>
			</div>
		</div>
		<div class="flow-wrapper" id="row3">
			<div class="pk flow center hvr-pulse-grow">
				<span>13</span>
				<a href="<?php echo base_url('skpd/pk_indikator_sasaran') ?>">TARGET PK TAHUNAN</a>
			</div>
			<div class="pk flow center hvr-pulse-grow">
				<span>14</span>
				<a href="<?php echo base_url('skpd/pk_indikator_sasaran/triwulan') ?>">TARGET PK TRIWULAN</a>
			</div>
			<div class="pk flow center hvr-pulse-grow">
				<span>15</span>
				<a href="<?php echo base_url('skpd/pkprogram/anggaranprogram') ?>">ANGGARAN PROGRAM PK</a>
			</div>
			<div class="pk flow center hvr-pulse-grow">
				<span>16</span>
				<a href="<?php echo base_url('skpd/pkprogram/anggarankegiatan') ?>">ANGGARAN KEGIATAN PK</a>
			</div>
			<div class="pk flow center hvr-pulse-grow">
				<span>17</span>
				<a href="<?php echo base_url('skpd/pk_indikator_sasaran_perubahan') ?>">TARGET PK PERUBAHAN TAHUNAN</a>
			</div>
			<div class="pk flow last hvr-pulse-grow">
				<span>18</span>
				<a href="<?php echo base_url('skpd/pk_indikator_sasaran_perubahan/triwulan') ?>">TARGET PK PERUBAHAN TRIWULAN</a>
			</div>
		</div>
		<div class="flow-wrapper" id="row4">
			<div class="pk flow center hvr-pulse-grow">
				<span>19</span>
				<a href="<?php echo base_url('skpd/pkperubahanprogram/anggaranprogram') ?>">ANGGARAN PROGRAM PK PERUBAHAN</a>
			</div>
			<div class="pk flow center hvr-pulse-grow">
				<span>20</span>
				<a href="<?php echo base_url('skpd/pkperubahanprogram/anggarankegiatan') ?>">ANGGARAN KEGIATAN PK PERUBAHAN</a>
			</div>
			<div class="kinerja flow center hvr-pulse-grow">
				<span>21</span>
				<a href="<?php echo base_url('skpd/realisasi_sasaran') ?>">PENGUKURAN KINERJA</a>
			</div>
			<div class="kinerja flow center hvr-pulse-grow">
				<span>22</span>
				<a href="<?php echo base_url('skpd/panggarankegiatan') ?>">PENYERAPAN ANGGARAN PROGRAM</a>
			</div>
			<div class="kinerja flow center hvr-pulse-grow">
				<span style="text-decoration: line-through red;">23</span>
				<a href="">PENYERAPAN ANGGARAN KEGIATAN</a>
			</div>
			<div class="kinerja flow hvr-pulse-grow">
				<span style="text-decoration: line-through red;">24</span>
				<a href="">LAKIP</a>
			</div>
		</div>

	</div>
</div>