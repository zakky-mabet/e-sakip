<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Program',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Program', 'Kebijakan Rencana Strategis');

		$this->data = array(
			'title' => "Program Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vProgram', $this->data);
	}

	public function createupdate()
	{
		$this->mprogram->CreateUpdate();

		redirect('skpd/program');
	}

	public function delete($param = 0, $key = '')
	{
		$this->results = $this->mprogram->delete($param, $key);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->results));
	}

	public function indikator()
	{
		$this->breadcrumbs->unshift(2, 'Indikator Kinerja Program',  $this->uri->uri_string());

		$this->page_title->push('Program', 'Indikator Kinerja Program');

		$this->data = array(
			'title' => "Indikator Kinerja Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vIndikatorProgram', $this->data);
	}

	public function indikator_createupdate()
	{
		$this->mprogram->IndikatorCreateUpdate();

		redirect('skpd/program/indikator');	
	}

	public function anggaran()
	{
		$this->breadcrumbs->unshift(2, 'Anggaran Program',  $this->uri->uri_string());

		$this->page_title->push('Program', 'Anggaran Program');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Anggaran Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vAnggaranProgram', $this->data);
	}

	public function target()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Program',  $this->uri->uri_string());

		$this->page_title->push('Program', 'Target Indikator Program');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vTargetIndikatorProgram', $this->data);
	}

	public function savenilaitarget()
	{
		$this->mprogram->SaveNilaiTargetProgramIndikator();

		redirect("skpd/program/target/{$this->periode_awal}");	
	}

	public function saveanggaran()
	{
		echo "<pre>";
		print_r ($this->input->post());
		echo "</pre>";
		exit('Now in progress!');
	}

}

/* End of file Program.php */
/* Location: ./application/controllers/skpd/Program.php */