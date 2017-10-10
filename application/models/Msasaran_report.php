<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msasaran_report extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

		$this->CI->load->model('tjuan');
	}


	public function get_sasaran()
	{
		return $this->db->get_where('sasaran', array('id_kepala' => $this->kepala))->result();
	}
	

}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */