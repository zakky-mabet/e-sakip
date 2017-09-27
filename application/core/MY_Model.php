<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	

}

/**
* Extends Model Class
*
* @version 1.0.0
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
*/
class Skpd_model extends MY_Model
{
	public $periode_awal;

	public $periode_akhir;

	public $SKPD;

	public $kepala;

	public function __construct()
	{
		parent::__construct();

		$this->periode_awal = $this->session->userdata('SKPD')->periode_awal;

		$this->periode_akhir = $this->session->userdata('SKPD')->periode_akhir;

		$this->SKPD = $this->session->userdata('SKPD')->ID;

		$this->kepala = $this->session->userdata('SKPD')->kepala;
	}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */

