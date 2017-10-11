<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('logged_in') == FALSE){
			redirect('auth', 'refresh');
		}
		
		$this->load->model(array('Karyasiswa_model','Kuesioner_model'));

		$this->open = array('open','','','','','','');
	}
	
	public function index()
	{
		$data['title']		= 'Dashboard';
		$data['pagetitle']	= 'Dashboard';
		$data['active']		= $this->open;
		
		$id = $this->session->userdata('id_peserta');
		$id_seleksi = $this->session->userdata('id_seleksi');
		$program = $this->session->userdata('program');
		
		$data['profil']	= $this->Karyasiswa_model->get("p.id_peserta = '$id'")->row();
		$data['kuesioner'] = $this->Kuesioner_model->get("id_seleksi = '$id_seleksi' AND id_kategori_kuesioner = '2' AND program LIKE '%$program%'");
		$data['content']    = 'dashboard';

		$data['p_css']		= array('css/profile.min.css');
		
		$data['p_js']		= array('js/profile.min.js');
		
		$this->load->view('main',$data);
	}
}
