<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rrkt extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', 'Rencana Kinerja Tahunan');

		$this->breadcrumbs->unshift(2, 'Rencana Kinerja Tahunan',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => "Rencana Kinerja Tahunan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);

		$this->template->view('skpd/report/IndexRkt', $this->data);
	}

}

/* End of file Rrkt.php */
/* Location: ./application/controllers/skpd/report/Rrkt.php */