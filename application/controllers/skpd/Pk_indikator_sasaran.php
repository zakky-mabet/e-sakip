<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk_indikator_sasaran extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Penetapan Kinerja Tahunan',  $this->uri->uri_string());

		$this->load->model(array('mpk_indikator_sasaran','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja Tahunan ',  $this->uri->uri_string());

		$this->page_title->push('PK', 'Target Indikator Penetapan Kinerja Tahunan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja Tahunan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPk_indikator_sasaran', $this->data);
	}

	public function triwulan()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja Triwulan ',  $this->uri->uri_string());

		$this->page_title->push('PK', 'Target Indikator Penetapan Kinerja Triwulan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja Triwulan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPk_indikator_sasaran_Triwulan', $this->data);
	}

	public function save()
	{
		$this->mpk_indikator_sasaran->Update();

		redirect("skpd/pk_indikator_sasaran");
		// echo '<pre>';
		//  print_r($this->input->post());
	}

	public function savetriwulan()
	{
		$this->mpk_indikator_sasaran->UpdateTriwulan();

		redirect("skpd/pk_indikator_sasaran/triwulan");
		// echo '<pre>';
		// print_r($this->input->post());
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */