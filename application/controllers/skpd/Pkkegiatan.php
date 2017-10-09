<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkkegiatan extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Perjanjian Kinerja',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));
	}

	public function index()
	{
		$this->page_title->push('Perjanjian Kinerja', 'Target PK Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target PK Output Kegiatan',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKOutputKegiatan', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('Perjanjian Kinerja', 'Target PK Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target PK Output Kegiatan',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKOutputKegiatan', $this->data);
	}

	public function savepkoutputkegiatan()
	{
		$this->kgiatan->UpdatePKOutputKegiatan();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/pkkegiatan/triwulan');
		} else {
			redirect('skpd/pkkegiatan');
		}
	}
}

/* End of file Pkkegiatan.php */
/* Location: ./application/controllers/skpd/Pkkegiatan.php */