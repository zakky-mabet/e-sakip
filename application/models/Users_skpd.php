<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_skpd extends CI_Model 
{
	public function get_admin_login()
	{
		if (filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL)) 
		{
			$this->db->where('email', $this->input->post('username'));
		} else {
			$this->db->where('username', $this->input->post('username'));
		}

		$this->db->join('skpd', 'kepala_skpd.id_kepala = skpd.ID', 'left');

		return $this->db->get('kepala_skpd')->row();
	}
	

}

/* End of file Users_skpd.php */
/* Location: ./application/models/Users_skpd.php */