<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends Admin_panel 
{
	public $query;

	public $page;

	public $per_page;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'OPD',  'admin/opd');

		$this->query = $this->input->get('q');

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->load->model(array('mopd'));

		$this->load->js(base_url("assets/admin/appjs/opd.js"));
	}

	public function index()
	{
		$this->page_title->push('OPD', 'Organisasi Perangkat Daerah');

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			skpd/prestasi?per_page={$this->per_page}&query={$this->query}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mopd->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Organisasi Perangkat Daerah", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'opd' => $this->mopd->getAll($this->per_page, $this->page, 'result')
		);

		$this->template->admin('admin/opd/dataSkpd', $this->data);
	}

	public function create()
	{
		$this->breadcrumbs->unshift(2, 'Tambah',  'admin/opd/create');
		$this->page_title->push('Tambah OPD', 'Organisasi Perangkat Daerah');
				
		$this->form_validation->set_rules('nama_opd', 'Nama OPD', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
		$this->form_validation->set_rules('phone', 'No Telepon', 'trim|required');

		$this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_username|required');
		$this->form_validation->set_rules('new_pass', 'Password', 'trim|min_length[8]|max_length[12]|required');
		$this->form_validation->set_rules('repeat_new_pass', 'Ini', 'trim|matches[new_pass]|required');

		if ($this->form_validation->run() == TRUE) 
		{
			$this->mopd->create();
			redirect('admin/opd/create');
		}

		$this->data = array(
			'title' => "Tambah :: Organisasi Perangkat Daerah", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->admin('admin/opd/createSkpd', $this->data);
	}

	public function update($param = 0)
	{
		$opd = $this->mopd->get($param);

		if( !$opd )
			show_404();

		$this->breadcrumbs->unshift(2, 'Update',  'admin/opd/update');
		$this->page_title->push('Update OPD', 'Organisasi Perangkat Daerah');
				
		$this->form_validation->set_rules('nama_opd', 'Nama OPD', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
		$this->form_validation->set_rules('phone', 'No Telepon', 'trim|required');

		$this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_username');
		$this->form_validation->set_rules('new_pass', 'Password', 'trim|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('repeat_new_pass', 'Ini', 'trim|matches[new_pass]');

		if ($this->form_validation->run() == TRUE) 
		{
			$this->mopd->update($param);
			redirect("admin/opd/update/{$param}");
		}

		$this->data = array(
			'title' => "Update :: Organisasi Perangkat Daerah", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'opd' => $opd
		);

		$this->template->admin('admin/opd/updateSkpd', $this->data);
	}

	public function validate_username()
	{
		if($this->mopd->username_check($this->input->post('ID')) == TRUE)
		{
			$this->form_validation->set_message('validate_username', 'Maaf Username telah digunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function delete($param = 0)
	{
		$this->mopd->deleteAll($param);
	}
}

/* End of file Opd.php */
/* Location: ./application/controllers/admin/Opd.php */