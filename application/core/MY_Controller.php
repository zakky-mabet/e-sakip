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
		
		if($this->session->has_userdata('skpd_login')==FALSE) 
		{	
			redirect(site_url('login?from_url='.current_url()));
		}

		
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