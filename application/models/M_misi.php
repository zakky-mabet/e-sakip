<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_misi extends CI_Model 
{
	public function get_admin_login()
	{
		if (filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL)) 
		{
			$this->db->where('email', $this->input->post('username'));
		} else {
			$this->db->where('username', $this->input->post('username'));
		}

		$this->db->join('skpd', 'kepala_skpd.id_kepala = skpd.ID', 'left');

		return $this->db->get('kepala_skpd')->row();
	}
	
	public function get_misi(){
	
		$this->db->select('misi.id_misi,misi.id_kepala,misi.deskripsi,misi.tahun,kepala_skpd.periode_awal,kepala_skpd.periode_akhir');

		$this->db->join('kepala_skpd', 'kepala_skpd.id_kepala = misi.id_kepala', 'left');

		return $this->db->get('misi')->result();
	}

	public function create(){
		
		
	}

}

/* End of file Users_skpd.php */
/* Location: ./application/models/Users_skpd.php */