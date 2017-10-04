<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panggarankegiatan extends Skpd 
{
	public function __construct()
	{
		parent::__construct();
		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->load->model(array('mprogram','kgiatan','tjuan','mprestasi'));

		$this->load->js(base_url("assets/public/app/inputan.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Penyerapan Anggaran',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Penyerapan Anggaran Kegiatan');

		$this->data = array(
			'title' => "Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);

		$this->template->view('skpd/pAnggaranKegiatan', $this->data);	
	}

	public function update($param = 0)
	{
		$this->kgiatan->updatePAnggaranKegiatan( $param );
		
		$this->response = array(
			'status' => 'success'
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}

}

/* End of file Panggarankegiatan.php */
/* Location: ./application/controllers/skpd/Panggarankegiatan.php */