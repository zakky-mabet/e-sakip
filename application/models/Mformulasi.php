<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mformulasi extends Skpd_model 
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

	public function getIndikatorSasaranDANformulasi($param=0)
	{
		
		$this->db->join('indikator_sasaran', 'indikator_sasaran.id_indikator_sasaran = formulasi_sasaran.id_indikator_sasaran', 'left');

		return $this->db->get_where('formulasi_sasaran', array('id_sasaran' => $param ))->result();
	}

	public function getsatuan($param = 0)
	{	
		return $this->db->get_where('master_satuan', array('id'=> $param))->row();
	}

	public function Update_formulasi()
	{
		if( $this->input->post('create') )
		{
			if( is_array($this->input->post('create')) )
			{
				echo 'Kesalahan Dalam Menyimpan Data ! Silahkan Ulangi';
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'alasan' => $this->input->post("update[alasan][{$value}]"),
						'cara_pengukuran' => $this->input->post("update[cara_pengukuran][{$value}]"),
						'keterangan' => $this->input->post("update[keterangan][{$value}]"),
					);
					$this->db->update('formulasi_sasaran', $object, array('id_formulasi_sasaran' => $value));
				}
			}
		}
	}
 }