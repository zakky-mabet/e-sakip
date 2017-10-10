<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Skpd_model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get($param = '')
	{
		return $this->db->get_where('settings', array('parameter' => $param))->row('value');
	}

	public function getKepalaOpd()
	{
		return $this->db->get_where('kepala_skpd', array('id_kepala' => $this->kepala))->row();
	}
}

/* End of file Setting.php */
/* Location: ./application/models/Setting.php */