<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkperubahankegiatan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'PK Perubahan',  'skpd/pkperubahankegiatan');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));
	}

	public function index()
	{
		$this->page_title->push('PK Perubahan', 'Target PK Perubahan Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target PK Perubahan Output Kegiatan',  'skpd/pkperubahankegiatan');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Perubahan Tahunan Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKPerubahanOutputKegiatan', $this->data);
	}

	public function triwulan()
	{
		$this->page_title->push('PK Perubahan', 'Target PK Perubahan Output Kegiatan');

		$this->breadcrumbs->unshift(2, 'Target PK Perubahan Output Kegiatan',  'skpd/pkperubahankegiatan');

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Target PK Perubahan Triwulan Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vPKPerubahanOutputKegiatan', $this->data);
	}

	public function saveoutputkegiatan()
	{
		$this->kgiatan->UpdatePKPerubahanOutputKegiatan();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/pkperubahankegiatan/triwulan');
		} else {
			redirect('skpd/pkperubahankegiatan');
		}
	}
}

/* End of file Pkperubahankegiatan.php */
/* Location: ./application/controllers/skpd/Pkperubahankegiatan.php */