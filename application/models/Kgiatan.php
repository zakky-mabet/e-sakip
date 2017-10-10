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
				$th = 1;
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
						'tahun' => $this->input->post("create[tahun]")
					);

					$this->insertKegiatanProgram($key, $object);

					$this->template->alert(
						' Data berhasil disimpan.', 
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
						'tahun' => implode(',', $this->input->post("update[tahun][{$value}]"))
					);

					$this->db->update('kegiatan_program', $object, array('id_kegiatan' => $value));

					if( is_array($this->input->post("update[tahun][{$value}]")) )
					{
						$this->insertRktAnggaranKegiatan($this->input->post("update[tahun][{$value}]"), $value);

						$this->insertPKAnggaranProgram($this->input->post("update[tahun][{$value}]"), $value);

						$this->insertPKPerubahanAnggaranProgram($this->input->post("update[tahun][{$value}]"), $value);

						foreach ($this->input->post("update[tahun][{$value}]") as $item => $tahun) 
						{
							$this->insertAnggaranKegiatan($value, $tahun);
							$this->insertPenanggungJawabKegiatan($value, $tahun);
						}

						$this->insertReanggaranKegiatan($this->input->post("update[tahun][{$value}]"), $value);
					}

					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}


	public function getPKAnggaranProgram($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('pk_anggaran_kegiatan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->row();
	}

	public function insertPKAnggaranProgram($tahun = FALSE, $kegiatan = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getPKAnggaranProgram($kegiatan, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_anggaran_kegiatan', array(
						'id_kegiatan' => $kegiatan,
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

	public function updatePAnggaranKegiatan($param = 0)
	{
		$this->db->update('realisasi_anggaran_kegiatan', array(
			'nilai_anggaran' => str_replace(',', '', $this->input->post('nilai'))
		), array(
			'id_reanggaran_kegiatan' => $param
		));
	}

	public function getReAnggaranKegiatan($kegiatan = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('realisasi_anggaran_kegiatan', array(
				'id_kegiatan' => $kegiatan,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('realisasi_anggaran_kegiatan', array(
				'id_kegiatan' => $kegiatan,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function getTotalReAnggaranKegiatan($program = 0, $tahun = 0, $triwulan = FALSE)
	{
		$kegiatanProgram = $this->db->get_where('kegiatan_program', array('id_program' => $program))->result();

		if(!$kegiatanProgram)
			return array();

		$kegiatan = array();
		foreach ($kegiatanProgram as $row) 
			$kegiatan[] = $row->id_kegiatan;

		$this->db->select('SUM(nilai_anggaran) as realisasi');

		$this->db->where_in('id_kegiatan', $kegiatan);

		$this->db->where('tahun', $tahun);

		$this->db->where('triwulan', $triwulan);

		$query = $this->db->get('realisasi_anggaran_kegiatan');
		
		return $query->row('realisasi');
	}

	public function getSumTotalReAnggaranKegiatan($sasaran = 0, $tahun = 0, $triwulan = FALSE)
	{
		$program = array();
		foreach ($this->CI->mprogram->getProgramBySasaran($sasaran) as $row) 
			$program[] = $row->id_program;

		if(! $this->CI->mprogram->getProgramBySasaran($sasaran) )
			return array();

		$kegiatanProgram = $this->db->where_in('id_program', $program)
				 					->get('kegiatan_program')->result();

		if(!$kegiatanProgram)
			return array();

		$kegiatan = array();
		foreach ($kegiatanProgram as $row) 
			$kegiatan[] = $row->id_kegiatan;

		$this->db->select('SUM(nilai_anggaran) as realisasi');

		$this->db->where_in('id_kegiatan', $kegiatan);

		$this->db->where('tahun', $tahun);

		$this->db->where('triwulan', $triwulan);

		$query = $this->db->get('realisasi_anggaran_kegiatan');
		
		return $query->row('realisasi');
	}

	public function insertReanggaranKegiatan($tahun = 0, $kegiatan = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getReAnggaranKegiatan($kegiatan, $item) ) 
				{
					continue;
				} else {
					for($i = 1; $i <= 4; $i++) 
					{
						if( $this->getReAnggaranKegiatan($kegiatan, $item, "T".$i) == FALSE )
						{
							$this->db->insert('realisasi_anggaran_kegiatan', array(
								'id_kegiatan' => $kegiatan,
								'tahun' => $item,
								'triwulan' => "T".$i,
								'nilai_anggaran' => null
							));
						}
					}
				}
			}
		}
	}

	public function insertKegiatanProgram( $program = 0, $data = FALSE)
	{
		if( is_array($data) )
		{
			$no = 0;
			foreach ($data['deskripsi'] as $key => $deskripsi) 
			{
				$object = array(
					'id_program' => $program,
					'deskripsi' => $deskripsi,
					'tahun' => @implode(',', $this->getPeriode())
				);

				$this->db->insert('kegiatan_program', $object);

				$kegiatan = $this->db->insert_id(); 

				if( @is_array(  $this->getPeriode() ) )
				{
					$this->insertReanggaranKegiatan($this->getPeriode(), $kegiatan);

					$this->insertRktAnggaranKegiatan($this->getPeriode(), $kegiatan);

					$this->insertPKAnggaranProgram($this->getPeriode(), $kegiatan);

					$this->insertPKPerubahanAnggaranProgram($this->getPeriode(), $kegiatan);

					foreach ($this->getPeriode() as $item => $tahun) 
					{
						$this->insertAnggaranKegiatan($kegiatan, $tahun);
						$this->insertPenanggungJawabKegiatan($kegiatan, $tahun);
					}
				}	
			}
		}
	}

	public function getTotalRktAnggaranKegiatanByProgramTahun($program = 0, $tahun = 0)
	{
		$id_kegiatan = array();
		foreach ($this->getKegiatanProgramByProgram($program) as $key => $value) 
			$id_kegiatan[] = $value->id_kegiatan;

		if(!$id_kegiatan)
			return 0;

		$this->db->select('SUM(anggaran_rkt) AS totalanggaran');

		$this->db->where_in('id_kegiatan', $id_kegiatan);

		$this->db->where('tahun', $tahun);

		return $this->db->get('rkt_anggaran_kegiatan')->row('totalanggaran');
	}

	public function getTotalPKAnggaranKegiatanByProgramTahun($program = 0, $tahun = 0)
	{
		$id_kegiatan = array();
		foreach ($this->getKegiatanProgramByProgram($program) as $key => $value) 
			$id_kegiatan[] = $value->id_kegiatan;

		if(!$id_kegiatan)
			return 0;

		$this->db->select('SUM(nilai_anggaran) AS totalanggaran');

		$this->db->where_in('id_kegiatan', $id_kegiatan);

		$this->db->where('tahun', $tahun);

		return $this->db->get('pk_anggaran_kegiatan')->row('totalanggaran');
	}

	public function getTotalPKPerubahanAnggaranProgram($program = 0, $tahun = 0)
	{
		$id_kegiatan = array();
		foreach ($this->getKegiatanProgramByProgram($program) as $key => $value) 
			$id_kegiatan[] = $value->id_kegiatan;

		if(!$id_kegiatan)
			return 0;

		$this->db->select('SUM(nilai_anggaran) AS totalanggaran');

		$this->db->where_in('id_kegiatan', $id_kegiatan);

		$this->db->where('tahun', $tahun);

		return $this->db->get('pk_anggaran_kegiatan_perubahan')->row('totalanggaran');
	}

	public function checkRktAnggaranKegiatan($program = 0, $tahun = 0)
	{
		$query = $this->db->get_where('rkt_anggaran_kegiatan', array(
			'id_kegiatan' => $program,
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
						'id_kegiatan' => $program,
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

	public function getPKPerubahanAnggaranProgram($kegiatan = 0, $tahun = 0)
	{
		$query = $this->db->get_where('pk_anggaran_kegiatan_perubahan', array(
			'id_kegiatan' => $kegiatan,
			'tahun' => $tahun
		) );
		return $query->row();
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
						'id_kegiatan' => $program,
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

					$output = $this->db->insert_id();

					$this->insertTargetOutputKinerjaProgram($this->input->post("create[tahun][{$key}]"), $output);

					$this->insertOutputKegiatanProgram($this->input->post("create[tahun][{$key}]"), $output);

					$this->insertPKOutputKegiatan($this->input->post("create[tahun][{$key}]"), $output);

					$this->insertPKPerubahanOutputKegiatan($this->input->post("create[tahun][{$key}]"), $output);

					$this->insertReOutputKegiatan($this->input->post("create[tahun][{$key}]"), $output);

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

					$this->insertPKOutputKegiatan($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertPKPerubahanOutputKegiatan($this->input->post("update[tahun][{$value}]"), $value);

					$this->insertReOutputKegiatan($this->input->post("update[tahun][{$value}]"), $value);

					$this->db->update('output_kegiatan_program', $object, array('id_output_kegiatan_program' => $value));
				}

				$this->template->alert(
					' Data berhasil diubah.', 
					array('type' => 'success','icon' => 'check')
				);
			}
		}
	}

	public function UpdateReOutputKegiatan()
	{
		if( is_array($this->input->post('realisasi')) )
		{
			foreach ($this->input->post('realisasi') as $key => $value) 
			{
				if( $key == FALSE)
					continue;
				
				$this->db->update('realisasi_output_kegiatan', array(
					'realisasi' => $value,
					'capaian' => $this->input->post("capaian[{$key}]"),
					'keterangan' => $this->input->post("ket[{$key}]")
				), array(
					'id_reoutput_kegiatan' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function getReOutputKegiatanTriwulan($pk_induk = 0)
	{
		$query = $this->db->get_where('realisasi_output_kegiatan', array(
			'pk_induk' => $pk_induk
		) );

		return $query->result();
	}

	public function getReOutputKegiatan($output = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('realisasi_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('realisasi_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function insertReOutputKegiatan($tahun = FALSE, $output = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->getReOutputKegiatan($output, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('realisasi_output_kegiatan', array(
						'id_output_kegiatan_program' => $output,
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
							if( $this->getReOutputKegiatan($output, $item, "T".$i) == FALSE )
							{
								$this->db->insert('realisasi_output_kegiatan', array(
									'id_output_kegiatan_program' => $output,
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

	public function UpdatePKPerubahanOutputKegiatan()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach ($this->input->post('target') as $key => $value) 
			{
				if( $key == FALSE)
					continue;
				
				$this->db->update('pk_output_kegiatan_perubahan', array(
					'nilai_target' => $value,
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'pk_ouput_kegiatan_perubahan' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function checkPKPerubahanOutputKegiatan($output = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_output_kegiatan_perubahan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_output_kegiatan_perubahan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->num_rows(); 
	}

	public function getPKPerubahanOutputKegiatan($output = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_output_kegiatan_perubahan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_output_kegiatan_perubahan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function insertPKPerubahanOutputKegiatan($tahun = FALSE, $output = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkPKPerubahanOutputKegiatan($output, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_output_kegiatan_perubahan', array(
						'id_output_kegiatan_program' => $output,
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
							if( $this->checkPKPerubahanOutputKegiatan($output, $item, "T".$i) == FALSE )
							{
								$this->db->insert('pk_output_kegiatan_perubahan', array(
									'id_output_kegiatan_program' => $output,
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

	public function checkPKOutputKegiatan($output = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->num_rows(); 
	}

	public function getPKOutputKegiatan($output = 0, $tahun = 0, $triwulan = FALSE)
	{
		if( $triwulan == FALSE) 
		{
			$query = $this->db->get_where('pk_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun
			) );
		} else {
			$query = $this->db->get_where('pk_output_kegiatan', array(
				'id_output_kegiatan_program' => $output,
				'tahun' => $tahun,
				'triwulan' => $triwulan
			) );
		}
		return $query->row(); 
	}

	public function UpdatePKOutputKegiatan()
	{
		if( is_array($this->input->post('target')) )
		{
			foreach ($this->input->post('target') as $key => $value) 
			{
				if( $key == FALSE)
					continue;
				
				$this->db->update('pk_output_kegiatan', array(
					'nilai_target' => $value,
					'sebab' => $this->input->post("sebab[{$key}]")
				), array(
					'id_ouput_pk' => $key
				));
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function insertPKOutputKegiatan($tahun = FALSE, $output = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkPKOutputKegiatan($output, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('pk_output_kegiatan', array(
						'id_output_kegiatan_program' => $output,
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
							if( $this->checkPKOutputKegiatan($output, $item, "T".$i) == FALSE )
							{
								$this->db->insert('pk_output_kegiatan', array(
									'id_output_kegiatan_program' => $output,
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
				$this->db->delete('output_kegiatan_program', array('id_kegiatan' => $param));
				$this->db->delete('realisasi_anggaran_kegiatan', array('id_kegiatan' => $param));
				$this->db->delete('rkt_anggaran_kegiatan', array('id_kegiatan' => $param));
				$this->db->delete('pk_anggaran_kegiatan', array('id_kegiatan' => $param));
				$response['status'] ='success';
				break;
			case 'output-kegiatan':
				$this->db->delete('output_kegiatan_program', array('id_output_kegiatan_program' => $param));
				$this->db->delete('pk_output_kegiatan', array('id_output_kegiatan_program' => $param));
				$this->db->delete('pk_output_kegiatan_perubahan', array('id_output_kegiatan_program' => $param));
				$this->db->delete('realisasi_output_kegiatan', array('id_output_kegiatan_program' => $param));
				$this->db->delete('rkt_output_kegiatan', array('id_output_kegiatan_program' => $param));
				$this->db->delete('target_output', array('id_output_kegiatan_program' => $param));
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