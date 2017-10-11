<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends Skpd 
{
	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->load->model(array('mprogram','mstrategi','tjuan','mprestasi'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Prestasi',  $this->uri->uri_string());

		$this->page_title->push('Prestasi', 'Prestasi Organisasi Perangkat Daerah');

		$this->form_validation->set_rules('prestasi', 'Prestasi', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mprestasi->create();

			redirect(current_url());
		}

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			skpd/prestasi?per_page={$this->per_page}&thn={$this->input->get('thn')}&tingkat={$this->input->get('tingkat')}&query={$this->query}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mprestasi->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Program", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'prestasi' => $this->mprestasi->getall($this->per_page, $this->page, 'result')
		);

		$this->template->view('skpd/prestasi/indexPrestasi', $this->data);	
	}

	public function getprestasijson($param = 0)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->mprestasi->get($param)));
	}

	public function updateprestasi($param = 0)
	{
		$this->mprestasi->update($param);

		$this->response = array(
			'status' => 'success'
		);	
		$this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}

	public function delete($param = 0)
	{
		$this->mprestasi->delete($param);

		redirect('skpd/prestasi');
	}

}

/* End of file Prestasi.php */
/* Location: ./application/controllers/skpd/Prestasi.php */