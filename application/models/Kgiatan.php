<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kgiatan extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();
		
		$this->CI->load->model(array('tjuan','mprogram'));
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
				'nilai_anggaran' => null
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

	public function getKegiatanProgramByLogin()
	{
		$program = array();
		foreach ($this->CI->mprogram->getProgramByLogin() as $row) 
			$program[] = $row->id_program;

		$this->db->where_in('id_program', $program);
		return $this->db->get('kegiatan_program')->result();
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

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
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

	public function OutputKegiatanCreateUpdate()
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
							' Maaf! data tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_kegiatan' =>$key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'satuan' => $this->input->post("create[satuan][{$key}]")
					);

					$this->db->insert('output_kegiatan_program', $object);

					$indikator = $this->db->insert_id();

					$this->insertTargetOutputKinerjaProgram($this->input->post("create[tahun][{$key}]"), $indikator);

					$this->insertOutputKegiatanProgram($this->input->post("create[tahun][{$key}]"), $indikator);

					$this->template->alert(
						' Data berhasil ditambahkan.', 
						array('type' => 'success','icon' => 'check')
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
						'tahun' => implode(',', $this->input->post("update[tahun][{$value}]")),
						'satuan' => $this->input->post("update[satuan][{$value}]")
					);

					$this->insertTargetOutputKinerjaProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertOutputKegiatanProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->db->update('output_kegiatan_program', $object, array('id_output_kegiatan_program' => $value));
				}

				$this->template->alert(
					' Data berhasil diubah.', 
					array('type' => 'success','icon' => 'check')
				);
			}
		}
	}

	public function checkOutputKegiatanProgram($output = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_output_kegiatan', array(
			'id_output_kegiatan_program' => $output,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function insertOutputKegiatanProgram($tahun = FALSE, $output = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkOutputKegiatanProgram($output, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('rkt_output_kegiatan', array(
						'id_output_kegiatan_program' => $output,
						'tahun' => $item,
						'nilai_target_rkt' => null,
						'sebab'=> null
					));
				}
			}
		}
	}

	public function checkTargetOutputKinerjaProgram($output = 0, $tahun = 0)
	{
		$query = $this->db->get_where('target_output', array(
			'id_output_kegiatan_program' => $output,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function insertTargetOutputKinerjaProgram($tahun = FALSE, $output = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkTargetOutputKinerjaProgram($output, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('target_output', array(
						'id_output_kegiatan_program' => $output,
						'tahun' => $item,
						'target' => null
					));
				}
			}
		}
	}

	public function getTargetOutputByKegiatanProgram($output = 0, $tahun = 0)
	{
		$query = $this->db->get_where('target_output', array(
			'id_output_kegiatan_program' => $output,
			'tahun' => $tahun
		) );
		return $query->row(); 
	}

	public function getOutputByKegiatanProgram($program = 0)
	{
		$this->db->select('output_kegiatan_program.*, master_satuan.nama as nama_satuan');

		$this->db->join('master_satuan', 'master_satuan.id = output_kegiatan_program.satuan', 'left');

		$this->db->where('id_kegiatan', $program);
		return $this->db->get('output_kegiatan_program')->result();
	}

	public function getRktOutputKegiatan($output = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_output_kegiatan', array(
			'id_output_kegiatan_program' => $output,
			'tahun' => $tahun
		) );
		return $query->row(); 
	}

	public function SaveRktOutputKegiatan()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach($this->input->post('target') as $key => $value) 
			{
				if($this->db->get_where('rkt_output_kegiatan', array('rkt_id_output_kegiatan' => $key))->num_rows()) {
					$this->db->update('rkt_output_kegiatan', array(
						'nilai_target_rkt' => $value ,
						'sebab' => $this->input->post("sebab[{$key}]")
					), array(
						'rkt_id_output_kegiatan' => $key
					));
				}
			}
			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function SaveTargetOutputKegiatan()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach($this->input->post('target') as $key => $value) 
			{
				if($this->db->get_where('target_output', array('id_target_output' => $key))->num_rows()) {
					$this->db->update('target_output', array(
						'target' => $value 
					), array(
						'id_target_output' => $key
					));
				}
			}
			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			);
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