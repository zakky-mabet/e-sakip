<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kbjakan extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
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

					$this->db->update('kebijakan', $object, array('id_strategi' => $value));

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