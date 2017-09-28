<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sasaran extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
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
	
		$this->db->join('kepala_skpd', 'kepala_skpd.id_kepala = misi.id_kepala', 'left');

		return $this->db->get('misi')->result();
	}

	public function createorupdate()
	{
		if( $this->input->post('create') )
		{
			
	
			if( is_array($this->input->post('create')) )
			{
				$object = array();
				foreach($this->input->post('create[deskripsi]') as $key => $value) 
				{
					if( $value == FALSE OR $this->input->post("create[tahun][{$key}]") == FALSE)
						continue;			
					
					$object[] = array(
						'id_kepala' => $key,
						'deskripsi' => $value,
						'tahun' => implode(',', $this->input->post("create[tahun][{$key}]")),
					);
				}
				$this->db->insert_batch('misi', $object);
			}
			if($this->db->affected_rows())
				{
					$this->template->alert(
						' Data berhasil disimpan.', 
						array('type' => 'success','icon' => 'check')
					);
				} else {
					$this->template->alert(
						' Tidak ada data yang dihapus.', 
						array('type' => 'warning','icon' => 'warning')
					);
				}
		} 
		else {
			if( is_array($this->input->post('update')) )
			{
				foreach($this->input->post('update[ID]') as $key => $value) 
				{
					$object = array(
						'deskripsi' => $this->input->post("update[deskripsi][{$value}]"),
						'tahun' => implode(',', $this->input->post("update[tahun][{$value}]"))
					);
					$this->db->update('misi', $object, array('id_misi' => $value));
				}
			}
		}
	}

	
    public function delete($param = 0)
	{
	
		$this->db->delete('misi', array('id_misi' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Data berhasil dihapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada data yang dihapus.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

}

/* End of file Users_skpd.php */
/* Location: ./application/models/Users_skpd.php */