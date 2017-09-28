<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Strategi extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Strategi',  $this->uri->uri_string());

		$this->load->model(array('tjuan','mstrategi'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}
	public function index()
	{
		$this->page_title->push('Strategi', 'Strategi Rencana Strategis');

		$this->data = array(
			'title' => "Tujuan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vStrategi', $this->data);
	}

}

/* End of file Strategi.php */
/* Location: ./application/controllers/skpd/Strategi.php */