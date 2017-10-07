<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_skpd extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library( array('session', 'form_validation', 'session','template'));

		$this->load->model('users_skpd', 'user');

		$this->load->helper(array('url'));
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$user = $this->user->get_admin_login();

			if( $user != FALSE)
			{
				if ( password_verify($this->input->post('password'), $user->password) ) 
				{
			        $user_session = array(
			        	'skpd_login' => TRUE,
			        	'ID' => $user->ID,
			        	'SKPD' => (Object) array(
			        		'ID' => $user->ID,
			        		'nama' => $user->nama,
			        		'telepon' => $user->no_telp,
			        		'email' => $user->email,
			        		'alamat' => $user->alamat,
			        		'username' => $user->username,
			        		'kepala' => $user->id_kepala,
			        		'periode_awal' => $user->periode_awal,
			        		'periode_akhir' => $user->periode_akhir
			        	)
			        );	

			        $this->session->set_userdata( $user_session );

					if( $this->input->get('from_url') != '' )
					{
						redirect($this->input->get('back-to'));
					} else {
						redirect(base_url('skpd/home'));
					}
				} else {
					$this->template->alert(
						' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
						array('type' => 'danger','icon' => 'warning')
					);
				}
			} else {
				$this->template->alert(
					' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
					array('type' => 'danger','icon' => 'warning')
				);
			}
		}

		$this->data = array(
			'title' => "Login E-SAKIP", 
		);

		$this->load->view('skpd/login', $this->data);
	}

	public function signout()
	{
		$this->session->sess_destroy();

		redirect(base_url("login"));
	}
}

/* End of file Login_skpd.php */
/* Location: ./application/controllers/Login_skpd.php */