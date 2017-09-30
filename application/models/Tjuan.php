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
				foreach($this->input->post('create[deskripsi]') as $key => $value) 
				{
					if( $value == FALSE OR $this->input->post("create[tahun][{$key}]") == FALSE) 
					{
						$this->template->alert(
							' Maaf! tahun aktif dan tujuan tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_misi' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'id_kepala' => $this->kepala
					);

					$this->db->insert('tujuan', $object);
				}
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

	public function getTujuanLogin()
	{
		$misi = array();
		foreach ($this->getMisiLogin() as $row) 
			$misi[] = $row->id_misi;

		$this->db->where_in('id_misi', $misi);

		return $this->db->get('tujuan')->result();
	}

	public function getByMisi($misi = 0)
	{
		return $this->db->get_where('tujuan', array('id_misi' => $misi))->result();
	}

	public function getSasaranByTujuan($tujuan = 0)
	{
		return $this->db->get_where('sasaran', array('id_tujuan' => $tujuan))->result();
	}

	public function delete($param = 0, $key = '')
	{
		switch ($key) 
		{
			case 'tujuan':
				$this->db->delete('tujuan', array('id_tujuan' => $param));
				$this->db->delete('indikator_tujuan', array('id_tujuan' => $param));
				$respon['status'] = 'success';
				break;
			case 'indikator':
				$this->db->delete('indikator_tujuan', array('id_indikator_tujuan' => $param));
				$respon['status'] = 'success';
				break;
			default:
				$respon['status'] = 'failed';
				break;
		}

		return $respon;
	}

	public function createupdateindikator()
	{
		if( $this->input->post('create') )
		{
			if( is_array($this->input->post('create')) )
			{
				foreach($this->input->post('create[indikator]') as $key => $value) 
				{
					if( $value == FALSE ) 
					{
						$this->template->alert(
							' Maaf! tahun aktif dan tujuan tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_tujuan' => $key,
						'indikator' => $value,
						'id_satuan' => $this->input->post("create[satuan][{$key}]"),
						'nilai_target' => $this->input->post("create[nilai][{$key}]")
					);

					$this->db->insert('indikator_tujuan', $object);
				}
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'indikator' => $this->input->post("update[indikator][{$value}]"),
						'id_satuan' => $this->input->post("update[satuan][{$value}]"),
						'nilai_target' => $this->input->post("update[nilai][{$value}]")
					);

					$this->db->update('indikator_tujuan', $object, array('id_indikator_tujuan' => $value));
				}
			}
		}
	}

	public function getIndikatorByTujuan($tujuan = 0)
	{
		return $this->db->get_where('indikator_tujuan', array('id_tujuan' => $tujuan))->result();
	}


}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */