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

	public function CreateUpdate()
	{
		echo "<pre>";
		print_r ($this->input->post());
		echo "</pre>";
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
				}
			}
		}
	}

	public function getProgramBySasaran($sasaran = 0)
	{
		return $this->db->get_where('program', array('id_sasaran' => $sasaran))->result();
	}

	public function delete($param = 0, $key = '')
	{
		switch ($key) 
		{
			case 'program':
				$this->db->delete('program', array('id_program' => $param));
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