<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msatuan extends Skpd_model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create()
	{
		$object = array(
			'nama' => $this->input->post('satuan'),
			'jenis' => $this->input->post('jenis'),
			'id_skpd' => $this->SKPD
		);

		$this->db->insert('master_satuan', $object);

		$this->template->alert(
			' Tersimpan! Data berhasil tersimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function update($param = 0)
	{
		$object = array(
			'nama' => $this->input->post('satuan'),
			'jenis' => $this->input->post('jenis')
		);

		$this->db->update('master_satuan', $object, array('id' => $param));

		$this->template->alert(
			' Tersimpan! Perubahan berhasil tersimpan.', 
			array('type' => 'success','icon' => 'check')
		);
	}
	
	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select('master_satuan.*, skpd.nama as nama_skpd');

		$this->db->join('skpd', 'master_satuan.id_skpd = skpd.ID', 'left');

		if( $this->input->get('jenis') != '')
			$this->db->where('jenis', $this->input->get('jenis'));

		if( $this->input->get('skpd') != '')
			$this->db->where('master_satuan.id_skpd', $this->input->get('skpd'));

		if( $this->input->get('query') != '')
			$this->db->like('master_satuan.nama', $this->input->get('query'));

		if($type == 'result')
		{
			return $this->db->get('master_satuan', $limit, $offset)->result();
		} else {
			return $this->db->get('master_satuan')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('master_satuan',array('id' => $param))->row();
	}

	public function delete($param = 0)
	{
		$this->db->update('indikator_kinerja_program', array('id_satuan' => 0), array('id_satuan' => $param));
		$this->db->update('indikator_sasaran', array('id_satuan' => 0), array('id_satuan' => $param));
		$this->db->update('indikator_tujuan', array('id_satuan' => 0), array('id_satuan' => $param));
		$this->db->update('output_kegiatan_program', array('satuan' => 0), array('satuan' => $param));

		$this->db->delete('master_satuan', array('id' => $param));

		$this->template->alert(
			' Berhasil! Data berhasil terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}
}

/* End of file Msatuan.php */
/* Location: ./application/models/Msatuan.php */