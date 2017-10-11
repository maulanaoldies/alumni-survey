<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

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
		
		$id_peserta = $this->session->userdata('id_peserta');
		$id_seleksi = $this->session->userdata('id_seleksi');
		$program = $this->session->userdata('program');
		
		$data['profil']	= $this->Karyasiswa_model->get("p.id_peserta = '$id_peserta'")->row();
		$data['kuesioner'] = $this->Kuesioner_model->get("id_seleksi = '$id_seleksi' AND id_kategori_kuesioner = '2' AND program LIKE '$program'");

		$data['p_css']		= array('css/profile.min.css');
		$data['p_js']		= array('js/profile.min.js');
		
		$data['content']    = 'dashboard';
		
		$this->load->view('main',$data);
	}
	
	function jawab_kuesioner($id)
	{
		$data['title']		= 'Kuesioner';
		$data['pagetitle']	= 'Dashboard';
		$data['active']		= $this->open;
		
		$id_peserta = $this->session->userdata('id_peserta');
		$id_seleksi = $this->session->userdata('id_seleksi');
		$program = $this->session->userdata('program');
		
		$data['profil']	= $this->Karyasiswa_model->get("p.id_peserta = '$id_peserta'")->row();
		
		$kuesioner = $this->Kuesioner_model->get("id_seleksi = '$id_seleksi' AND id_kategori = '2' AND program LIKE '%$program%' AND id=$id");
		
		if($kuesioner->num_rows() == 1){
			$k = $kuesioner->row();
			$date = date('Y-m-d');
			if($date >= $k->date_start AND $date <= $k->date_end){
				$kues = $k;
			}else{
				$kues = FALSE;
				$this->session->set_flashdata('err_message','Waktu Pengisian Kuesioner Telah Habis');
			}
		}else{
			$kues = FALSE;
			$this->session->set_flashdata('err_message','Kuesioner tidak ditemukan');
		}
		
		$data['kuesioner'] = $kues;
		$ques = $this->Kuesioner_model->get_soal_kuesioner("k.id_seleksi = '$id_seleksi' AND k.id_kategori = '2' AND k.program LIKE '%$program%' AND k.id=$id");
		$data['quesioner']	= $ques[0];
		$data['submit'] = $ques[1];
		$ses = array(
			'que' => $id
		);
		
		$data['p_css']		= array('css/profile.min.css');
		$data['p_js']		= array('js/profile.min.js');
		
		$data['content']    = 'kuesioner';
		$this->load->view('main',$data);
	}
	
	function isi_kuesioner($name)
	{
		$data['title']		= 'Kuesioner';
		$data['pagetitle']	= 'Dashboard';
		$data['active']		= $this->open;
		
		$id_peserta = $this->session->userdata('id_peserta');
		$id_seleksi = $this->session->userdata('id_seleksi');
		$program = $this->session->userdata('program');
		
		$data['profil']	= $this->Karyasiswa_model->get("p.id_peserta = '$id_peserta'")->row();
		
		$data['submit'] = TRUE;
		
		$data['p_css']		= array('css/profile.min.css');
		$data['p_js']		= array('js/profile.min.js','plugins/bootbox/bootbox.min.js','js/ui-bootbox.js','plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js','js/form-wizard.js');
		
		$data['content']    = 'kuesioner_'.$name;
		$this->load->view('main',$data);
	}
	
	
}
