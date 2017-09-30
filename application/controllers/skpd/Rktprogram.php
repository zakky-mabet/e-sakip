<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rktprogram extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'RKT',  'skpd/rkt');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('RKT', 'Target RKT Indikator Program');

		$this->breadcrumbs->unshift(2, 'Target RKT Indikator Program',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target RKT Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRktIndikatorProgram', $this->data);
	}

	public function saveindikatorprogram()
	{
		$this->mprogram->SaveRktIndikatorProgram();

		redirect('skpd/rktprogram');
	}

	public function rktoutputkegiatan()
	{
		$this->page_title->push('RKT', 'Target RKT Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target RKT Output Kegiatan',  'skpd/rktoutputkegiatan');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target RKT Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRktOutputKegiatan', $this->data);
	}

	public function saverktoutputkegiatan()
	{
		$this->kgiatan->SaveRktOutputKegiatan();

		redirect('skpd/rktprogram/rktoutputkegiatan');
	}

	public function anggaranprogramrkt()
	{
		$this->page_title->push('RKT', 'Program dan Anggaran Rencana Kinerja Tahunan');

		$this->breadcrumbs->unshift(2, 'Program dan Anggaran Rencana Kinerja Tahunan',  'skpd/anggaranprogramrkt');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Program dan Anggaran Rencana Kinerja Tahunan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vAnggaranProgramRkt', $this->data);
	}

	public function anggarankegiatanrkt()
	{
		$this->page_title->push('RKT', 'Anggaran Kegiatan Rencana Kinerja Tahunan');

		$this->breadcrumbs->unshift(2, 'Anggaran Kegiatan Rencana Kinerja Tahunan',  'skpd/anggarankegiatanrkt');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Anggaran Kegiatan Rencana Kinerja Tahunan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vAnggaranKegiatanRkt', $this->data);
	}

	public function saveanggarankegiatanrkt()
	{
		$this->mprogram->UpdateAnggaranKegiatanRkt();

		redirect('skpd/rktprogram/anggarankegiatanrkt');
	}
}

/* End of file Rktprogram.php */
/* Location: ./application/controllers/skpd/Rktprogram.php */