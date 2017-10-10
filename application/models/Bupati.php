<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bupati extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function thisBupati()
	{
		return $this->db->query("SELECT * FROM bupati WHERE periode_akhir <= '{$this->periode_akhir}' ORDER BY id_bupati DESC")->row();
	}
}

/* End of file Bupati.php */
/* Location: ./application/models/Bupati.php */