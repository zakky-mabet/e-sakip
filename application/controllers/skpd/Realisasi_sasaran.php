<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_sasaran extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->load->model(array('mrealisasi_sasaran','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
		$this->load->js(base_url("assets/public/app/zdynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Realisasi Indikator  ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Capaian Kinerja Indikator Sasaran Per Tahun');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Capaian Kinerja Indikator Sasaran Per Tahun", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRealisasi_sasaran', $this->data);
	}

	public function save()
	{
		$this->mrealisasi_sasaran->Update();
		
		redirect("skpd/realisasi_sasaran");
		// echo '<pre>';
		// print_r($this->input->post());
	}


	public function updateanalisis()
	{
		$this->mrealisasi_sasaran->Update_analisis();
		
		redirect("skpd/realisasi_sasaran");
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */