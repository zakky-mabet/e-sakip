<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kegiatan',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}
	public function index()
	{
		$this->page_title->push('Kegiatan', 'Kegiatan Rencana Strategis');

		$this->data = array(
			'title' => "Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vKegiatan', $this->data);
	}

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/skpd/Kegiatan.php */