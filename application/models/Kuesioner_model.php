<?php  if (! defined('BASEPATH')) {exit('No direct script access allowed');}
	/**
	* Name: Kuesioner_model
	* Author: maulanaoldies
	*
	* Requirements: PHP5 or above
	*
	*/

class Kuesioner_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db_admin = $this->load->database('admin', true);
	}

	function get($filter = null)
	{
		if ($filter) {
			$this->db->where($filter);
		}
		$q = $this->db->get('s_kuesioner');
		return $q;
	}
	
	function get_soal_kuesioner($filter)
	{
		$this->db->select('s.id_kuesioner, k.id_seleksi, k.program, s.id AS id_soal, j.id_peserta, s.order, s.soal, s.type, s.ket_jawaban, j.jawaban, s.hide_dom');
		$this->db->where($filter);
		$this->db->join('s_jawab_kuesioner j', 'j.id_soal = s.id','LEFT');
		$this->db->join('s_kuesioner k','s.id_kuesioner = k.id','LEFT');
		$this->db->order_by('s.id','ASC');
		$q[0] = $this->db->get('s_soal_kuesioner s');
		
		if($q[0]->num_rows() > 0){
			$q[1] = FALSE;
			return $q;
		}else{
			$key = array(
				'k.id'	=> $filter['k.id'],
				'k.diklat' => $filter['k.diklat']
			);
			$this->db->select('k.id AS id_kuesioner, k.nama, s.id AS id_soal, s.order, s.id_kuesioner, s.soal, s.type, s.ket_jawaban, s.hide_dom');
			$this->db->where($key);
			$this->db->join('s_kuesioner k','s.id_kuesioner = k.id');
			$a[0] = $this->db->get('s_soal_kuesioner s');
			$a[1] = TRUE;
			return $a;
		}
	}
	
	
}
