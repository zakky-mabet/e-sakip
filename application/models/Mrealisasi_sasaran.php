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


	public function create()
	{

		if (isset($_FILES['foto'])) 
	   {
	     	$create_tgl = date('Y-m-d H:i:s'); 
		    $this->load->library('upload');
		    $nmfile = date('YmdHis'); 
		    $config['upload_path'] = './assets/lampiran/';
		    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|'; 
		    $config['max_size'] = '40480';
		    $config['max_width']  = '12880';
		    $config['max_height']  = '7680';
		    $config['file_name'] = $nmfile; 
	     	$this->upload->initialize($config);
	     	if ($this->upload->do_upload('foto'))
			{ 
		       	$foto = $this->upload->data();
	     	}
        }

		$object = array(
			'id_kepala' => $this->kepala,
			'keterangan' => $this->input->post('keterangan'),
			'tahun' => $this->input->post('tahun'),
			'bulan' => $this->input->post('bulan'),
			'kategori' => $this->input->post('kategori'),
			'file' =>  $foto['file_name'],
			'dates' => date('Y-m-d H:i:s'),
		);

		$this->db->insert('lampiran', $object);
	}

	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('tahun') !='')
			$this->db->where('tahun', $this->input->get('tahun'));

		if( $this->input->get('query') != '')
			$this->db->like('keterangan', $this->input->get('query'));

		if( $this->input->get('bulan') != '')
			$this->db->where('bulan', $this->input->get('bulan'));

		if( $this->input->get('kategori') != '')
			$this->db->where('kategori', $this->input->get('kategori'));

		$this->db->where('id_kepala', $this->kepala);

		if($type == 'result')
		{
			return $this->db->get('lampiran', $limit, $offset)->result();
		} else {
			return $this->db->get('lampiran')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('lampiran',array('id' => $param))->row();
	}
	
	public function update_lampiran($param = 0, $unlink = '')
	{
		
	     	$create_tgl = date('Y-m-d H:i:s'); 
		    $this->load->library('upload');
		    $nmfile = date('YmdHis'); 
		    $config['upload_path'] = './assets/lampiran/';
		    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|'; 
		    $config['max_size'] = '40480';
		    $config['max_width']  = '12880';
		    $config['max_height']  = '7680';
		    $config['file_name'] = $nmfile; 
	     	$this->upload->initialize($config);
	     	$foto = array();
	     	if ($this->upload->do_upload('foto'))
			{ 
		       	$foto = $this->upload->data();
	     	}
        
		$object = array(
			'keterangan' => $this->input->post('keterangan'),
			'tahun' => $this->input->post('tahun'),
			'bulan' => $this->input->post('bulan'),
			'kategori' => $this->input->post('kategori'),
			'file' =>  $this->upload->file_name,
			'dates' => date('Y-m-d H:i:s'),
		);

		@unlink("assets/lampiran/".$unlink);

		$this->db->update('lampiran', $object, array('id' => $param));

		$this->template->alert(
			'Tersimpan! Data berhasil diubah.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete($param  = 0)
	{
		$this->db->delete('lampiran', array('id' => $param));
	}

	public function get_lampiran($param = 0 )
	{
		return $this->db->get_where('lampiran',array('id' => $param))->row();
	}

	public function get_sasaran_program_dan_kegiatan($param=0, $tahun=0)
	{
		return $this->db->get_where('sasaran', array('id_kepala' => $this->session->userdata('SKPD')->ID, 'id_sasaran' => $param))->row();
	}

	public function get_sasaran_program($param=0)
	{
		return $this->db->get_where('program', array('id_sasaran' => $param))->result();
	}

	public function get_sasaran_kegiatan($param=0, $tahun = 0)
	{
		$this->db->join('anggaran_kegiatan', 'anggaran_kegiatan.id_kegiatan = kegiatan_program.id_kegiatan', 'left');

		return $this->db->get_where('kegiatan_program', array('kegiatan_program.id_program' => $param, 'anggaran_kegiatan.tahun'=>$tahun))->result();
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

	public function program_penyerapan_per_kegiatan($program = 0, $tahun = 0)
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
				SELECT SUM(realisasi_anggaran_kegiatan.nilai_anggaran) AS anggaran FROM realisasi_anggaran_kegiatan 
				WHERE id_kegiatan IN ({$IDKegiatan}) AND tahun = '{$tahun}'
			")->row('anggaran');
		} else {
			return 0;
		}

	 	return $anggaran;
	}

	public function penyerapan_per_kegiatan($param=0, $tahun=0)
	{
		$this->db->join('realisasi_anggaran_kegiatan', 'realisasi_anggaran_kegiatan.id_kegiatan = kegiatan_program.id_kegiatan', 'left');

		$kegiatan_program =  $this->db->get_where('kegiatan_program', array('kegiatan_program.id_kegiatan' => $param, 'realisasi_anggaran_kegiatan.tahun'=>$tahun))->result();

		foreach ($kegiatan_program as $key => $value) {
			$nilai[] = $value->nilai_anggaran;
		}

		return array_sum($nilai);
	}

	public function update_output()
	{
		if( $this->input->post('create') )
		{
			if( is_array($this->input->post('create')) )
			{
				
					$this->template->alert(
						'Kesalahan Dalam Menyimpan Data ! Silahkan Ulangi', 
						array('type' => 'warning','icon' => 'warning')
					);
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'output' => $this->input->post("update[output][{$value}]"),

					);
					$this->db->update('anggaran_kegiatan', $object, array('id_anggaran_kegiatan' => $value));

					$this->template->alert(
						' Tersimpan! Data berhasil tersimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}

 }