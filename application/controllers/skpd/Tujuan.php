<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tujuan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Tujuan',  $this->uri->uri_string());

		$this->load->model(array('tjuan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Tujuan', 'Tujuan Rencana Strategis');

		$this->data = array(
			'title' => "Tujuan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vTujuan', $this->data);
	}

	public function createupdate()
	{
		$this->tjuan->CreateUpdate();

		redirect("skpd/tujuan");
	}
}

/* End of file Tujuan.php */
/* Location: ./application/controllers/skpd/Tujuan.php */