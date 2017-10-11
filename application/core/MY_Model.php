<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model 
{

}

/**
* Extends Model Class
*
* @version 1.0.0
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
*/
class Skpd_model extends MY_Model
{
	public $periode_awal;

	public $periode_akhir;

	public $SKPD;

	public $kepala;

	public function __construct()
	{
		parent::__construct();

		$this->periode_awal = $this->session->userdata('SKPD')->periode_awal;

		$this->periode_akhir = $this->session->userdata('SKPD')->periode_akhir;

		$this->SKPD = $this->session->userdata('SKPD')->ID;

		$this->kepala = $this->session->userdata('SKPD')->kepala;
	}

	public function getAllSatuan()
	{
		return $this->db->get('master_satuan')->result();
	}

	public function getPeriode()
	{
		$periode = array();

		for($tahun = $this->tjuan->periode_awal; $tahun <= $this->tjuan->periode_akhir; $tahun++)
		{
			$periode[] = $tahun;
		}

		return $periode;
	}

	public function getInodikatorSasaranBySasaran($sasaran = 0, $IKU = FALSE)
	{
		$this->db->select('indikator_sasaran.*, master_satuan.nama as nama_satuan');
		$this->db->join('master_satuan', 'master_satuan.id = indikator_sasaran.id_satuan', 'left');
		$this->db->where('id_sasaran' , $sasaran);
		if($IKU)
			$this->db->where('indikator_sasaran.IKU', $IKU);
		return $this->db->get('indikator_sasaran')->result();
	}

	public function getFormulasiByIndikatorSasaran($indikator = 0)
	{
		$this->db->where('id_indikator_sasaran' , $indikator);
		return $this->db->get('formulasi_sasaran')->row();
	}

	public function getTargetSasaranBySasaranTahun($indikator = 0, $tahun)
	{
		return $this->db->get_where('target_sasaran', array(
			'id_indikator_sasaran' => $indikator,
			'tahunan' => $tahun
		))->row();
	}

	public function getRealisasiIndikatorSasaran($target = 0, $tahun = 0)
	{
		$this->db->join('target_sasaran', 'target_sasaran.id_target_sasaran = realisasi_indikator_sasaran.id_target_sasaran', 'left');

		return $this->db->get_where('realisasi_indikator_sasaran', array(
			'realisasi_indikator_sasaran.id_target_sasaran' => $target,
			'target_sasaran.tahunan' => $tahun
		))->row();
	}

	public function getIndikatorSasaranPKPerubahan($indikator = 0, $tahun = 0)
	{
		$targetSasaran = $this->getTargetSasaranBySasaranTahun($indikator, $tahun);

		return $this->db->get_where('pk_indikator_target', array('id_indikator_target' => $targetSasaran->id_target_sasaran))->row();
	}

	public function getIndikatorTargetTriwulanByIndikatorSasaran($indikator = 0, $tahun = 0)
	{
		return 	$this->db->get_where('pk_indikator_target_triwulan', array(
					'id_indikator_sasaran' => $indikator,
					'tahun_triwulan' => $tahun
				))->row();
	}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */

