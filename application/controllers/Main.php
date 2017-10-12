<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->data = array(
			'title' => "E-SAKIP Sistem Informasi Akuntabilitas Kinerja Instansi Pemerintah - Kab. Bangka Tengah"
		);

		$this->load->view('main-index', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */