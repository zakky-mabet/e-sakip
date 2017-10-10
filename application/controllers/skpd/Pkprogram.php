<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkprogram extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Perjanjian Kinerja',  'skpd/pkprogram');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('Perjanjian Kinerja', 'Target PK Indikator Program');

		$this->breadcrumbs->unshift(2, 'Target PK Indikator Program',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKIndikatorProgram', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('Perjanjian Kinerja', 'Target PK Triwulan Indikator Program');

		$this->breadcrumbs->unshift(2, 'Triwulan',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Triwulan Indikator Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKIndikatorProgram', $this->data);
	}

	public function savetargetindikatorprogram()
	{
		$this->mprogram->UpdateTargePKtTargetIndikatorProgram();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/pkprogram/triwulan');
		} else {
			redirect('skpd/pkprogram');
		}
	}

	public function anggaranprogram()
	{
		$this->page_title->push('Perjanjian Kinerja', ' Program dan Anggaran Penetapan Kinerja');

		$this->breadcrumbs->unshift(2, ' Program dan Anggaran Penetapan Kinerja',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Program dan Anggaran Penetapan Kinerja", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKAnggaranProgram', $this->data);
	}

	public function anggarankegiatan()
	{
		$this->page_title->push('Perjanjian Kinerja', ' Anggaran Kegiatan Penetapan Kinerja');

		$this->breadcrumbs->unshift(2, ' Anggaran Kegiatan Penetapan Kinerja',  'skpd/rktprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Anggaran Kegiatan Penetapan Kinerja", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKAnggaranKegiatan', $this->data);
	}

	public function savepkanggaran()
	{
		$this->mprogram->UpdateAnggaranKegiatanPK();

		redirect('skpd/pkprogram/anggarankegiatan');
	}

}

/* End of file Pkprogram.php */
/* Location: ./application/controllers/skpd/Pkprogram.php */