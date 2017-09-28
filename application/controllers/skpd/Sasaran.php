<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran extends Skpd 
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

		$this->template->view('skpd/vMisi', $this->data);
	}

	public function createorupdate()
	{
		$this->m_misi->createorupdate();
		
		redirect("skpd/misi");
		
	}
	public function delete($param = 0)
    {
        $this->m_misi->delete($param);

        redirect('skpd/misi');
    }

}

/* End of file Misi.php */
/* Location: ./application/controllers/skpd/Misi.php */