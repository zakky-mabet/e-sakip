<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rktprogram extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'RKT',  'skpd/rkt');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('RKT', 'Target RKT Indikator Program');

		$this->breadcrumbs->unshift(2, 'Target RKT Indikator Program',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target RKT Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRktIndikatorProgram', $this->data);
	}

	public function saveindikatorprogram()
	{
		$this->mprogram->SaveRktIndikatorProgram();

		redirect('skpd/rktprogram');
	}

	public function rktoutputkegiatan()
	{
		$this->page_title->push('RKT', 'Target RKT Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target RKT Output Kegiatan',  'skpd/rktoutputkegiatan');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target RKT Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRktOutputKegiatan', $this->data);
	}

	public function saverktoutputkegiatan()
	{
		$this->kgiatan->SaveRktOutputKegiatan();

		redirect('skpd/rktprogram/rktoutputkegiatan');
	}
}

/* End of file Rktprogram.php */
/* Location: ./application/controllers/skpd/Rktprogram.php */