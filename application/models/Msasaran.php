<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msasaran extends Skpd_model 
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
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
				
						'id_kepala' =>$this->session->userdata('SKPD')->ID

					);
					$this->db->insert('sasaran', $object);

					$get_id_indikator_sasaran = $this->db->insert_id();

					//GENERATE PERMASALAH SASARAN
					$objectPR = array(
						'id_sasaran' => $get_id_indikator_sasaran,
					);

					$this->db->insert('permasalahan_sasaran', $objectPR);

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
					
					);
					$this->db->update('sasaran', $object, array('id_sasaran' => $value));

					$get_id_indikator_sasaran = $value;

					foreach ($this->input->post("update[tahun][{$value}]") as $valuetahun) {
					
						$query = $this->db->get_where('permasalahan_sasaran', array(
							'id_sasaran' => $get_id_indikator_sasaran,

						) );

						if ($query->num_rows()==0) {

							$this->db->insert('permasalahan_sasaran', array(
								'id_sasaran' => $get_id_indikator_sasaran,

							));
						}
					} // enforeach Update table Permasalahan sasaran
				}
			}
		}
	}

	public function getTujuanSasaran($misi = 0)
	{
		return $this->db->get_where('sasaran', array('id_tujuan' => $misi))->result();
	}

	public function getpermasalahan($permasalahan = 0)
	{
		return $this->db->get_where('permasalahan_sasaran', array('id_sasaran' => $permasalahan))->result();
	}

	public function getAkarpermasalahan($param)
	{
		return $this->db->get_where('akar_permasalahan_sasaran',  array('id_permasalahan' => $param))->result();
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

	public function master_sasaran()
	{
		return $this->db->get_where('master_sasaran', array('id_skpd' => $this->session->userdata('SKPD')->ID))->result();
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
				$this->db->delete('indikator_sasaran', array('id_indikator_sasaran' => $param));
				$this->db->delete('formulasi_sasaran', array('id_formulasi_sasaran' => $param));
				$this->db->delete('target_sasaran', array('id_indikator_sasaran' => $param));
				$respon['status'] = 'success';
				break;
			default:
				# code...
				break;
		}

		return $respon;
	}

	public function createmasalah (){

		$object = array(
			'id_sasaran' => $this->input->post('permasalahan[id_sasaran]'),
			'deskripsi'  => $this->input->post('permasalahan[deskripsi]'),
			);
		$this->db->insert('permasalahan_sasaran', $object);
	}


	/* Model Indikator Sasaran */

	
	public function get_tujuandansasaran(){
	
		$this->db->join('tujuan', 'tujuan.id_tujuan = sasaran.id_tujuan', 'left');

		return $this->db->get_where('sasaran', array('tujuan.id_kepala' => $this->kepala))->result();
	}

	public function get_sasaran($param){
	
		return $this->db->get_where('sasaran', array('id_sasaran' => $param))->result();
	}

	public function get_sasaran_indikator($id_sasaran = 0)
	{
		return $this->db->get_where('indikator_sasaran', array('id_sasaran' => $id_sasaran))->result();
	}

	public function satuan()
	{	
		return $this->db->get('master_satuan')->result();
	}

	public function master_indikator()
	{	
		return $this->db->get_where('master_indikator_sasaran', array('id_skpd' => $this->session->userdata('SKPD')->ID))->result();
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
							' Maaf! tahun aktif dan indikator tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'warning')
						);
						continue;
					}

					$object = array(
						'id_sasaran' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
						'id_satuan' => $this->input->post("create[id_satuan][{$key}]"),
						'PK' => $this->input->post("create[pk][{$key}]"),
						'IKU' => $this->input->post("create[iku][{$key}]"),
					);

					$this->db->insert('indikator_sasaran', $object);

					//fungsi ci ambil id saat insert
					$get_id_indikator_sasaran = $this->db->insert_id();

					if( is_array($this->input->post("create[tahun][{$key}]")) )
					{
						foreach ($this->input->post("create[tahun][{$key}]") as $item => $tahun) 
						{
							$this->Insert_id_ke_formulasi($get_id_indikator_sasaran, $tahun);

						}
					}

					$this->Insert_to_target($this->input->post("create[tahun][{$key}]"), $get_id_indikator_sasaran);

					$this->insertPKIndikatorKinerjaProgram($this->input->post("create[tahun][{$key}]"), $get_id_indikator_sasaran);

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
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'deskripsi' => $this->input->post("update[deskripsi][{$value}]"),
						'tahun' => implode(',', $this->input->post("update[tahun][{$value}]")),
						'id_satuan' => $this->input->post("update[id_satuan][{$value}]"),
						'PK' => $this->input->post("update[pk][{$value}]"),
						'IKU' => $this->input->post("update[iku][{$value}]"),
					);
					$this->db->update('indikator_sasaran', $object, array('id_indikator_sasaran' => $value));

					//fungsi ci ambil id saat insert

					$get_id_indikator_sasaran = $value;

					foreach ($this->input->post("update[tahun][{$value}]") as $valuetahun) {
					
						$query = $this->db->get_where('target_sasaran', array(
							'id_indikator_sasaran' => $get_id_indikator_sasaran,
							'tahunan' => $valuetahun,
						) );

						if ($query->num_rows()==0) {

							$this->db->insert('target_sasaran', array(
								'id_indikator_sasaran' => $get_id_indikator_sasaran,
								'nilai_target' => NULL,
								'tahunan' => $valuetahun
							));
						}
					} // enforeach Update table sasaran_target

					// GENERATE TARGET INDIKATOR PK TRIWULAN
					$this->insertPKIndikatorKinerjaProgram($this->input->post("update[tahun][{$value}]"), $value);

				}
			}
		}
	}
	//ini adalah fungsi get id dari indikator saat inser indikator sasaran
	public function Insert_id_ke_formulasi($get_id_indikator_sasaran = 0, $tahun = 0)
	{
		
			
		if( $this->cek_id_indikator_sasaran($get_id_indikator_sasaran, $tahun) == FALSE)
		{
			$this->db->insert('formulasi_sasaran', array(
				'id_indikator_sasaran' => $get_id_indikator_sasaran,
				'alasan' => NULL,
				'cara_pengukuran' => NULL,
				'keterangan' => NULL
			));
		}
		
	}
	//ini adalah fungsi get id dari indikator saat inser indikator sasaran
	public function cek_id_indikator_sasaran($get_id_indikator_sasaran = 0, $tahun = 0)
	{
		$query = $this->db->get_where('formulasi_sasaran', array(
			'id_indikator_sasaran' => $get_id_indikator_sasaran,
		) );
		return $query->num_rows(); 
	}

	/* Sasaran get_id_indikator_sasaran */

	public function get_sasaranTarget()
	{
		return $this->db->get('sasaran')->result();
	}

	public function Insert_to_target($tahun = 0, $get_id_indikator_sasaran = 0)
	{
		if( is_array($tahun) )
		{
			foreach ($tahun as $key => $item) 
			{
				if( $this->checkTarget($get_id_indikator_sasaran, $item) ) 
				{
					continue;
				} else {
					$this->db->insert('target_sasaran', array(
						'id_indikator_sasaran' => $get_id_indikator_sasaran,
						'nilai_target' => NULL,
						'tahunan' => $item
					));
				}
			}

			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function checkTarget($get_id_indikator_sasaran = 0, $tahun = 0)
	{
		$query = $this->db->get_where('target_sasaran', array(
			'id_indikator_sasaran' => $get_id_indikator_sasaran,
			'tahunan' => $tahun
		) );
		return $query->num_rows();
	}


	// GENERATE TARGET INDIKATOR PK TRIWULAN
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

					$this->db->insert('pk_indikator_target_triwulan', array(
						'id_indikator_sasaran' => $indikator,
					));
				}
			}
		}
	}

	public function checkPKIndikatorProgram($indikator = 0, $tahun = 0)
	{
		
			$query = $this->db->get_where('pk_indikator_target_triwulan', array(
				'id_indikator_sasaran' => $indikator,
		
			) );
		 
		return $query->num_rows(); 
	}


	//Permasalahan Sasaran

	public function CreateUpdatemasalah()
	{
		if( $this->input->post('updateakar') )
		{
			if( is_array($this->input->post('updateakar')) )
			{
				foreach($this->input->post('updateakar[ID]') as $key => $value) 
				{
					$object = array(

						'deskripsi_akar' => $this->input->post("updateakar[deskripsi][{$value}]"),
					
					);
					$this->db->update('akar_permasalahan_sasaran', $object, array('id' => $value));

				

				}
			}
		} else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(

						'deskripsi_permasalahan' => $this->input->post("update[deskripsi][{$value}]"),
					
					);
					$this->db->update('permasalahan_sasaran', $object, array('id_permasalahan' => $value));

					$get_id_indikator_sasaran = $value;

					for($i=0; $i<=5; $i++ ) {
					
						$query = $this->db->get_where('akar_permasalahan_sasaran', array(
							'id_permasalahan' => $get_id_indikator_sasaran,
						
						) );

						if ($query->num_rows()==0) {

							$this->db->insert('akar_permasalahan_sasaran', array(
								'id_permasalahan' => $get_id_indikator_sasaran,
							));
						}
					}

			
				}
			}
		}
	}

	public function delete_akar($param)
	{
		$this->db->delete('akar_permasalahan_sasaran', array('id' => $param));

					if($this->db->affected_rows())
					{
						$this->template->alert(
							' Data berhasil dihapus.', 
							array('type' => 'success','icon' => 'check')
						);
					} else {
						$this->template->alert(
							' Tidak ada data yang terhapus.', 
							array('type' => 'warning','icon' => 'warning')
						);
					} 
	}
}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */