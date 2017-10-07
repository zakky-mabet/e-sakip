<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maccount extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function getSkpdByLogin()
	{
		return $this->db->get_where('skpd', array('ID'=>$this->SKPD))->row();
	}

	public function getKepalaByLogin()
	{
		return $this->db->get_where('kepala_skpd', array('id_kepala'=>$this->kepala))->row();
	}

	public function profileUpdate()
	{
		$SKPD =   array(
			'nama' => $this->input->post('nama_opd'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'no_telp' =>$this->input->post('phone')
		);

		$this->db->update('skpd', $SKPD, array('ID' => $this->SKPD));

		$kepala = array(
			'nama_kepala' => $this->input->post('nama_kepala'),
			'nip_kepala' => $this->input->post('nip_kepala'),
			'pangkat' => $this->input->post('pangkat'),
			'golongan' => $this->input->post('golongan'),
			'jabatan' => $this->input->post('jabatan')
		);

		$this->db->update('kepala_skpd', $kepala, array(
			'id_kepala' => $this->kepala,
			'id_skpd' => $this->SKPD
		));

		if( $this->db->affected_rows() )
		{
			$this->template->alert(
				' Tersimpan! Perubahan berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal! Tidak ada data yang diubah.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function passwordUpdate()
	{
		if($this->input->post('new_pass') != '')
		{
			$object = array(
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT)
			);
		} else {
			$object = array(
				'username' => $this->input->post('username')
			);
		}

		$this->db->update('skpd', $object, array('ID' => $this->SKPD));

		if( $this->db->affected_rows() )
		{
			$this->template->alert(
				' Tersimpan! Perubahan berhasil tersimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal! Tidak ada data yang diubah.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}
}

/* End of file Maccount.php */
/* Location: ./application/models/Maccount.php */