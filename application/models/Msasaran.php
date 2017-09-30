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
						'opsi_sasaran' => $this->input->post("create[opsi_sasaran][{$key}]"),
					);

					$this->db->insert('sasaran', $object);
					
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
						'opsi_sasaran' => $this->input->post("update[opsi_sasaran][{$value}]"),
					);
					$this->db->update('sasaran', $object, array('id_sasaran' => $value));
				}
			
			}
		}
	}

	

	public function getTujuanSasaran($misi = 0)
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
						'indikator' => $this->input->post("create[indikator][{$key}]"),
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
						'indikator' => $this->input->post("update[indikator][{$value}]"),
					);
					$this->db->update('indikator_sasaran', $object, array('id_indikator_sasaran' => $value));

					//fungsi ci ambil id saat insert
					$get_id_indikator_sasaran = $this->db->insert_id();

					if( is_array($this->input->post("create[tahun][{$key}]")) )
					{
						foreach ($this->input->post("create[tahun][{$key}]") as $item => $tahun) 
						{
							$this->Insert_id_ke_formulasi($get_id_indikator_sasaran, $tahun);

						}
					}

					if($this->db->affected_rows())
					{
						$this->template->alert(
							' Data berhasil diubah.', 
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


	/* Sasaran Target */

	public function get_sasaranTarget()
	{
		return $this->db->get('sasaran')->result();
	}

}

/* End of file Tjuan.php */
/* Location: ./application/models/Tjuan.php */