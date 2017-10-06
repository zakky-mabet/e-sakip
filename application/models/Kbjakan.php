<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kbjakan extends Skpd_model 
{
	protected $CI;

	public function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();

		$this->CI->load->model('tjuan','mstrategi');
	}

	public function getKebijakanByLogin()
	{
		$strategi = array();
		foreach ($this->CI->mstrategi->getStrategiByLogin() as $row) 
			$strategi[] = $row->id_strategi;

		$this->db->where_in('id_strategi', $strategi);

		return $this->db->get('kebijakan')->result();
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
						'id_strategi' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]"))
					);

					$this->db->insert('kebijakan', $object);

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

					$this->db->update('kebijakan', $object, array('id_kebijakan' => $value));

					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				}
			}
		}
	}

	public function getKebijakanByStrategi($strategi = 0)
	{
		return $this->db->get_where('kebijakan', array('id_strategi' => $strategi))->result();
	}

	public function delete($param = 0)
	{
		$this->db->delete('kebijakan', array('id_kebijakan' => $param));

		return array(
			'status' => 'success'
		);
	}
}

/* End of file Kbjakan.php */
/* Location: ./application/models/Kbjakan.php */