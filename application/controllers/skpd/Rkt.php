<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkt extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Rencana Kinerja Tahunan',  $this->uri->uri_string());

		$this->load->model(array('mrkt','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Rencana Kinerja Tahunan ',  $this->uri->uri_string());

		$this->page_title->push('RKT', 'Target Indikator Rencana Kinerja Tahunan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Rencana Kinerja Tahunan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRkt', $this->data);
	}

	public function save()
	{
		$this->mrkt->Update();

		redirect("skpd/rkt");
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */