<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kebijakan',  $this->uri->uri_string());

		$this->load->model(array('mprogram'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Program', 'Kebijakan Rencana Strategis');

		$this->data = array(
			'title' => "Program Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vProgram', $this->data);
	}

	public function createupdate()
	{
		$this->mprogram->CreateUpdate();

		redirect('skpd/program');
	}

	public function delete($param = 0, $key = '')
	{
		$this->results = $this->mprogram->delete($param, $key);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->results));
	}

	public function indikator()
	{
		$this->page_title->push('Program', 'Indikator Kinerja Program');

		$this->data = array(
			'title' => "Indikator Kinerja Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vIndikatorProgram', $this->data);
	}

}

/* End of file Program.php */
/* Location: ./application/controllers/skpd/Program.php */