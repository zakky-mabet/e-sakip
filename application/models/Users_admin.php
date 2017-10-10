<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin extends CI_Model 
{
	public function get_admin_login()
	{
		if (filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL)) 
		{
			$this->db->where('email', $this->input->post('username'));
		} else {
			$this->db->where('username', $this->input->post('username'));
		}

		return $this->db->get('users_admin')->row();
	}

}

/* End of file Users_admin.php */
/* Location: ./application/models/Users_admin.php */