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

	public function createupdatemasalah()
	{
		
		$this->msasaran->CreateUpdatemasalah();

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


	public function delete_akar($param = 0)
	{
		$this->msasaran->delete_akar($param);

		redirect("skpd/sasaran/");
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

	

	public function createmasalah()
	{

		
		$this->msasaran->createmasalah();

		redirect("skpd/sasaran");
	}


	public function permasalahan($param=0)
	{
		if (!$param) {
			redirect('404');
		}

		if (count($this->msasaran->get_sasaran_to_permasalahan_sasaran($param)) == NULL) {
			redirect('404');
		}

		$this->page_title->push('Sasaran', 'Permasalahan Sasaran dan Akar Permasalahan');

		$this->breadcrumbs->unshift(2, 'Permasalahan Sasaran',  $this->uri->uri_string());

		$this->data = array(
			'title' => "Permasalahan Sasaran dan Akar Permasalahan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'param' => $param,
		);

		$this->template->view('skpd/vPermasalahanSasaran', $this->data);			
	}	

	public function permasalahan_update($param = 0)
	{	
		$this->msasaran->permasalahan_update();
		 echo '<pre>';
		 print_r($this->input->post());
		//redirect("skpd/sasaran/permasalahan/".$param);	
	}

}

/* End of file Tujuan.php */
/* Location: ./application/controllers/skpd/Tujuan.php */