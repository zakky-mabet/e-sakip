<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msk_iku_report extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

		$this->CI->load->model('tjuan');
	}



}

