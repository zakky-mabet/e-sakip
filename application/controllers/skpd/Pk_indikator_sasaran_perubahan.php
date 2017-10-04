<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk_indikator_sasaran_perubahan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Penetapan Kinerja Tahunan Perubahan',  $this->uri->uri_string());

		$this->load->model(array('mpk_indikator_sasaran_perubahan','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja Tahunan Perubahan ',  $this->uri->uri_string());

		$this->page_title->push('PK', 'Target Indikator Penetapan Kinerja Tahunan Perubahan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja Tahunan Perubahan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPk_indikator_sasaran_perubahan', $this->data);
	}

	public function triwulan()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja Triwulan Perubahan ',  $this->uri->uri_string());

		$this->page_title->push('PK', 'Target Indikator Penetapan Kinerja Triwulan Perubahan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja Triwulan Perubahan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPk_indikator_sasaran_Triwulan_Perubahan', $this->data);
	}

	public function save()
	{
		$this->mpk_indikator_sasaran_perubahan->UpdateTriwulan();
	
		redirect("skpd/Pk_indikator_sasaran_perubahan/triwulan");
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */