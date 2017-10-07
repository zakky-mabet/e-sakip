<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Skpd 
{
	public $nav;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Pengaturan Akun',  'skpd/account');

		$this->load->model(array('maccount'));

		$this->nav = (!$this->input->get('nav')) ? 'profil' : $this->input->get('nav');
	}

	public function index()
	{
		$this->page_title->push('Pengaturan Akun', '');

		$this->nav = (!$this->input->post('nav')) ? 'profil' : $this->input->post('nav');

		switch ($this->input->post('nav')) 
		{
			case 'change_password':
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[8]|max_length[12]');
				$this->form_validation->set_rules('repeat_new_pass', 'Ini', 'trim|matches[new_pass]');
				$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');
				if ($this->form_validation->run() == TRUE) 
				{
					$this->maccount->passwordUpdate();
					redirect('skpd/account?nav=change_password');
				}
				break;
			default:
				$this->form_validation->set_rules('nama_opd', 'Nama OPD', 'trim|required');
				$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
				$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
				$this->form_validation->set_rules('phone', 'No Telepon', 'trim|required');
				$this->form_validation->set_rules('nip_kepala', 'NIP Kepala', 'trim|required');
				$this->form_validation->set_rules('nama_kepala', 'Nama Kepala', 'trim|required');
				$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
				$this->form_validation->set_rules('pangkat', 'E-Mail', 'trim|required');
				$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required');
				if ($this->form_validation->run() == TRUE) 
				{
					$this->maccount->profileUpdate();
					redirect('skpd/account');
				}
				break;
		}

		$this->data = array(
			'title' => "Pengaturan Akun", 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'SKPD' => $this->maccount->getSkpdByLogin(),
			'kepala' => $this->maccount->getKepalaByLogin()
		);

		$this->template->view('skpd/instansi/account', $this->data);
	}

	/**
	 * Cek kebenaran password
	 *
	 * @return Boolean
	 **/
	public function validate_password()
	{
		$SKPD = $this->maccount->getSkpdByLogin();

		if(password_verify($this->input->post('old_pass'), $SKPD->password))
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
}

/* End of file Account.php */
/* Location: ./application/controllers/skpd/Account.php */