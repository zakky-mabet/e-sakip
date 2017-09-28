<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		

	}
}

/**
* Extends Class Skpd
*
* @version 1.0.0
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
*/
class Skpd extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library( array('session', 'form_validation', 'session','template','pagination', 'page_title', 'breadcrumbs'));

		$this->load->helper(array('url','menus'));
		
		$this->breadcrumbs->unshift(0, 'Home', "home");

		if($this->session->has_userdata('SKPD')==FALSE) 
		{	
			redirect(site_url('login?from_url='.current_url()));
		}

		$this->load->js(base_url("assets/public/app/component.js"));
	}

	public function get_satuan_json()
	{
		$query = $this->db->get('master_satuan')->result();
		return $this->output->set_content_type('application/json')->set_output(json_encode($query));
	}

	public function get_sasaran_json()
	{
		$query = $this->db->get_where('master_sasaran', array('id_skpd' => $this->session->userdata('SKPD')->ID ))->result();
		return $this->output->set_content_type('application/json')->set_output(json_encode($query));
	}
}

/**
* Extends Class Admin
*
* @version 1.0.0
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
*/
class Admin extends MY_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(0, 'Home', 'main');

	}
}



/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */