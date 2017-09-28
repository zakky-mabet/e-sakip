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

	public function delete($param = 0, $key = '')
	{
		$this->results = $this->tjuan->delete($param, $key);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->results));
	}

	public function indikator_tujuan()
	{
		$this->page_title->push('Tujuan', 'Indikator Tujuan');

		$this->breadcrumbs->unshift(2, 'Indikator Tujuan',  $this->uri->uri_string());

		$this->data = array(
			'title' => "Indikator Tujuan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vIndikatorTujuan', $this->data);
	}

	public function createupdateindikator()
	{
		$this->tjuan->createupdateindikator();

		redirect("skpd/tujuan/indikator_tujuan");
	}
}

/* End of file Tujuan.php */
/* Location: ./application/controllers/skpd/Tujuan.php */