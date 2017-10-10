<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capaian_indikator_kinerja_strategis extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('msasaran_report'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Indikator Kinerja Strategis');

		$this->breadcrumbs->unshift(2, ' Indikator Kinerja Strategis',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => "Capaian Indikator Kinerja Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),

		);	

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				$this->load->view('skpd/report/print/indexiku', $this->data);
				break;
			case 'pdf':
			    $this->pdf->setPaper('legal', 'potrait');
			    $this->pdf->filename = strtoupper($this->data['title']).".pdf";
			    $this->pdf->load_view('skpd/report/print/indexiku', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/Capaian_IKS', $this->data);
				break;
		}
	}

	

}

/* End of file Iku.php */
/* Location: ./application/controllers/skpd/report/Iku.php */