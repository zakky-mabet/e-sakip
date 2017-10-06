<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reindikatorprogram extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->breadcrumbs->unshift(2, 'Realisasi Indikator Program',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan'));

		$this->tahun = $this->periode_awal;
	}

	public function index()
	{
		$this->page_title->push('Kinerja', 'Capaian Kinerja Indikator Program Per Tahun');

		$this->data = array(
			'title' => "Capaian Kinerja Indikator Program Per Tahun", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vReindikatorProgram', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('Kinerja', 'Capaian Kinerja Indikator Program Per Triwulan');

		$this->data = array(
			'title' => "Capaian Kinerja Indikator Program Per Triwulan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vReindikatorProgram', $this->data);
	}

	public function savetargetindikatorprogram()
	{
		$this->mprogram->UpdateReIndikatorProgram();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/reindikatorprogram/triwulan');
		} else {
			redirect('skpd/reindikatorprogram');
		}
	}
}

/* End of file Reindikatorprogram.php */
/* Location: ./application/controllers/skpd/Reindikatorprogram.php */