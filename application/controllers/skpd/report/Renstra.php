<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renstra extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', 'Rencanan Strategis');

		$this->breadcrumbs->unshift(2, 'Rencanan Strategis',  $this->uri->uri_string());

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Rencanan Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);

		$this->template->view('skpd/report/IndexRenstra', $this->data);
	}
	public function laporan_pdf()
	{

	    $data = array(
	        "dataku" => array(
	            "nama" => "Petani Kode",
	            "url" => "http://petanikode.com"
	        )
	    );

	    $this->load->library('pdf');

	    $this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = "laporan-petanikode.pdf";
		$this->page_title->push('Laporan', 'Rencanan Strategis');

		$this->breadcrumbs->unshift(2, 'Rencanan Strategis',  $this->uri->uri_string());

		$this->tahun = $this->periode_awal;

		$this->data = array(
			'title' => "Rencanan Strategis", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'visi' => $this->mvisi->getByLogin(),
		);

		$this->pdf->load_view('skpd/report/IndexRenstra', $this->data);

	}
}

/* End of file Renstra.php */
/* Location: ./application/controllers/skpd/report/Renstra.php */