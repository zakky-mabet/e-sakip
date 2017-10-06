<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Efisiensi_kinerja extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Tingkat Efisiensi & Efektifitas Kinerja Terhadap Realisasi Anggaran');

		$this->breadcrumbs->unshift(2, ' Tingkat Efisiensi & Efektifitas Kinerja',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => " Tingkat Efisiensi & Efektifitas Kinerja Terhadap Realisasi Anggaran", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);

		$this->template->view('skpd/report/vEfisiensiKinerja', $this->data);	
	}

}

/* End of file Efisiensi_kinerja.php */
/* Location: ./application/controllers/skpd/report/Efisiensi_kinerja.php */