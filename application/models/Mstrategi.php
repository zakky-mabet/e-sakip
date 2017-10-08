<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstrategi extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

		$this->CI->load->model('tjuan','mprogram');
	}

	public function getStrategiByLogin()
	{
		$sasaran = array();
		foreach ($this->CI->mprogram->getSasaranByLogin() as $row) 
			$sasaran[] = $row->id_sasaran;

		$this->db->where_in('id_sasaran', $sasaran);

		return $this->db->get('strategi')->result();
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
							' Maaf! tahun aktif dan strategi tidak boleh kosong.', 
							array('type' => 'danger','icon' => 'check')
						);
						continue;
					}

					$object = array(
						'id_sasaran' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]"))
					);

					$this->db->insert('strategi', $object);

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

					$this->db->update('strategi', $object, array('id_strategi' => $value));

					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}

	public function getStrategiBySasaran($sasaran = 0)
	{
		return $this->db->get_where('strategi', array('id_sasaran' => $sasaran))->result();
	}

	public function delete($param = 0)
	{
		$this->db->delete('strategi', array('id_strategi' => $param));

		return array(
			'status' => 'success'
		);
	}
}

/* End of file Mstrategi.php */
/* Location: ./application/models/Mstrategi.php */