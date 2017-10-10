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
		if( ! $this->CI->tjuan->getTujuanLogin() )
			return array();

		$tujuan = array();
		foreach ($this->CI->tjuan->getTujuanLogin() as $row) 
			$tujuan[] = $row->id_tujuan;

		$this->db->where_in('id_tujuan', $tujuan);

		return $this->db->get('sasaran')->result();
	}

	public function getIndikatorSasaranByLogin()
	{
		if( $this->getSasaranByLogin() == false )
			return array();

		$sasaran = array();
		foreach ($this->getSasaranByLogin() as $row) 
			$sasaran[] = $row->id_sasaran;

		$this->db->select('indikator_sasaran.*, master_satuan.nama as nama_satuan');
		$this->db->join('master_satuan', 'master_satuan.id = indikator_sasaran.id_satuan', 'left');
		$this->db->where_in('id_sasaran' , $sasaran);
		return $this->db->get('indikator_sasaran')->result();
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
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'id_sasaran' => $key
					);

					$this->db->insert('program', $object);

					$program = $this->db->insert_id();

					$this->insertSumberAnggaranProgram($this->input->post("create[tahun][{$key}]"), $program);

					$this->insertRktAnggaranKegiatan($this->input->post("create[tahun][{$key}]"), $program);

					$this->insertPKAnggaranProgram($this->input->post("create[tahun][{$key}]"), $program);

					$this->insertPKPerubahanAnggaranProgram($this->input->post("create[tahun][{$key}]"), $program);
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

					$this->db->update('program', $object, array('id_program' => $value));

					$this->insertSumberAnggaranProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertRktAnggaranKegiatan($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertPKAnggaranProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertPKPerubahanAnggaranProgram($this->input->post("update[tahun][{$value}]"), $value);
				}
			}
		}
	}

	public function getPKPerubahanAnggaranProgram($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('pk_anggaran_kegiatan_perubahan', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function UpdateAnggaranKegiatanPKPerubahan()
	{
		if( is_array($this->input->post('anggaran')) )
		{
			foreach ($this->input->post('anggaran') as $key => $value) 
			{
				$this->db->update('pk_anggaran_kegiatan_perubahan', array(
					'nilai_anggaran' => str_replace(',', '', $value),
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_pk_anggaran_kegiatan_perubahan' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function insertPKPerubahanAnggaranProgram($tahun = FALSE, $program = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getPKPerubahanAnggaranProgram($program, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_anggaran_kegiatan_perubahan', array(
						'id_program' => $program,
						'nilai_anggaran' => null,
						'sebab'=> null,
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

	public function getPKAnggaranProgram($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('pk_anggaran_kegiatan', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function insertPKAnggaranProgram($tahun = FALSE, $program = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getPKAnggaranProgram($program, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_anggaran_kegiatan', array(
						'id_program' => $program,
						'nilai_anggaran' => null,
						'sebab'=> null,
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

	public function UpdateAnggaranKegiatanPK()
	{
		if( is_array($this->input->post('anggaran')) )
		{
			foreach ($this->input->post('anggaran') as $key => $value) 
			{
				$this->db->update('pk_anggaran_kegiatan', array(
					'nilai_anggaran' => str_replace(',', '', $value),
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_pk_anggaran_kegiatan' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function getRktAnggaranKegiatanByProgramTahun($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_anggaran_kegiatan', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function UpdateAnggaranKegiatanRkt()
	{
		if( is_array($this->input->post('anggaran')) )
		{
			foreach ($this->input->post('anggaran') as $key => $value) 
			{
				$this->db->update('rkt_anggaran_kegiatan', array(
					'anggaran_rkt' => str_replace(',', '', $value),
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_anggaran_kegiatan' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function checkRktAnggaranKegiatan($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_anggaran_kegiatan', array(
			'id_program' => $program,
			'tahun' => $tahun
		) );
		return $query->num_rows();
	}

	public function insertRktAnggaranKegiatan($tahun = FALSE, $program = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkRktAnggaranKegiatan($program, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('rkt_anggaran_kegiatan', array(
						'id_program' => $program,
						'anggaran_rkt' => null,
						'sebab'=> null,
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

					$this->insertPKIndikatorKinerjaProgram($this->input->post("create[tahun][{$key}]"), $indikator);

					$this->insertPKPerubahanIndikatorKinerjaProgram($this->input->post("create[tahun][{$key}]"), $indikator);

					$this->insertReIndikatorProgram($this->input->post("create[tahun][{$key}]"), $indikator);

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

					$this->insertPKIndikatorKinerjaProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertPKPerubahanIndikatorKinerjaProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertReIndikatorProgram($this->input->post("update[tahun][{$value}]"), $value);

					$this->db->update('indikator_kinerja_program', $object, array('id_indikator_kinerja_program' => $value));
				}

				$this->template->alert(
					' Data berhasil diubah.', 
					array('type' => 'success','icon' => 'check')
				);
			}
		}
	}

	public function getReIndikatorProgram($indikator = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('realisasi_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('realisasi_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function getReIndikatorProgramTriwulan($pk_induk = 0)
	{
		$query = $this->db->get_where('realisasi_indikator_program', array(
			'pk_induk' => $pk_induk
		) );

		return $query->result();
	}

	public function insertReIndikatorProgram($tahun = FALSE, $indikator = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getReIndikatorProgram($indikator, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('realisasi_indikator_program', array(
						'id_indikator_kinerja_program' => $indikator,
						'tahun' => $item,
						'pk_induk' => 0,
						'triwulan' => null,
						'realisasi' => null,
						'capaian' => null,
						'keterangan' => null
					));

					$induk = $this->db->insert_id();

					if( $induk ) 
					{
						for($i = 1; $i <= 4; $i++) 
						{
							if( $this->getReIndikatorProgram($indikator, $item, "T".$i) == FALSE )
							{
								$this->db->insert('realisasi_indikator_program', array(
									'id_indikator_kinerja_program' => $indikator,
									'tahun' => $item,
									'pk_induk' => $induk,
									'triwulan' => "T".$i,
									'realisasi' => null,
									'capaian' => null,
									'keterangan' => null
								));
							}
						}
					}
				}
			}
		}
	}

	public function getPKPerubahanIndikatorProgram($indikator = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_indikator_program_perubahan', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_indikator_program_perubahan', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function checkPKPerubahanIndikatorProgram($indikator = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_indikator_program_perubahan', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_indikator_program_perubahan', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->num_rows(); 
	}

	public function insertPKPerubahanIndikatorKinerjaProgram($tahun = FALSE, $indikator = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkPKPerubahanIndikatorProgram($indikator, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_indikator_program_perubahan', array(
						'id_indikator_kinerja_program' => $indikator,
						'tahun' => $item,
						'pk_induk' => 0,
						'triwulan' => null,
						'sebab' => null,
						'nilai_target' => null
					));

					$induk = $this->db->insert_id();

					if( $induk ) 
					{
						for($i = 1; $i <= 4; $i++) 
						{
							if( $this->checkPKPerubahanIndikatorProgram($indikator, $item, "T".$i) == FALSE )
							{
								$this->db->insert('pk_indikator_program_perubahan', array(
									'id_indikator_kinerja_program' => $indikator,
									'tahun' => $item,
									'pk_induk' => $induk,
									'triwulan' => "T".$i,
									'sebab' => null,
									'nilai_target' => null
								));
							}
						}
					}
				}
			}
		}
	}

	public function checkPKIndikatorProgram($indikator = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->num_rows(); 
	}

	public function insertPKIndikatorKinerjaProgram($tahun = FALSE, $indikator = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkPKIndikatorProgram($indikator, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_indikator_program', array(
						'id_indikator_kinerja_program' => $indikator,
						'tahun' => $item,
						'pk_induk' => 0,
						'triwulan' => null,
						'sebab' => null,
						'nilai_target' => null
					));

					$induk = $this->db->insert_id();

					if( $induk ) 
					{
						for($i = 1; $i <= 4; $i++) 
						{
							if( $this->checkPKIndikatorProgram($indikator, $item, "T".$i) == FALSE )
							{
								$this->db->insert('pk_indikator_program', array(
									'id_indikator_kinerja_program' => $indikator,
									'tahun' => $item,
									'pk_induk' => $induk,
									'triwulan' => "T".$i,
									'sebab' => null,
									'nilai_target' => null
								));
							}
						}
					}
				}
			}
		}
	}
	public function getKegiatanProgramByMultipleProgram($program = NULL)
	{
		if(!$program)
			return array();

		$this->db->where_in('id_program', $program);

		return $this->db->get('kegiatan_program')->num_rows();
	}

	public function getProgramBySasaranMultiple($sasaran = 0)
	{
		if(!$sasaran)
			return array();

		$this->db->where_in('id_sasaran', $sasaran);

		return $this->db->get('program')->num_rows();
	}

	public function getPKIndikatorTargetTriwulan($indikator = 0, $tahun = 0)
	{
		$query = $this->db->get_where('pk_indikator_target_triwulan', array(
			'id_indikator_sasaran' => $indikator,
			'tahun_triwulan' => $tahun,
		) );

		return $query->row();
	}

	public function getPKIndikatorProgram($indikator = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'pk_induk' => 0
			) );
		} else {
			$query = $this->db->get_where('pk_indikator_program', array(
				'id_indikator_kinerja_program' => $indikator,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function UpdateTargePKPerubahantTargetIndikatorProgram()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach ($this->input->post('target') as $key => $value) 
			{
				if( $key == FALSE)
				 continue;

				$this->db->update('pk_indikator_program_perubahan', array(
					'nilai_target' => $value,
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_pk_program_perubahan' => $key,
				));
			}

			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			); 
		}
	}

	public function UpdateReIndikatorProgram()
	{
		if( is_array($this->input->post('realisasi')) )
		{
			foreach ($this->input->post('realisasi') as $key => $value) 
			{
				if( $key == FALSE)
				 continue;

				$this->db->update('realisasi_indikator_program', array(
					'realisasi' => $value,
					'capaian' => $this->input->post("capaian[{$key}]"),
					'keterangan' => $this->input->post("ket[{$key}]")
				), array(
					'id_reindikator_program' => $key,
				));

				echo $this->db->last_query()."<br>";
			}

			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			); 
		}
	}

	public function UpdateTargePKtTargetIndikatorProgram()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach ($this->input->post('target') as $key => $value) 
			{
				if( $key == FALSE)
				 continue;

				$this->db->update('pk_indikator_program', array(
					'nilai_target' => $value,
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_pk_program' => $key,
				));
			}

			$this->template->alert(
				' Data berhasil diubah.', 
				array('type' => 'success','icon' => 'check')
			); 
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
					'rkt_id_indikator_program' => $key,
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
				$this->db->delete('kegiatan_program', array('id_program' => $param));
				$this->db->delete('indikator_kinerja_program', array('id_program' => $param));
				$this->db->delete('pk_anggaran_kegiatan', array('id_program' => $param));
				$this->db->delete('pk_anggaran_kegiatan_perubahan', array('id_program' => $param));
				$this->db->delete('sumber_anggaran_program', array('id_program' => $param));
				$respon['status'] = 'success';
				break;
			case 'indikator':
				$this->db->delete('indikator_kinerja_program', array('id_indikator_kinerja_program' => $param));
				$this->db->delete('pk_indikator_program', array('id_indikator_kinerja_program' => $param));
				$this->db->delete('pk_indikator_program_perubahan', array('id_indikator_kinerja_program' => $param));
				$this->db->delete('realisasi_indikator_program', array('id_indikator_kinerja_program' => $param));
				$this->db->delete('rkt_indikator_program', array('id_indikator_kinerja_program' => $param));
				$this->db->delete('target_indikator_kinerja_program', array('id_indikator_kinerja_program' => $param));
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