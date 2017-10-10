<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Laporan',  'skpd/report/renstra');

		$this->load->model(array('mprogram','mstrategi','tjuan','kgiatan','mvisi','kbjakan'));

		$this->load->helper(array('indonesia'));
	}

	public function index()
	{
		$this->page_title->push('Laporan', ' Perjanjian Kinerja');

		$this->breadcrumbs->unshift(2, ' Perjanjian Kinerja',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => " Perjanjian Kinerja", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);	

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				$this->load->view('skpd/report/print/perjanjiankinerja', $this->data);
				break;
			case 'pdf':
			    $this->pdf->setPaper('legal', 'potrait');
			    $this->pdf->filename = strtoupper($this->data['title']).".pdf";
			    $this->pdf->load_view('skpd/report/print/perjanjiankinerja', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/perjanjianKinerja', $this->data);
				break;
		}
	}

	public function perubahan()
	{
		$this->page_title->push('Laporan', ' Perjanjian Kinerja Perubahan');

		$this->breadcrumbs->unshift(2, ' Perjanjian Kinerja Perubahan',  $this->uri->uri_string());

		$this->tahun = ($this->input->get('thn')=='') ? $this->periode_awal : $this->input->get('thn');

		$this->data = array(
			'title' => " Perjanjian Kinerja Perubahan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		switch ( $this->input->get('output') ) 
		{
			case 'print':
				$this->load->view('skpd/report/print/perjanjiankinerjaPerubahan', $this->data);
				break;
			case 'pdf':
			    $this->pdf->setPaper('legal', 'potrait');
			    $this->pdf->filename = strtoupper($this->data['title']).".pdf";
			    $this->pdf->load_view('skpd/report/print/perjanjiankinerjaPerubahan', $this->data);
				break;
			case 'excel':
				show_error('On Progress!');
				break;
			default:
				$this->template->view('skpd/report/perjanjianKinerjaPerubahan', $this->data);
				break;
		}
	}

}

/* End of file Pk.php */
/* Location: ./application/controllers/skpd/report/Pk.php */