<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Dashboard',  'admin/main');
	}

	public function index()
	{
		$this->page_title->push('Dashboard', 'Halaman Utama');
		$this->data = array(
			'title' => "Dashboard", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->admin('admin/main', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/admin/Main.php */