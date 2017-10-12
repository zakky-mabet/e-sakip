<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manalisis_sasaran_report extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

		$this->CI->load->model('tjuan');
	}

	public function kepala_skpd($param = 0)
	{
		return $this->db->get_where('kepala_skpd', array('id_Skpd' => $param))->row();
	}

	public function get_all_sasaran()
	{
		return $this->db->get('sasaran')->result();
	}

	public function get_indikator_sasaran_by_id_sasaran($param = 0)
	{
		$this->db->join('formulasi_sasaran', 'formulasi_sasaran.id_indikator_sasaran = indikator_sasaran.id_indikator_sasaran', 'left');

		return $this->db->get_where('indikator_sasaran', array('id_sasaran' => $param, 'IKU' => 'yes'))->result();
	}

}

