<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mvisi extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function CreateUpdate()
	{
		if( $this->getByLogin() == FALSE) 
		{
			$object = array(
				'deskripsi' => $this->input->post('visi'),
				'penjabaran' => $this->input->post('penjabaran'),
				'id_kepala' => $this->kepala
			);

			$this->db->insert('visi', $object);
		} else {
			$object = array(
				'deskripsi' => $this->input->post('visi'),
				'penjabaran' => $this->input->post('penjabaran')
			);

			$this->db->update('visi', $object, array('id_kepala' => $this->kepala));
		}
	}

	public function getByLogin()
	{
		return $this->db->get_where('visi', array('id_kepala' => $this->kepala))->row();
	}
	

}

/* End of file Mvisi.php */
/* Location: ./application/models/Mvisi.php */