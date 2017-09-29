<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kgiatan extends Skpd_model 
{
	protected $CI;
	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();
		
		$this->CI->load->model('tjuan');
	}

	public function CreateUpdate()
	{
		if( $this->input->post('create') )
		{
			if( is_array($this->input->post('create')) )
			{
				foreach($this->input->post('create[deskripsi]') as $key => $value) 
				{
					if( $value == FALSE ) 
					{
						$this->template->alert(
							' Maaf! tahun aktif dan kegiatan tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'check')
						);
						continue;
					}

					$object = array(
						'id_program' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]"))
					);

					$this->db->insert('kegiatan_program', $object);

					$kegiatan = $this->db->insert_id();

					if( is_array($this->input->post("create[tahun][{$key}]")) )
					{
						foreach ($this->input->post("create[tahun][{$key}]") as $item => $tahun) 
						{
							$this->insertAnggaranKegiatan($kegiatan, $tahun);
							$this->insertPenanggungJawabKegiatan($kegiatan, $tahun);
						}
					}

					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'warning')
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

					$this->db->update('kegiatan_program', $object, array('id_kegiatan' => $value));

					if( is_array($this->input->post("update[tahun][{$value}]")) )
					{
						foreach ($this->input->post("update[tahun][{$value}]") as $item => $tahun) 
						{
							$this->insertAnggaranKegiatan($value, $tahun);
							$this->insertPenanggungJawabKegiatan($value, $tahun);
						}
					}

					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}

	public function insertAnggaranKegiatan($kegiatan = 0, $tahun = 0)
	{
		if( $this->checkAnggaranKegiatan($kegiatan, $tahun) == FALSE)
		{
			$this->db->insert('anggaran_kegiatan', array(
				'id_kegiatan' => $kegiatan,
				'tahun' => $tahun,
				'nilai_anggaran' => null,
				'sumber_anggaran' => null
			));
		}
	}

	public function checkAnggaranKegiatan($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('anggaran_kegiatan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function insertPenanggungJawabKegiatan($kegiatan = 0, $tahun = 0)
	{
		if( $this->checkPenanggungJawabKegiatan($kegiatan, $tahun) == FALSE)
		{
			$this->db->insert('penanggung_jawab_kegiatan', array(
				'id_kegiatan' => $kegiatan,
				'tahun' => $tahun,
				'penanggung_jawab' => null
			));

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function checkPenanggungJawabKegiatan($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('penanggung_jawab_kegiatan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function getAnggaranKegiatan($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('anggaran_kegiatan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->row(); 
	}

	public function getKegiatanProgramByProgram($program = 0)
	{
		return $this->db->get_where('kegiatan_program', array('id_program' => $program))->result();
	}

	public function getPenanggungJawabKegiatanByKegiatanTahun($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('penanggung_jawab_kegiatan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function Updatepenanggungjawab()
	{
		if( is_array($this->input->post('penanggung')))
		{
			foreach ($this->input->post('penanggung') as $key => $value) 
			{
				$this->db->update('penanggung_jawab_kegiatan', array(
					'penanggung_jawab' => $value
				), array(
					'id_penangung_jawab_kegiatan' => $key
				));
			}
		}
	}

	public function UpdateAnggaranKegiatan()
	{
		if( is_array($this->input->post('anggaran')))
		{
			foreach ($this->input->post('anggaran') as $key => $value) 
			{
				$this->db->update('anggaran_kegiatan', array(
					'nilai_anggaran' => str_replace(',', '', $value)
				), array(
					'id_anggaran_kegiatan' => $key
				));
			}
		}
	}

	public function delete($param = 0, $key = '')
	{
		switch ($key) 
		{
			case 'kegiatan':
				$this->db->delete('kegiatan_program', array('id_kegiatan' => $param));
				$this->db->delete('anggaran_kegiatan', array('id_kegiatan' => $param));
				$this->db->delete('penanggung_jawab_kegiatan', array('id_kegiatan' => $param));
				$response['status'] ='success';
				break;
			
			default:
				$response['status'] ='failed';
				break;
		}

		return $response;
	}
}

/* End of file Kgiatan.php */
/* Location: ./application/models/Kgiatan.php */