<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misi extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Misi', "home");
	}
	public function index()
	{
		$this->page_title->push('Misi', 'Selamat datang di Administrator');

		$this->data = array(
			'title' => "Main Dashboard", 
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			);

		$this->template->view('skpd/v_home', $this->data);
	}

}

/* End of file Misi.php */
/* Location: ./application/controllers/skpd/Misi.php */