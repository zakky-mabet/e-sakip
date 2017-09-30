<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk_indikator_sasaran extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Rencana Kinerja Tahunan',  $this->uri->uri_string());

		$this->load->model(array('mpk_indikator_sasaran','msasaran'));

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

		$this->template->view('skpd/vPk_indikator_sasaran', $this->data);
	}

	public function save()
	{
		$this->mpk_indikator_sasaran->Update();

		redirect("skpd/pk_indikator_sasaran");
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */