<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkt extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'RKT',  'skpd/rkt');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('RKT', 'Target Indikator Rencana Kinerja Tahunan');

		$this->data = array(
			'title' => "Target Indikator Rencana Kinerja Tahunan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRktIndikatorKinerjaSasaran', $this->data);
	}

}

/* End of file Rkt.php */
/* Location: ./application/controllers/skpd/Rkt.php */