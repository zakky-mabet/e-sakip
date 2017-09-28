<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebijakan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Kebijakan',  $this->uri->uri_string());

		$this->load->model(array('tjuan','mstrategi','kbjakan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Kebijakan', 'Kebijakan Rencana Strategis');

		$this->data = array(
			'title' => "Kebijakan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vKebijakan', $this->data);
	}

	public function createupdate()
	{
		$this->kbjakan->CreateUpdate();

		redirect('skpd/kebijakan');
	}

	public function delete($param = 0)
	{
		$this->response = $this->kbjakan->delete($param);
		return $this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}
}

/* End of file Kebijakan.php */
/* Location: ./application/controllers/skpd/Kebijakan.php */