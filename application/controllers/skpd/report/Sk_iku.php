<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sk_iku extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/sk_ibu');

		$this->load->model(array('msk_iku_report'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Surat Keputusan Indikator Kinerja Utama');

		$this->breadcrumbs->unshift(2, ' Surat Keputusan Indikator Kinerja Utama',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => " Surat Keputusan Indikator Kinerja Utama", 
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
				$this->template->view('skpd/report/SK_IKU', $this->data);
				break;
		}
	}

	

}

/* End of file Iku.php */
/* Location: ./application/controllers/skpd/report/Iku.php */