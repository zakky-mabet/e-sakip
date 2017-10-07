<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends Admin_panel 
{
	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Dashboard',  'admin/main');

		$this->query = $this->input->get('q');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'OPD',  'admin/opd');
		$this->page_title->push('OPD', 'Organisasi Perangkat Daerah');

		$this->data = array(
			'title' => "Organisasi Perangkat Daerah", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->admin('admin/opd/dataSkpd', $this->data);
	}

}

/* End of file Opd.php */
/* Location: ./application/controllers/admin/Opd.php */