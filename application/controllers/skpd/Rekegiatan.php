<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekegiatan extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->breadcrumbs->unshift(2, 'Realisasi Output Kegiatan',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan'));

		$this->tahun = $this->periode_awal;
	}

	public function index()
	{
		$this->page_title->push('Kinerja', 'Capaian Kinerja Output Kegiatan');

		$this->data = array(
			'title' => "Capaian Kinerja Output Kegiatan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vReindikatorOutputKegiatan', $this->data);	
	}

	public function triwulan()
	{
		$this->index();
	}

	public function saverealisasioutput()
	{
		$this->kgiatan->UpdateReOutputKegiatan();

		if( $this->input->post('type')=='triwulan') 
		{
			redirect('skpd/rekegiatan/triwulan');
		} else {
			redirect('skpd/rekegiatan');
		}
	}

}

/* End of file Rekegiatan.php */
/* Location: ./application/controllers/skpd/Rekegiatan.php */