<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tjuan extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function CreateUpdate()
	{
		if( $this->input->post('create') )
		{
			if( is_array($this->input->post('create')) )
			{
				$object = array();

				foreach($this->input->post('create[deskripsi]') as $key => $value) 
				{
					if( $value == FALSE OR $this->input->post("create[tahun][{$key}]") == FALSE)
						continue;
					
					$object[] = array(
						'id_misi' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]"))
					);
				}

				$this->db->insert_batch('tujuan', $object);
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'deskripsi' => $this->input->post("update[deskripsi][{$value}]"),
						'tahun' => implode(',', $this->input->post("update[tahun][{$value}]"))
					);

					$this->db->update('tujuan', $object, array('id_tujuan' => $value));
				}
			}
		}
	}

	public function getTujuanByMisi($misi = 0)
	{
		return $this->db->get_where('tujuan', array('id_misi' => $misi))->result();
	}
	
	public function getMisiLogin()
	{
		return $this->db->get_where('misi', array('id_kepala' => $this->kepala))->result();
	}

	public function getByMisi($misi = 0)
	{
		return $this->db->get_where('tujuan', array('id_misi' => $misi))->result();
	}

}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */