<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkprogram extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Program Kerja',  'skpd/pkprogram');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));
	}

	public function index()
	{
		$this->page_title->push('Program Kerja', 'Target PK Tahunan Indikator Program');

		$this->breadcrumbs->unshift(2, 'Tahunan',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Tahunan Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKIndikatorProgramTahun', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('Program Kerja', 'Target PK Triwulan Indikator Program');

		$this->breadcrumbs->unshift(2, 'Triwulan',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Triwulan Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKIndikatorProgramTriwulan', $this->data);
	}

}

/* End of file Pkprogram.php */
/* Location: ./application/controllers/skpd/Pkprogram.php */