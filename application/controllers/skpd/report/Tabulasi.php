<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabulasi extends Skpd 
{
	public $tahun;

	public $jenis;

	public $jenisTabulasi;

	public $kategoriCapaian;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan','mprestasi'));

		$this->jenisTabulasi = array(
			'capaian_kinerja_sasaran' => 'Capaian kinerja Sasaran',
			'pencapaian_target_misi' => 'Pencapaian Target Misi',
			'kategori_pencapaian_kinerja_sasaran' => 'Kategori Pencapaian Kinerja Sasaran',
			//'perbandingan_capaian_kinerja_sasaran_terhadap_ta_renstra' => '',
			'pagurealisasi_anggaran' => 'Pagu dan Realisasi Anggaran', 
			'efektifitas_anggaran_terhadap_capaian_misi' => 'Efektifitas Anggaran Terhadap Capaian Misi',
			'prestasi_tingkat_internasional' => 'Prestasi Tingkat Internasional',
			'prestasi_tingkat_nasional' => 'Prestasi Tingkat Nasional',
			'prestasi_tingkat_provinsi' => 'Prestasi Tingkat Provinsi', 
			'prestasi_tingkat_kabupaten' => 'Prestasi Tingkat Kota/Kabupaten'
		);

		$this->kategoriCapaian = array('Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Kurang');
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Tabulasi');

		$this->breadcrumbs->unshift(2, ' Tabulasi',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		if($this->input->get('jenis') != '')
			$this->jenis = $this->input->get('jenis');

		$this->data = array(
			'title' => " Tabulasi", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);	

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				if( $this->jenis != FALSE)
					$this->load->view("skpd/report/print/indextabulasi");
				break;
			case 'pdf':
			    $this->pdf->filename = strtoupper($this->jenisTabulasi[$this->jenis].'&nbsp;'.$this->session->userdata('SKPD')->nama).".pdf";
			    switch ($this->jenis) 
			    {
			    	case 'prestasi_tingkat_internasional':
			    	case 'prestasi_tingkat_nasional':
			    	case 'prestasi_tingkat_provinsi':
			    	case 'prestasi_tingkat_kabupaten':
			    		$this->pdf->setPaper('legal', 'potrait');
			    		break;
			    	default:
			    		$this->pdf->setPaper('legal', 'landscape');
			    		break;
			    }
			    if( $this->jenis != FALSE)
			    	$this->pdf->load_view('skpd/report/print/indextabulasi', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/IndexTabulasi', $this->data);
				break;
		}
	}

}

/* End of file Tabulasi.php */
/* Location: ./application/controllers/skpd/report/Tabulasi.php */