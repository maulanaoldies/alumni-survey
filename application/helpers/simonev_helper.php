<?php defined('BASEPATH') OR exit('No direct script access allowed');

	function tgl_indo($tgl)
	{
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}

	function tglindo($tgl)
	{
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);

    return $tanggal.' '.$bulan.' '.$tahun;
	}

	function bulan_indo()
	{
		return array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);
	}

	function tglinggris($tgl)
	{
	    $tgli = substr($tgl, 0,2);
	    $blni = substr($tgl, 3,2);
	    $thni = substr($tgl, 6,4);

	    return $thni."-".$blni."-".$tgli;
	}

	function tglenglish ($tgl)
	{
		$pecahlhr = explode("-", $tgl);
		return $pecahlhr[2].'-'.$pecahlhr[1].'-'.$pecahlhr[0];
	}

	function tgl_jam($tgl)
	{
		$ex = explode(' ',$tgl);
		$jam = explode(':',$ex[1]);
		return tgl_indo($ex[0]).' - '.$jam[0].':'.$jam[1];
	}

	function getBulan($bln)
	{
		switch ($bln){
			case 1:
				return "Januari";
			break;
			case 2:
				return "Februari";
			break;
			case 3:
				return "Maret";
			break;
			case 4:
				return "April";
			break;
			case 5:
				return "Mei";
			break;
			case 6:
				return "Juni";
			break;
			case 7:
				return "Juli";
			break;
			case 8:
				return "Agustus";
			break;
			case 9:
				return "September";
			break;
			case 10:
				return "Oktober";
			break;
			case 11:
				return "November";
			break;
			case 12:
				return "Desember";
			break;
		}
	}

	function createDirectory($path,$include_filename=false){
		$dir = explode('/',$path);  // Array direktori
		$total = (int) count($dir);  // Total array

		if($include_filename == true){
			unset($dir[($total - 1)]);  // Unset array terakhir (filename)
		}

		$cur_dir = '';
		foreach($dir as $key){   // Membuat direktori
			if(!is_dir($cur_dir.$key)){
				mkdir($cur_dir.$key,'777');
			}
			$cur_dir .= $key.'/';
		}
	}

	function readmore($text)
	{
		$read = array();
		$read = explode(" ",$text, 21);
		if(count($read) == 21){
			$read[20] = ' ...';
		}

		return implode(" ",$read);
	}

	function rupiah($rp)
	{
		$duit = number_format($rp, 2, ',', '.');
		return $duit;
	}
