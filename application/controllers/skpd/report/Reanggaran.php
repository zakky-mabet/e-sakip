<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reanggaran extends Skpd 
{
	public $tahun;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Pagu dan Realisasi Anggaran');

		$this->breadcrumbs->unshift(2, ' Pagu dan Realisasi Anggaran',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => " Pagu dan Realisasi Anggaran", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);	

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				$this->load->view('skpd/report/print/reanggaran', $this->data);
				break;
			case 'pdf':
			    $this->pdf->setPaper('legal', 'landscape');
			    $this->pdf->filename = strtoupper($this->data['title']).".pdf";
			    $this->pdf->load_view('skpd/report/print/reanggaran', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/vReanggaran', $this->data);
				break;
		}
	}


}

/* End of file Reanggaran.php */
/* Location: ./application/controllers/skpd/report/Reanggaran.php */