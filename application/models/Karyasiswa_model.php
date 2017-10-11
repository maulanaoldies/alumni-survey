<?php  if (! defined('BASEPATH')) {exit('No direct script access allowed');}
	/**
	* Name: karyasiswa_model
	* Author: maulanaoldies
	*
	* Requirements: PHP5 or above
	*
	*/

class Karyasiswa_model extends CI_Model
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
		$this->db->select('p.id_peserta, p.id_datadiri, p.id_seleksi, pr.id_program, pr.id_gelar, pr.id_univ, pr.id_jurusan, pr.id_kategori, pr.id_lokasi, s.tahun, s.nama AS seleksi, pr.nama AS program, p.penempatan, p.penempatan2, p.penempatan3, d.nip, d.nama, d.uname, d.foto');
		$this->db->join('t_datadiri d', 'd.id_datadiri = p.id_datadiri');
		$this->db->join('t_seleksi s', 's.id_seleksi = p.id_seleksi');
		$this->db->join('t_program pr', 'pr.id_program = p.penempatan');
		$this->db->order_by('p.id_seleksi', 'DESC');
		$q = $this->db->get('t_peserta p');
		return $q;
	}
	
	
}
