<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends Skpd 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Sasaran',  $this->uri->uri_string());

		$this->load->model(array('mtarget','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Sasaran Target',  $this->uri->uri_string());

		$this->page_title->push('Target', 'Sasaran Target');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Sasaran Target", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vTarget', $this->data);
	}

	public function save()
	{
		$this->mtarget->Update_nilai_target();
		
		redirect("skpd/target");
	}

	

}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */