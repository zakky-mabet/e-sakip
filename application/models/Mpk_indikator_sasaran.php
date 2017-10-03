<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpk_indikator_sasaran extends Skpd_model 
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

	public function getIndikatorSasarantoTarget($param = 0 , $tahun='' )
	{
		
		$this->db->join('indikator_sasaran', 'indikator_sasaran.id_indikator_sasaran = target_sasaran.id_indikator_sasaran', 'left');

		$this->db->join('rkt_target_indikator', 'rkt_target_indikator.id_target_sasaran = target_sasaran.id_target_sasaran', 'left');

		$this->db->join('pk_indikator_target', 'pk_indikator_target.id_indikator_target = target_sasaran.id_target_sasaran', 'left');
		
		return $this->db->get_where('target_sasaran', array('id_sasaran'=> $param, 'tahunan'=> $tahun))->result();
 	}

	public function getsatuan($param = 0)
	{	
		return $this->db->get_where('master_satuan', array('id'=> $param))->row();
	}

	public function Update()
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

					if ($value == NULL) {
						
					} else {
					$object = array(
						'nilai_target_pk' => $this->input->post("update[nilai_target_pk][{$value}]"),
						'sebab_pk' => $this->input->post("update[sebab_pk][{$value}]"),
					);
					$this->db->update('pk_indikator_target', $object, array('id_pk_target' => $value));
					
					$this->template->alert(
						'Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
						);
					}
				}
			}
		}
	}

 	public function getIndikatorSasarantoTargetTriwulan($param = 0 , $tahun='' )
	{
		
		$this->db->join('indikator_sasaran', 'indikator_sasaran.id_indikator_sasaran = pk_indikator_target_triwulan.id_indikator_sasaran', 'left');

		return $this->db->get_where('pk_indikator_target_triwulan', array('id_sasaran'=> $param, 'tahun_triwulan'=> $tahun))->result();
 	}

 }