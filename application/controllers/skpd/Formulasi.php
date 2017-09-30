<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulasi extends Skpd 
{
	
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Sasaran',  $this->uri->uri_string());

		$this->load->model(array('mformulasi'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Formulasi ',  $this->uri->uri_string());

		$this->page_title->push('Formulasi', 'Formulasi / Instrumen Pengukuran per Indikator');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Formulasi ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vFormulasi', $this->data);
	}

	public function save()
	{
		$this->mformulasi->Update_formulasi();

		redirect("skpd/formulasi");
	}

	

}

/* End of file .php */
/* Location: ./application/controllers/skpd/.php */