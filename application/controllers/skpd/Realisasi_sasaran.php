<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_sasaran extends Skpd 
{
	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Kinerja',  $this->uri->uri_string());

		$this->load->model(array('mrealisasi_sasaran','msasaran'));

		$this->load->js(base_url("assets/public/app/dynamic-form.js"));

		$this->load->js(base_url("assets/public/app/zdynamic-form.js"));

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');

		$this->kategori = $this->input->get('kategori');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Realisasi Indikator  ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Capaian Kinerja Indikator Sasaran Per Tahun');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Capaian Kinerja Indikator Sasaran Per Tahun", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRealisasi_sasaran', $this->data);
	}


	public function program_dan_kegiatan($param=0, $tahun=0)
	{
		if (!$param AND !$tahun) {
			redirect('404');
		}
		$this->breadcrumbs->unshift(2, 'Realisasi Indikator ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Capaian Kinerja Indikator Sasaran Per Tahun ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Capaian Kinerja Indikator Sasaran Per Tahun", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'get_sasaran_program_dan_kegiatan' => $this->mrealisasi_sasaran->get_sasaran_program_dan_kegiatan($param, $tahun),
			'tahun' => $tahun,
			'param' => $param,
		);

		$this->template->view('skpd/vRealisasi_sasaran_program_dan_kegiatan', $this->data);
	}


	public function triwulan()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja Triwulan ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Target Indikator Penetapan Kinerja Triwulan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja Triwulan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRealisasi_sasaran_triwulan', $this->data);
	}


	Public function bulanan()
	{
		$this->breadcrumbs->unshift(2, 'Target Indikator Penetapan Kinerja bulanan ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Target Indikator Penetapan Kinerja bulanan ');

		$this->tahun = $this->uri->segment(4);

		$this->data = array(
			'title' => "Target Indikator Penetapan Kinerja bulanan ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
		);

		$this->template->view('skpd/vRealisasi_sasaran_bulanan', $this->data);
	}

	Public function lampiran()
	{
		$this->breadcrumbs->unshift(2, 'Lampiran dan Foto Progres Kinerja ',  $this->uri->uri_string());

		$this->page_title->push('Kinerja', 'Lampiran dan Foto Progres Kinerja ');

		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->mrealisasi_sasaran->create();
			echo "<pre>";
			print_r ($this->input->post());
			echo "</pre>";
			//redirect(current_url());
		}

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			skpd/realisasi_sasaran/lampiran?per_page={$this->per_page}&tahun={$this->input->get('tahun')}&bulan={$this->input->get('bulan')}&query={$this->query}&kategori={$this->kategori}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->mrealisasi_sasaran->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Lampiran dan Foto Progres Kinerja  ", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'lampiran' => $this->mrealisasi_sasaran->getall($this->per_page, $this->page, 'result')
		);

		$this->template->view('skpd/vRealisasi_sasaran_lampiran', $this->data);
	}

	public function save()
	{
		$this->mrealisasi_sasaran->Update();
		
		redirect("skpd/realisasi_sasaran");

	}

	public function savetriwulan()
	{
		$this->mrealisasi_sasaran->UpdateTriwulan();
		
		redirect("skpd/realisasi_sasaran/triwulan");
	}


	public function updateanalisis()
	{
		$this->mrealisasi_sasaran->Update_analisis();
		
		redirect("skpd/realisasi_sasaran");
	}

	public function get_json($param = 0 )
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->mrealisasi_sasaran->get_realisasi($param)));
	}

	

	public function update_realisasi($param = 0,  $bulan = '')
	{
		$this->mrealisasi_sasaran->update_realisasi($param,$bulan);
			
		redirect("skpd/realisasi_sasaran/bulanan");
	}

	public function get_lampiran($param = 0 )
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->mrealisasi_sasaran->get_lampiran($param)));
	}

	public function update_lampiran($param=0, $unlink='')
	{
		$this->mrealisasi_sasaran->update_lampiran($this->input->post('ID'), $this->input->post('unlink_file') );

		redirect('skpd/realisasi_sasaran/lampiran');
	}	

	public function delete($param = 0)
	{
		$this->mrealisasi_sasaran->delete($param);

		redirect('skpd/realisasi_sasaran/lampiran');
	}
	
		
}

/* End of file Target.php */
/* Location: ./application/controllers/skpd/Target.php */