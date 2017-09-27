<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misi extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array('m_misi'));

		$this->breadcrumbs->unshift(1, 'Misi',  $this->uri->uri_string());
	}

	public function index()
	{
		$this->page_title->push('Misi', 'Misi Rencana Strategis');

		$this->data = array(
			'title' => "Misi", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'misi' => $this->m_misi->get_misi(),
		);

		$this->form_validation->set_rules('input_misi[][misi]', 'Misi', 'trim|required');

	    if ($this->form_validation->run() == TRUE){

	        $this->m_misi->create();
	        redirect(current_url());
	    }

		$this->template->view('skpd/vMisi', $this->data);
	}

}

/* End of file Misi.php */
/* Location: ./application/controllers/skpd/Misi.php */