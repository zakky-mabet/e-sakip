<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Visi',  $this->uri->uri_string());

		$this->load->model(array('mvisi'));
	}

	public function index()
	{
		$this->page_title->push('Visi', 'Visi Rencana Strategis');

		$this->form_validation->set_rules('visi', 'Visi', 'trim|required');
		$this->form_validation->set_rules('penjabaran', 'Penjabaran Visi', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mvisi->create();

			redirect(current_url());
		}

		$this->data = array(
			'title' => "Visi", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vVisi', $this->data);
	}

}

/* End of file Visi.php */
/* Location: ./application/controllers/skpd/Visi.php */