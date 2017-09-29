<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mtarget extends Skpd_model 
{

	public function __construct()
	{
		parent::__construct();

	}
	
	public function getAllSasaran()
	{
		return $this->db->get('sasaran')->result();
	}


	public function get_periode()
	{
		return $this->db->get_where('kepala_skpd',array('id_kepala' => $this->session->userdata('SKPD')->ID))->result();
	}

	public function getIndikatorSasaran($param=0)
	{
		return $this->db->get_where('indikator_sasaran')->result();
	}

	public function getsatuan($param = 0)
	{	
		return $this->db->get_where('master_satuan', array('id'=> $param))->row();
	}

 }