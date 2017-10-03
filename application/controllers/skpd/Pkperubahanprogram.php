<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkperubahanprogram extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'PK Perubahan',  'skpd/pkperubahanprogram');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->page_title->push('PK Perubahan', 'Target PK Perubahan Indikator Program');

		$this->breadcrumbs->unshift(2, 'Target PK Perubahan Indikator Program',  'skpd/pkperubahanprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Perubahan Indikator Program Tahunan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKPerubahanIndikatorProgram', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('PK Perubahan', 'Target PK Perubahan Indikator Program');

		$this->breadcrumbs->unshift(2, 'Target PK Perubahan Indikator Program',  'skpd/pkperubahanprogram');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Perubahan Indikator Program Triwulan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKPerubahanIndikatorProgram', $this->data);
	}

	public function savetargetindikatorprogram()
	{
		$this->mprogram->UpdateTargePKPerubahantTargetIndikatorProgram();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/pkperubahanprogram/triwulan');
		} else {
			redirect('skpd/pkperubahanprogram');
		}
	}
}

/* End of file Pkperubahanprogram.php */
/* Location: ./application/controllers/skpd/Pkperubahanprogram.php */