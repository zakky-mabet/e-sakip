<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Sasaran',  $this->uri->uri_string());

		$this->load->model(array('msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
		$this->load->js(base_url("assets/public/app/zdynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Sasaran', 'Sasaran Rencana Strategis');

		$this->data = array(
			'title' => "Sasaran Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'master_sasaran' => $this->msasaran->master_sasaran(),
		);

		$this->template->view('skpd/vSasaran', $this->data);
	}

	public function createupdate()
	{
		$this->msasaran->CreateUpdate();

		redirect("skpd/sasaran");
	}

	public function indikatorcreateupdate()
	{
		$this->msasaran->IndikatorCreateUpdate();

		redirect("skpd/sasaran/indikator_sasaran");
	}

	public function delete($param = 0, $key = '')
	{
		$this->results = $this->msasaran->delete($param, $key);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->results));
	}

	public function indikator_sasaran()
	{
		$this->page_title->push('Sasaran', 'Indikator Sasaran');

		$this->breadcrumbs->unshift(2, 'Indikator Sasaran',  $this->uri->uri_string());

		$this->data = array(
			'title' => "Indikator Sasaran", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vIndikatorSasaran', $this->data);
	}

	

	public function post()
	{
		echo '<pre>';
		print_r($this->input->post());
		//$this->msasaran->CreateUpdate();
	}

	public function createmasalah()
	{

		print_r($this->input->post());
		
		$this->msasaran->createmasalah();

		redirect("skpd/sasaran");
	}

	public function id($param)
	{

		print_r(array($this->db->insert_id()));
		
	}


}

/* End of file Tujuan.php */
/* Location: ./application/controllers/skpd/Tujuan.php */