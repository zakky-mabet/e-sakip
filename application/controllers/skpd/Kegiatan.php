<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kegiatan',  'skpd/kegiatan');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Kegiatan', 'Kegiatan Rencana Strategis');

		$this->data = array(
			'title' => "Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vKegiatan', $this->data);
	}

	public function createupdate()
	{
		$this->kgiatan->CreateUpdate();

		redirect('skpd/kegiatan');
	}

	public function penanggungjawab()
	{
		$this->page_title->push('Penanggung Jawab Kegiatan', '');

		$this->breadcrumbs->unshift(2, 'Penanggung Jawab Kegiatan',  $this->uri->uri_string());

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Penanggung Jawab Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPenanggungJawabKegiatan', $this->data);
	}

	public function savepenanggungjawab()
	{
		$this->kgiatan->Updatepenanggungjawab();

		redirect("skpd/kegiatan/penanggungjawab/{$this->periode_awal}");
	}

	public function anggaran()
	{
		$this->page_title->push('Anggaran Kegiatan', '');

		$this->breadcrumbs->unshift(2, 'Anggaran Kegiatan',  $this->uri->uri_string());

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Anggaran Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vAnggaranKegiatan', $this->data);
	}

	public function saveanggaran()
	{
		$this->kgiatan->UpdateAnggaranKegiatan();

		redirect("skpd/kegiatan/anggaran/{$this->periode_awal}");
	}

	public function output()
	{
		$this->page_title->push('Output Kegiatan', '');

		$this->breadcrumbs->unshift(2, 'Output Kegiatan',  $this->uri->uri_string());

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Output Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vOutputKegiatan', $this->data);
	}

	public function ouput_createupdate()
	{
		$this->kgiatan->OutputKegiatanCreateUpdate();

		redirect('skpd/kegiatan/output');
	}

	public function target()
	{
		$this->page_title->push('Target Output Kegiatan', '');

		$this->breadcrumbs->unshift(2, 'Target Output Kegiatan',  $this->uri->uri_string());

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Output Kegiatan Rencana Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vTargetOutputKegiatan', $this->data);
	}

	public function savatargetoutput()
	{
		$this->kgiatan->SaveTargetOutputKegiatan();

		redirect("skpd/kegiatan/target/{$this->periode_awal}");
	}

	public function delete($param = 0, $key = '')
	{
		$this->response = $this->kgiatan->delete($param, $key);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}
}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/skpd/Kegiatan.php */