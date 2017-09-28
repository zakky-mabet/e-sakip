<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msasaran extends Skpd_model 
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
							' Maaf! tahun aktif dan sasaran tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_tujuan' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]"))
					);

					$this->db->insert('sasaran', $object);
				}

				if($this->db->affected_rows())
				{
					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				} else {
					$this->template->alert(
						' Tidak ada data yang tersimpan.', 
						array('type' => 'warning','icon' => 'warning')
					);
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

					$this->db->update('sasaran', $object, array('id_tujuan' => $value));
				}

				if($this->db->affected_rows())
				{
					$this->template->alert(
						' Data berhasil diubah', 
						array('type' => 'success','icon' => 'check')
					);
				} else {
					$this->template->alert(
						' Tidak ada data yang diubah.', 
						array('type' => 'warning','icon' => 'warning')
					);
				}
			}
		}
	}

	public function getTujuanByMisi($misi = 0)
	{
		return $this->db->get_where('sasaran', array('id_tujuan' => $misi))->result();
	}
	
	public function getMisiLogin()
	{
		return $this->db->get_where('tujuan', array('id_kepala' => $this->kepala))->result();
	}

	public function getTujuanLogin()
	{
		$misi = array();
		foreach ($this->getMisiLogin() as $row) 
			$misi[] = $row->id_tujuan;

		$this->db->where_in('id_tujuan', $misi);

		return $this->db->get('sasaran')->result();
	}

	public function getByMisi($misi = 0)
	{
		return $this->db->get_where('sasaran', array('id_tujuan' => $misi))->result();
	}

	public function delete($param = 0, $key = '')
	{
		switch ($key) 
		{
			case 'sasaran':
				$this->db->delete('sasaran', array('id_sasaran' => $param));

				$respon['status'] = 'success';
				break;
			case 'indikator':
				# code...
				break;
			default:
				# code...
				break;
		}

		return $respon;
	}

}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */