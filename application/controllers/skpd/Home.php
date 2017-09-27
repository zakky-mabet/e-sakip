<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Skpd {

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(0, 'Home', "administrator/home");
	}

	public function index() 
	{
		
		$this->page_title->push('Dashboard', 'Selamat datang di Administrator');

		$this->data = array(
			'title' => "Main Dashboard", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/v_home', $this->data);
	}

}
