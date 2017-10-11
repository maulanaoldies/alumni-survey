<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation','email'));
		$this->load->model(array('auth_model'));
	}

	function index()
	{
		if($this->session->userdata('logged_in') == FALSE)
		{
			redirect ('auth/login','refresh');
		}
		else {
			redirect ('home','refresh');
		}
	}

	public function login()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			redirect ('home','refresh');
		}
		
		$data['title'] = $this->lang->line('login_title');
		$this->form_validation->set_rules('username', str_replace(':', '','Username'), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '','Password'), 'required');

		if ($this->form_validation->run() == true)
		{
			$remember = (bool) $this->input->post('remember');

			if ($this->auth_model->login($this->input->post('username'), md5($this->input->post('password')), $remember))
			{
				$data['msg'] = '';
				redirect('home', 'refresh');
			}
			else
			{
				$data['msg'] = '<div class="alert alert-error">Username atau Password salah</div>';
				$this->load->view('login',$data); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			$data['msg'] = '';

			$data['username'] = array('name' => 'usernamae',
				'id'    => 'username',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('username'),
			);
			$data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->load->view('login',$data);
		}
	}

	function logout()
	{
		$this->data['title'] = "Logout";

		$logout = $this->auth_model->logout();

		redirect('auth/login', 'refresh');
	}
	
	
	function reset_password(){
		$data['title'] = $this->lang->line('login_title');
		
		$this->form_validation->set_rules('email','Email','required');
		
		if ($this->form_validation->run() == true)
		{
			$kode 		= $this->auth_model->check_email($this->input->post('email'));
			if($kode)
			{
				$data = array(
					'nip'		=> $kode['nip'],
					'password'	=> $kode['password']
				);
				
				$config['protocol'] = 'mail';
				$config['mailtype'] = 'html';
				$config['charset'] = 'utf-8';
				$config['newline'] = "\r\n";
				$config['wordwrap'] = TRUE;
				$config['smtp_timeout'] = 30;
				
				$this->email->initialize($config);
				
				$message = $this->load->view('email/forgot_password_tpl', $data, true);
				
				$this->email->clear();
				$this->email->from('no-reply@bappenas.go.id','NO REPLY BAPPENAS');
				$this->email->to($kode['email']);
				//$this->email->to($pemantau->email);
				$this->email->subject('Password Recovery');
				$this->email->message($message);

				if ($this->email->send())
				{
					$data['msg'] = '<div class="alert alert-success">Recovery password telah dikirim ke alamat email anda. silahkan cek email anda untuk melanjutkan</div>';
				}
				else
				{
					$data['msg'] = '<div class="alert alert-success">Failed to send data to your email</div>';
				}
				
				$this->load->view('reset_password',$data);
			}else{
				$data['msg'] = '<div class="alert alert-error">Alamat email tidak terdaftar</div>';
				$this->load->view('reset_password',$data);
			}
		}
		else
		{
			$data['msg'] = '';

			$data['email'] = array('name' => 'email',
				'id'    => 'email',
				'type'  => 'email'
			);

			$this->load->view('reset_password',$data);
		}
	}
	
	public function forgot_password($kode = NULL)
	{
		if (!$kode)
		{
			show_404();
		}
		
		$user = $this->auth_model->forgot_password_check($kode);
		
		if ($user)
		{
			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[8]|max_length[50]');
			$this->form_validation->set_rules('new_confirm', 'Confirm Password', 'required|matches[new]');

			if ($this->form_validation->run() == false)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = 8;
				$this->data['new_password'] = array(
					'name'	=> 'new',
					'id'	=> 'new',
					'type'	=> 'password',
					'class'	=> 'form-control'
				);
				$this->data['new_password_confirm'] = array(
					'name'	=> 'new_confirm',
					'id'	=> 'new_confirm',
					'type'	=> 'password',
					'class'	=> 'form-control'
				);
				$this->data['user_id'] = array(
					'name'	=> 'id',
					'id'	=> 'id',
					'type'	=> 'hidden',
					'value'	=> $user->id_datadiri,
				);
				$this->data['code'] = $kode;
				$this->load->view('password_reset', $this->data);
			}
			else
			{
				if ($user->id_datadiri != $this->input->post('id'))
				{
					$this->auth_model->clear_kodeforgot($kode);
					$this->session->set_flashdata('message','Invalid token or id');
					echo $this->session->flashdata('message');
					redirect('auth/reset_password/'.$kode, 'refresh');
				}
				else
				{
					$identity = $user->id_datadiri;

					$change = $this->auth_model->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						echo $this->session->flashdata('message');
						redirect("auth/login", 'refresh');
					}
					else
					{
						echo $this->session->flashdata('message');
						redirect('auth/reset_password/' . $kode, 'refresh');
					}
				}
			}
		}
		else
		{
			echo $this->session->flashdata('message');
		}
	}
}
