<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends Skpd 
{
	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Master Satuan',  $this->uri->uri_string());

		$this->load->model(array('msatuan'));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}
	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Master Satuan',  $this->uri->uri_string());

		$this->page_title->push('Master Satuan', 'Master Satuan Indikator');

		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->msatuan->create();

			redirect(current_url());
		}

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("skpd/satuan?per_page={$this->per_page}&query={$this->query}&skpd={$this->input->get('skpd')}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->msatuan->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Master Satuan", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'satuan' => $this->msatuan->getall($this->per_page, $this->page, 'result')
		);

		$this->template->view('skpd/satuan/indexSatuan', $this->data);	
	}

	public function getsatuanjson($param = 0)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->msatuan->get($param)));
	}

	public function updatesatuan($param = 0)
	{
		$this->msatuan->update($param);

		$this->response = array(
			'status' => 'success'
		);	
		$this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}

	public function delete($param = 0)
	{
		$this->msatuan->delete($param);

		redirect('skpd/satuan');
	}

}

/* End of file Satuan.php */
/* Location: ./application/controllers/skpd/Satuan.php */