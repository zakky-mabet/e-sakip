<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprogram extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();
		
		$this->CI =& get_instance();

		$this->CI->load->model('tjuan');
	}
	
	public function getSasaranByLogin()
	{
		$tujuan = array();
		foreach ($this->CI->tjuan->getTujuanLogin() as $row) 
			$tujuan[] = $row->id_tujuan;

		$this->db->where_in('id_tujuan', $tujuan);

		return $this->db->get('sasaran')->result();
	}

	public function getIndikatorProgram()
	{
		return $this->db->get_where('master_indikator_sasaran', array('id_skpd' => $this->SKPD))->result();
	}

	public function getProgramByLogin()
	{
		$sasaran = array();
		foreach ($this->getSasaranByLogin() as $row) 
			$sasaran[] = $row->id_sasaran;

		$this->db->where_in('id_sasaran', $sasaran);
		return $this->db->get('program')->result();
	}

	public function getIndikatorKinerjaProgram($program = 0, $tahun = '-')
	{
		$this->db->select('master_satuan.nama AS satuan, indikator_kinerja_program.*');
		$this->db->join('master_satuan', 'master_satuan.id = indikator_kinerja_program.id_satuan', 'left');

		$this->db->where('indikator_kinerja_program.id_program', $program)
				 ->like('indikator_kinerja_program.tahun', $tahun);

		return $this->db->get('indikator_kinerja_program')->result();
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
							' Maaf! tahun aktif dan program tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_indikator_sasaran' =>$this->input->post("create[indikator][{$key}]"),
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'id_sasaran' => $key
					);

					$this->db->insert('program', $object);

					$program = $this->db->insert_id();

					$this->insertSumberAnggaranProgram($this->input->post("create[tahun][{$key}]"), $program);
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
						'id_indikator_sasaran' => $this->input->post("update[indikator][{$value}]")
					);

					$this->db->update('program', $object, array('id_program' => $value));

					$this->insertSumberAnggaranProgram($this->input->post("update[tahun][{$key}]"), $value);
				}
			}
		}
	}

	public function insertSumberAnggaranProgram($tahun = FALSE, $program = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkSumberAnggaranProgram($program, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('sumber_anggaran_program', array(
						'id_program' => $program,
						'sumber_anggaran' => null,
						'tahun' => $item
					));
				}
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function checkSumberAnggaranProgram($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('sumber_anggaran_program', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->num_rows();
	}

	public function getSumberAnggaranProgram($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('sumber_anggaran_program', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function getProgramBySasaran($sasaran = 0)
	{
		return $this->db->get_where('program', array('id_sasaran' => $sasaran))->result();
	}

	public function getNilaiTargetIndikatorByIndikatorTahun($indikator = 0, $tahun = 0)
	{
		return $this->db->get_where('target_indikator_kinerja_program', array(
			'id_indikator_kinerja_program' => $indikator,
			'tahun' => $tahun
		))->row('target');
	}

	public function getTotalAnggaranKegiatanByProgramTahun($program = 0, $tahun = 0)
	{
		$program = $this->db->query(
			"SELECT kegiatan_program.id_kegiatan FROM kegiatan_program
			WHERE kegiatan_program.id_program IN(SELECT program.id_program FROM program WHERE program.id_program = '{$program}')
		");

		$kegiatan = array();
		foreach ($program->result() as $key => $value) {
			$kegiatan[] = $value->id_kegiatan;
		}

		if( $kegiatan )
		{
			$IDKegiatan = join(",", $kegiatan);

			$anggaran = $this->db->query("
				SELECT SUM(anggaran_kegiatan.nilai_anggaran) AS anggaran FROM anggaran_kegiatan 
				WHERE id_kegiatan IN ({$IDKegiatan}) AND tahun = '{$tahun}'
			")->row('anggaran');
		} else {
			return 0;
		}

	 	return $anggaran;
	}

	public function SaveAnggaranProgram()
	{
		if( is_array($this->input->post('sumber')) )
		{
			foreach ($this->input->post('sumber') as $key => $value) 
			{
				$this->db->update('sumber_anggaran_program', array(
					'sumber_anggaran' => $value
				), array(
					'id_sumber_anggaran_program' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function getKegiatanProgramByProgram($kegiatan = FALSE)
	{
		$this->db->where_in('id_kegiatan', $kegiatan);
		return $this->db->get('kegiatan_program')->result();
	}

	public function getSumberAnggaranProgramByProgramTahun($program = 0, $tahun = 0)
	{
		return $this->db->get_where('sumber_anggaran_program', array(
			'id_program' => $program,
			'tahun' => $tahun
		))->row();
	}

	public function IndikatorCreateUpdate()
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
						'id_program' =>$key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'id_satuan' => $this->input->post("create[satuan][{$key}]")
					);

					$this->db->insert('indikator_kinerja_program', $object);

					$indikator = $this->db->insert_id();

					$this->insertTargetIndikatorKinerjaProgram($this->input->post("create[tahun][{$key}]"), $indikator);

					$this->insertRktIndikatorProgram($this->input->post("create[tahun][{$key}]"), $indikator);

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
						'id_satuan' => $this->input->post("update[satuan][{$value}]")
					);

					$this->insertTargetIndikatorKinerjaProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertRktIndikatorProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->db->update('indikator_kinerja_program', $object, array('id_indikator_kinerja_program' => $value));
				}

				$this->template->alert(
					' Data berhasil diubah.', 
					array('type' => 'success','icon' => 'check')
				);
			}
		}
	}

	public function checkTargetIndikatorKinerjaProgram($indikator = 0, $tahun = 0)
	{
		$query = $this->db->get_where('target_indikator_kinerja_program', array(
			'id_indikator_kinerja_program' => $indikator,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function checkRktIndikatorProgram($indikator = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_indikator_program', array(
			'id_indikator_kinerja_program' => $indikator,
			'tahun' => $tahun
		) );
		return $query->num_rows(); 
	}

	public function insertRktIndikatorProgram($tahun = FALSE, $indikator = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkRktIndikatorProgram($indikator, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('rkt_indikator_program', array(
						'id_indikator_kinerja_program' => $indikator,
						'tahun' => $item,
						'nilai_target_rkt' => null,
						'sebab' => null
					));
				}
			}
		}
	}

	public function getRktIndikatorProgram($indikator = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_indikator_program', array(
			'id_indikator_kinerja_program' => $indikator,
			'tahun' => $tahun
		) );
		return $query->row(); 
	}

	public function SaveRktIndikatorProgram()
	{
		if( is_array($this->input->post('target')) )
		{
			 foreach ($this->input->post('target') as $key => $value) 
			 {
				$this->db->update('rkt_indikator_program', array(
					'nilai_target_rkt' => $value,
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_indikator_kinerja_program' => $key,
				));
			 }

			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			); 
		}
	}

	public function insertTargetIndikatorKinerjaProgram($tahun = FALSE, $indikator = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkTargetIndikatorKinerjaProgram($indikator, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('target_indikator_kinerja_program', array(
						'id_indikator_kinerja_program' => $indikator,
						'tahun' => $item,
						'target' => null
					));
				}
			}
		}
	}

	public function SaveNilaiTargetProgramIndikator()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach ($this->input->post('target') as $indikator_kinerja_program => $loopTahun) 
			{
				foreach ($loopTahun as $tahun => $nilaiTarget) {
					$this->db->update('target_indikator_kinerja_program', array(
						'target' => $nilaiTarget
					), array(
						'id_indikator_kinerja_program' => $indikator_kinerja_program,
						'tahun' => $tahun
					));
				}
			}
		}
	}

	public function getIndikatorKinerjaProgramByProgram($program = 0)
	{
		return $this->db->get_where('indikator_kinerja_program', array('id_program' => $program))->result();
	}

	public function delete($param = 0, $key = '')
	{
		switch ($key) 
		{
			case 'program':
				$this->db->delete('program', array('id_program' => $param));
				$respon['status'] = 'success';
				break;
			case 'indikator':
				$this->db->delete('indikator_kinerja_program', array('id_indikator_kinerja_program' => $param));
				$respon['status'] = 'success';
				break;
			default:
				$respon['status'] = 'failed';
				break;
		}

		return $respon;
	}
}

/* End of file Mprogram.php */
/* Location: ./application/models/Mprogram.php */