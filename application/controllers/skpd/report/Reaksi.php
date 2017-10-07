<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reaksi extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', 'Rencana Aksi');

		$this->breadcrumbs->unshift(2, 'Rencana Aksi',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => "Rencana Aksi", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				$this->load->view('skpd/report/print/vreaksi', $this->data);
				break;
			case 'pdf':
			    $this->pdf->setPaper('legal', 'landscape');
			    $this->pdf->filename = strtoupper($this->data['title']).".pdf";
			    $this->pdf->load_view('skpd/report/print/vreaksi', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/vReaksi', $this->data);	
				break;
		}
	}

}

/* End of file Reaksi.php */
/* Location: ./application/controllers/skpd/report/Reaksi.php */