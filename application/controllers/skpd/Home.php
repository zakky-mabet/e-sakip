<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Skpd {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('setting');
	}

	public function index() 
	{
		$this->page_title->push('Dashboard', 'Selamat datang di Administrator');

		$this->data = array(
			'title' => "Main Dashboard", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);

		$this->template->view('skpd/v_home', $this->data);
	}

	public function cascading()
	{
		$this->breadcrumbs->unshift(2, 'Cascading', "administrator/home");

		$this->page_title->push('Cascading', ' Alur Pengisian Data');

		$this->data = array(
			'title' => "Cascading", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);

		$this->template->view('skpd/cascading', $this->data);
	}
}
