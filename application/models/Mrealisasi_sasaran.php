<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mrealisasi_sasaran extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAllSasaran()
	{
		return $this->db->get_where('sasaran', array('id_kepala' => $this->session->userdata('SKPD')->ID))->result();
	}

	public function get_periode()
	{
		return $this->db->get_where('kepala_skpd',array('id_kepala' => $this->session->userdata('SKPD')->ID))->result();
	}

	public function getIndikatorSasarantoTarget($param = 0 , $tahun= 0 )
	{
		
		$this->db->join('indikator_sasaran', 'indikator_sasaran.id_indikator_sasaran = target_sasaran.id_indikator_sasaran', 'left');

		$this->db->join('rkt_target_indikator', 'rkt_target_indikator.id_target_sasaran = target_sasaran.id_target_sasaran', 'left');

		$this->db->join('realisasi_indikator_sasaran', 'realisasi_indikator_sasaran.id_target_sasaran = target_sasaran.id_target_sasaran', 'left');
		
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
					$object = array(
						'nilai_realisasi' => $this->input->post("update[nilai_realisasi][{$value}]"),
						'nilai_capaian' => $this->input->post("update[nilai_capaian][{$value}]"),
						'keterangan' => $this->input->post("update[keterangan][{$value}]"),
					);
					$this->db->update('realisasi_indikator_sasaran', $object, array('id_realisasi_indikator_sasaran' => $value));

					$this->template->alert(
						' Tersimpan! Data berhasil tersimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}

	public function Update_analisis()
	{
		
		$object = array(
			'deskripsi' => $this->input->post("deskripsi"),
		);

		$this->db->update('realisasi_analisis_sasaran_tahunan', $object, array(' id_realisasi_analisis_sasaran_tahunan' => $this->input->post("ID")));
		
		$this->template->alert(
				'Analisis Sasaran berhasil disimpan', 
				array('type' => 'success','icon' => 'success')
			);
	}

	public function Get_realisasi_analisis($param = 0, $tahun = 0)
	{	
		return $this->db->get_where('realisasi_analisis_sasaran_tahunan', array('id_sasaran'=> $param, 'tahun_analisis'=> $tahun))->result();
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

	public function getIndikatorSasarantoTargetTriwulan($param = 0, $tahun = 0 )
	{	

		$this->db->join('pk_indikator_target', 'pk_indikator_target.id_indikator_target = pk_indikator_target_triwulan.id_indikator_sasaran', 'left');

		return $this->db->get_where('pk_indikator_target_triwulan', array('pk_indikator_target_triwulan.id_indikator_sasaran'=> $param, 'tahun_triwulan'=> $tahun))->result();	
		
 	}

 	// UPDATE TO TABLE  pk_indikator_target_triwulan karena realisasi dan capaian tergabung dengan target
 	public function UpdateTriwulan()
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
						'realisasi_triwulan1' => $this->input->post("update[realisasi_triwulan1][{$value}]"),
						'realisasi_triwulan2' => $this->input->post("update[realisasi_triwulan2][{$value}]"),
						'realisasi_triwulan3' => $this->input->post("update[realisasi_triwulan3][{$value}]"),
						'realisasi_triwulan4' => $this->input->post("update[realisasi_triwulan4][{$value}]"),

						'capaian1' => $this->input->post("update[capaian1][{$value}]"),
						'capaian2' => $this->input->post("update[capaian2][{$value}]"),
						'capaian3' => $this->input->post("update[capaian3][{$value}]"),
						'capaian4' => $this->input->post("update[capaian4][{$value}]"),
					
					);
					$this->db->update('pk_indikator_target_triwulan', $object, array('id_pk_indikator_target_triwulan' => $value));

					$this->template->alert(
						' Tersimpan! Data berhasil tersimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}


	public function get_realisasi_bulanan($param = 0 , $tahun = 0)

	{
		return $this->db->get_where('realisasi_analisis_sasaran_bulanan', array('id_sasaran'=> $param, 'tahun_analisis_bulanan'=> $tahun))->result();	

	}

	public function get_realisasi($param = 0 )
	{
		return $this->db->get_where('realisasi_analisis_sasaran_bulanan',array('id_realisasi_analisis_sasaran_bulanan' => $param))->row();
	}

	public function update_realisasi($param = 0, $bulan = '')
	{
		$object = array(

			$bulan => $this->input->post($bulan),

		);
		$this->db->update('realisasi_analisis_sasaran_bulanan', $object, array('id_realisasi_analisis_sasaran_bulanan' => $param));

		$this->template->alert(
			'Tersimpan! Data berhasil tersimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}

 }