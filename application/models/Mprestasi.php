<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprestasi extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
	
	}

	public function create()
	{
		$object = array(
			'id_kepala' => $this->kepala,
			'deskripsi' => $this->input->post('prestasi'),
			'tingkat' => $this->input->post('tingkat'),
			'tahun' => $this->input->post('tahun')
		);

		$this->db->insert('prestasi', $object);
	}

	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('tingkat') !='')
			$this->db->where('tingkat', $this->input->get('tingkat'));

		if( $this->input->get('query') != '')
			$this->db->like('deskripsi', $this->input->get('query'));

		if( $this->input->get('thn') != '')
			$this->db->where('tahun', $this->input->get('thn'));

		$this->db->where('id_kepala', $this->kepala);

		if($type == 'result')
		{
			return $this->db->get('prestasi', $limit, $offset)->result();
		} else {
			return $this->db->get('prestasi')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('prestasi',array('id_prestasi' => $param))->row();
	}
	
	public function update($param = 0)
	{
		$object = array(
			'deskripsi' => $this->input->post('prestasi'),
			'tingkat' => $this->input->post('tingkat'),
			'tahun' => $this->input->post('tahun')
		);

		$this->db->update('prestasi', $object, array('id_prestasi' => $param));
	}

	public function delete($param  = 0)
	{
		$this->db->delete('prestasi', array('id_prestasi' => $param));
	}
}

/* End of file Mprestasi.php */
/* Location: ./application/models/Mprestasi.php */