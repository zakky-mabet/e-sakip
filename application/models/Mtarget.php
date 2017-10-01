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
		
		return $this->db->get_where('sasaran',array('id_kepala' => $this->session->userdata('SKPD')->ID))->result();
	}

	public function get_periode()
	{
		return $this->db->get_where('kepala_skpd',array('id_kepala' => $this->session->userdata('SKPD')->ID))->result();
	}

	public function getIndikatorSasarantoTarget($param = 0 , $tahun='' )
	{
		$this->db->join('indikator_sasaran', 'indikator_sasaran.id_indikator_sasaran = target_sasaran.id_indikator_sasaran', 'left');
		
		return $this->db->get_where('target_sasaran', array('id_sasaran'=> $param, 'tahunan'=> $tahun))->result();
 	}

	public function getsatuan($param = 0)
	{	
		return $this->db->get_where('master_satuan', array('id'=> $param))->row();
	}

	public function Update_nilai_target()
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
						'nilai_target' => $this->input->post("update[nilai_target][{$value}]"),
					);
					$this->db->update('target_sasaran', $object, array('id_target_sasaran' => $value));
					
					$this->template->alert(
							' Data berhasil disimpan.', 
							array('type' => 'success','icon' => 'check')
						);
				}

				$this->SelectIdTargetSasarandanpkindikator();
				
				$this->SelectIdTargetSasarandanpkindikatorPK();

			}
		}
	}

	//fungsi untuk select id target sasaran jika tidak ada maka inser ke rkt target indikator
	public function SelectIdTargetSasarandanpkindikator()
	{
		foreach ($this->input->post('update[ID]') as $key => $value) 
		{
			$query = $this->db->get_where('rkt_target_indikator', array(
			'id_target_sasaran' => $value,
		) );
		 if ($query->num_rows()==0) 
		 {
		 	$object = array(
				'id_target_sasaran' => $value,
			);
			
		  	$this->db->insert('rkt_target_indikator', $object);
		  } 
		}
	}

	//fungsi untuk select id target sasaran jika tidak ada maka inser ke pk target indikator
	public function SelectIdTargetSasarandanpkindikatorPK()
	{
		foreach ($this->input->post('update[ID]') as $key => $value) 
		{
			$query = $this->db->get_where('pk_indikator_target', array(
			'id_indikator_target' => $value,
		) );
		 if ($query->num_rows()==0) 
		 {
		 	$object_pk = array(
				'id_indikator_target' => $value,
			);
			$this->db->insert('pk_indikator_target', $object_pk);
		  } 
		}
	}
 }

 