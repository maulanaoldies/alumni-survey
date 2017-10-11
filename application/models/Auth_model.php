<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: User_Auth
* Author: maulanaoldies
*
* Requirements: PHP5 or above
*
*/

class Auth_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
		//$this->load->config('bappenas', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');

		$this->store_salt      = FALSE;
		$this->salt_length     = 8;


		// initialize hash method options (Bcrypt)
		$this->hash_method = 'bcrypt';
		$this->default_rounds = 8;
		$this->random_rounds = FALSE;
		$this->min_rounds = 9;
		$this->max_rounds = version_compare(PHP_VERSION, '5.3.7', '<') ? '$2a$' : '$2y$';

	}

	public function login($username, $password, $remember=FALSE)
	{
		$db1 = $this->load->database('simdiklat', TRUE);
		$db2 = $this->load->database('admin', TRUE);


		if (empty($username) || empty($password))
		{
			$this->session->set_flashdata('err_message','Login gagal, username atau password kosong');
			return FALSE;
		}

		$query1 = $db1->query("SELECT id_datadiri, nip, nama, uname, password, level, nama_inst, aktivasi
								FROM t_datadiri
								WHERE (nip='$username' OR uname='$username' ) AND
									password='$password'"
							);

		if ($query1->num_rows() > 0)
		{
			$user = $query1->row();
			$id_datadiri = $user->id_datadiri;

			$que = $db1->query("SELECT s.id_peserta, s.id_datadiri, s.penempatan, s.pstat, s.id_seleksi, p.id_program, p.id_kategori, p.id_lokasi
									FROM t_peserta s, t_program p
									WHERE s.id_datadiri ='$id_datadiri' AND
										s.penempatan !=''  AND
										s.pstat='1' AND
										s.id_seleksi IN ('0001c','0001d','0001e','0001f') AND
										s.penempatan = p.id_program
									ORDER BY id_seleksi DESC LIMIT 1
								");

			if ($que->num_rows() > 0)
			{
				$r = $que->row();

				if ($user->aktivasi == '' OR $user->aktivasi == 'N')
				{
    				$this->session->set_flashdata('err_message','Login gagal, anda belum melakukan aktifasi.');
					return FALSE;
				}
				
				if($r->id_kategori == '00001' AND $r->id_lokasi == '00001'){
					$level = 'Dalam Negeri';
				}else if($r->id_kategori == '00001' AND $r->id_lokasi == '00002'){
					$level = 'Overseas';
				}else if($r->id_kategori == '00001' AND $r->id_lokasi == '00003'){
					$level = 'Linkage';
				}else if($r->id_kategori == '00002'){
					$level = 'Non Gelar';
				}

				$user->id_seleksi = $r->id_seleksi;
				$user->id_peserta = $r->id_peserta;
				$user->level =	$level;
				
				$this->set_session($user, 2);

				$sid_lama = session_id();

				session_regenerate_id();

				$sid_baru = session_id();
				$tgllogin = date("Y-m-d");
				$jamlogin = date("H:i:s");

				$db1->query("UPDATE t_datadiri
								SET id_session='$sid_baru'
								WHERE (nip='$username' OR uname='$username' )
							");
				$db1->query("INSERT INTO t_zhistorystaff (id_datadiri, nip, tanggal_login, jam_login)
								VALUES ('$user->id_datadiri', '$user->nip', '$tgllogin', '$jamlogin')
							");
				return TRUE;
			}

		}
		else
		{
			$this->session->set_flashdata('err_message','Login gagal, username atau password salah');
			return FALSE;
		}
	}

	public function set_session($user, $db)
	{
		if($db == 2)
		{
			$session_data = array(
				'id_datadiri'	=> $user->id_datadiri,
				'id_seleksi'	=> $user->id_seleksi,
				'id_peserta'	=> $user->id_peserta,
				'username'		=> $user->nama,
				'program'		=> $user->level,
				'logged_in'		=> TRUE
			);
		}
		else
		{
			$session_data = array();

			if($user->otoritas == 'PPK'){
				$level = 'ppk';
			}
			elseif($user->otoritas == 'KEU'){
				$level = "keuangan";
			}elseif($user->otoritas == 'ADM'){
				$level = "admin";
			}elseif($user->otoritas == 'PRV'){
				$level = "prev";
			}elseif($user->otoritas == 'DIK'){
				$pem = $this->check_pemantau($user->id_person);
				if($pem)
				{
					$session = array(
						'seleksi' => $pem[0],
						'univ'	  => $pem[1],
						'prodi'	  => $pem[2]
					);
				}else{
					$this->logout;
				}
				$level = "pemantau";
				$this->session->set_userdata($session);
			}else{
				$this->logout;
			}
			

			$session_data = array(
				'user'		=> $user->userid,
				'otoritas'	=> $user->otoritas,
				'nama'		=> $user->name,
				'level'		=> $level,
				'id_person'	=> $user->id_person,
				'logged_in' => TRUE
			);
		}

		$this->session->set_userdata($session_data);

		return TRUE;

	}

	function check_pemantau($id)
	{
		$query = $this->db->query("
			SELECT 
				tp.id_seleksi,
				tp.id_person,
				tp.id_kateg,
				tp.id_lokasi,
				tp.id_gelar,
				tu.`name` AS univ,
				tu.description AS universitas,
				tj.`name` AS jur,
				tj.description AS jurusan
			FROM 
				t_pemantau tp, ts_universitas tu, ts_jurusan tj
			WHERE 
				tp.id_person='$id' AND 
				tp.id_univ = tu.id_master AND 
				tp.id_jurusan = tj.id_master AND
				tp.delstat = 'a'
			ORDER BY
				tp.id_pemantau DESC
		");
		if($query->num_rows()>0){
			$i = 0;
			foreach ($query->result() AS $q){
				$seleksi[$i] = $q->id_seleksi;
				$univ[$i]	 = $q->univ;
				$jur[$i]	 = $q->jur;
				$i++;
			}
			return array($seleksi,$univ,$jur);
		}else{
			return false;
		}
	}

	function logout()
	{
		$this->session->unset_userdata( array('logged_in','RF','nip','iddatadiri','nama','user','pass','level','instansi') );
		$this->session->sess_destroy();

		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->session->sess_create();
		}
		else
		{
			if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
				session_start();
			}
			$this->session->sess_regenerate(TRUE);
		}

		return TRUE;
	}

	function check_email($email)
	{
		$db1 = $this->load->database('simdiklat', TRUE);
		$db2 = $this->load->database('admin', TRUE);

		$query = $db1->query("SELECT id_datadiri, nip, uname, email, aktivasi FROM t_datadiri WHERE email=".$this->db->escape($email)." AND aktivasi='Y'");

		if($query->num_rows() > 0)
		{
			$row = $query->row();
			// All some more randomness
			$activation_code_part = "";
			if(function_exists("openssl_random_pseudo_bytes")) {
				$activation_code_part = openssl_random_pseudo_bytes(128);
			}

			for($i=0;$i<1024;$i++) {
				$activation_code_part = sha1($activation_code_part . mt_rand() . microtime());
			}

			$key = $this->hash_code($activation_code_part.$email);

			// If enable query strings is set, then we need to replace any unsafe characters so that the code can still work
			if ($key != '' && $this->config->item('permitted_uri_chars') != '' && $this->config->item('enable_query_strings') == FALSE)
			{
				// preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
				// compatibility as many are unaware of how characters in the permitted_uri_chars will be parsed as a regex pattern
				if ( ! preg_match("|^[".str_replace(array('\\-', '\-'), '-', preg_quote($this->config->item('permitted_uri_chars'), '-'))."]+$|i", $key))
				{
					$key = preg_replace("/[^".$this->config->item('permitted_uri_chars')."]+/i", "-", $key);
				}
			}

			$pas = md5($key);

			$q = $db1->query("UPDATE t_datadiri SET password='$pas' WHERE id_datadiri='".$row->id_datadiri ."' AND email='$email'");
			if ($q){
				return array('nip'=>$row->nip,'password'=>$key,'email'=>$email);}else{return false;}
		}
		else
		{
			return false;
		}
	}

	public function hash_code($password)
	{
		return $this->hash_password($password, FALSE, TRUE);
	}

	public function hash_password($password, $salt=false, $use_sha1_override=FALSE)
	{
		if (empty($password))
		{
			return FALSE;
		}

		// bcrypt
		if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt')
		{
			return $this->bcrypt->hash($password);
		}


		if ($this->store_salt && $salt)
		{
			return  sha1($password . $salt);
		}
		else
		{
			$salt = $this->salt();
			return  $salt;
		}
	}

	public function salt()
	{

		$raw_salt_len = 8;

 		$buffer = '';
        $buffer_valid = false;

        if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
            $buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
            $buffer = openssl_random_pseudo_bytes($raw_salt_len);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && @is_readable('/dev/urandom')) {
            $f = fopen('/dev/urandom', 'r');
            $read = strlen($buffer);
            while ($read < $raw_salt_len) {
                $buffer .= fread($f, $raw_salt_len - $read);
                $read = strlen($buffer);
            }
            fclose($f);
            if ($read >= $raw_salt_len) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
            $bl = strlen($buffer);
            for ($i = 0; $i < $raw_salt_len; $i++) {
                if ($i < $bl) {
                    $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                } else {
                    $buffer .= chr(mt_rand(0, 255));
                }
            }
        }

        $salt = $buffer;

        // encode string with the Base64 variant used by crypt
        $base64_digits   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $base64_string   = base64_encode($salt);
		$salt = strtr(preg_replace("/[^a-zA-Z]+/", "", $base64_string), $base64_digits, $bcrypt64_digits);
	   
		$salt = substr($salt, 0, 6);


		return $salt;

	}

	function forgot_password_check($kode)
	{
		$db1 = $this->load->database('simdiklat', TRUE);
		$profile = $db1->query("SELECT * FROM t_datadiri WHERE kodeforgot='$kode'")->row(); //pass the code to profile

		if (!is_object($profile))
		{
			$this->session->set_flashdata('err','Invalid request');
			return FALSE;
		}
		else
		{
			$expiration = 3600;
			if (time() - $profile->timeforgot > $expiration) {

				$this->session->set_flashdata('message','Expired link');
				return FALSE;
			}
			return $profile;
		}
	}

	public function reset_password($identity, $new)
	{
		if (!$this->identity_check($identity)) {
			return FALSE;
		}

		$db1 = $this->load->database('simdiklat', TRUE);
		$query = $db1->select('id_datadiri, password')
		                  ->where('id_datadiri', $identity)
		                  ->limit(1)
		    			  ->order_by('id_datadiri', 'desc')
		                  ->get('t_datadiri');

		if ($query->num_rows() !== 1)
		{
			$this->session->set_flashdata('message','password_change_unsuccessful');
			return FALSE;
		}

		$result = $query->row();

		$new = md5($new);

		// store the new password and reset the remember code so all remembered instances have to re-login
		// also clear the forgotten password code
		$data = array(
		    'password' => $new,
		    'kodeforgot' => NULL,
		    'timeforgot' => NULL,
		);

		$db1->update('t_datadiri', $data, array('id_datadiri' => $identity));

		$return = $db1->affected_rows() == 1;
		if ($return)
		{
			$this->session->set_flashdata('message','Password Change'.$identity);
		}
		else
		{
			$this->session->set_flashdata('message','Failed to Update password'.$identity);
		}

		return $return;
	}

	public function identity_check($identity = '')
	{
		if (empty($identity))
		{
			return FALSE;
		}

		$db1 = $this->load->database('simdiklat', TRUE);
		return $db1->where('id_datadiri', $identity)
		                ->count_all_results('t_datadiri') > 0;
	}
}
