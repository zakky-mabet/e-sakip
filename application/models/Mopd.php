<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mopd extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		if( $this->input->get('q') != '')
			$this->db->like('nama', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('skpd', $limit, $offset)->result();
		} else {
			return $this->db->get('skpd')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('skpd', array('ID' => $param))->row();
	}

	public function username_check($ID = FALSE)
	{
		if($ID == FALSE)
		{
			return $this->db->get_where('skpd', array('username' => $this->input->post('username')))->num_rows();
		} else {
			return $this->db->query("SELECT username FROM skpd WHERE username IN('{$this->input->post('username')}') AND ID != '{$ID}'")->num_rows();
		}
	}

	public function create()
	{
		$object = array(
			'nama' => $this->input->post('nama_opd'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'no_telp' => $this->input->post('phone')
		);

		$this->db->insert('skpd', $object);

		$this->template->alert(
			' Tersimpan! Data berhasil tersimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function update($param = 0)
	{
		$object = array(
			'nama' => $this->input->post('nama_opd'),
			'username' => $this->input->post('username'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'no_telp' => $this->input->post('phone')
		);

		if( $this->input->post('new_pass') != '')
			$object['password'] = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		$this->db->update('skpd', $object, array('ID' => $param));

		if( $this->db->affected_rows() )
		{
			$this->template->alert(
				' Tersimpan! Data berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal! tidak ada perubahan.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}
}

/* End of file Mopd.php */
/* Location: ./application/models/Mopd.php */