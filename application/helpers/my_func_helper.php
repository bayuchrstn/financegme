<?php

if (!function_exists('kata_terbilang')) {
	function kata_terbilang($x)
	{
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = kata_terbilang($x - 10). " belas";
		} else if ($x <100) {
			$temp = kata_terbilang($x/10)." puluh". kata_terbilang($x % 10);
		} else if ($x <200) {
			$temp = " seratus" . kata_terbilang($x - 100);
		} else if ($x <1000) {
			$temp = kata_terbilang($x/100) . " ratus" . kata_terbilang($x % 100);
		} else if ($x <2000) {
			$temp = " seribu" . kata_terbilang($x - 1000);
		} else if ($x <1000000) {
			$temp = kata_terbilang($x/1000) . " ribu" . kata_terbilang($x % 1000);
		} else if ($x <1000000000) {
			$temp = kata_terbilang($x/1000000) . " juta" . kata_terbilang($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = kata_terbilang($x/1000000000) . " milyar" . kata_terbilang(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = kata_terbilang($x/1000000000000) . " trilyun" . kata_terbilang(fmod($x,1000000000000));
		}      
		return $temp;
	}
}

if (!function_exists('terbilang')) {
	function terbilang($x, $style=4)
	{
		if($x<0) {
			$hasil = "minus ". trim(kata_terbilang($x));
		} else {
			$hasil = trim(kata_terbilang($x));
		}      
		switch ($style) {
			case 1:
			$hasil = strtoupper($hasil);
			break;
			case 2:
			$hasil = strtolower($hasil);
			break;
			case 3:
			$hasil = ucwords($hasil);
			break;
			default:
			$hasil = ucfirst($hasil);
			break;
		}      
		return $hasil;
	}
}

if (!function_exists('tanggal_indo')) {
	function tanggal_indo($datawaktu)
	{
		$waktu = explode('-',$datawaktu);
		switch($waktu[1])
		{
			case "01":	$bulan = "Januari";    break;
			case "02":  $bulan = "Februari";   break;
			case "03":	$bulan = "Maret";     break;
			case "04":	$bulan = "April";     break;
			case "05":	$bulan = "Mei";       break;
			case "06":	$bulan = "Juni";      break;
			case "07":	$bulan = "Juli";      break;
			case "08":	$bulan = "Agustus";    break;
			case "09":	$bulan = "September"; break;
			case "10":	$bulan = "Oktober";   break;
			case "11":  $bulan = "November";  break;
			case "12":  $bulan = "Desember";  break;
			default:	$bulan = "Unknown";   break;
		}
		
		return $waktu[0]." ".$bulan." ".$waktu[2];
	}
}

if (!function_exists('tanggal_indo_ymd')) {
	function tanggal_indo_ymd($datawaktu)
	{
		$waktu = explode('-',$datawaktu);
		switch($waktu[1])
		{
			case "01":	$bulan = "Januari";    break;
			case "02":  $bulan = "Februari";   break;
			case "03":	$bulan = "Maret";     break;
			case "04":	$bulan = "April";     break;
			case "05":	$bulan = "Mei";       break;
			case "06":	$bulan = "Juni";      break;
			case "07":	$bulan = "Juli";      break;
			case "08":	$bulan = "Agustus";    break;
			case "09":	$bulan = "September"; break;
			case "10":	$bulan = "Oktober";   break;
			case "11":  $bulan = "November";  break;
			case "12":  $bulan = "Desember";  break;
			default:	$bulan = "Unknown";   break;
		}
		
		return $waktu[2]." ".$bulan." ".$waktu[0];
	}
}

if (!function_exists('hari_bulan_indo')) {
	function hari_bulan_indo($datawaktu)
	{
		$waktu = explode('-',$datawaktu);
		switch($waktu[2])
		{
			case "01":	$bulan = "Jan";    break;
			case "02":  $bulan = "Feb";   break;
			case "03":	$bulan = "Mar";     break;
			case "04":	$bulan = "Apr";     break;
			case "05":	$bulan = "Mei";       break;
			case "06":	$bulan = "Jun";      break;
			case "07":	$bulan = "Jul";      break;
			case "08":	$bulan = "Agu";    break;
			case "09":	$bulan = "Sep"; break;
			case "10":	$bulan = "Okt";   break;
			case "11":  $bulan = "Nov";  break;
			case "12":  $bulan = "Des";  break;
			default:	$bulan = "Unknown";   break;
		}
		
		switch($waktu[0])
		{
			case "0":	$hari = "Minggu";    break;
			case "1":	$hari = "Senin";    break;
			case "2":  	$hari = "Selasa";   break;
			case "3":	$hari = "Rabu";     break;
			case "4":	$hari = "Kamis";     break;
			case "5":	$hari = "Jum'at";       break;
			case "6":	$hari = "Sabtu";      break;
			default:	$hari = "Unknown";   break;
		}
		
		return $hari.", ".$waktu[1]." ".$bulan." ".$waktu[3];
	}
}

if (!function_exists('tanggal_indo_ymd_singkat')) {
	function tanggal_indo_ymd_singkat($datawaktu)
	{
		$waktu = explode('-',$datawaktu);
		switch($waktu[1])
		{
			case "01":	$bulan = "Jan"; break;
			case "02":  $bulan = "Feb"; break;
			case "03":	$bulan = "Mar"; break;
			case "04":	$bulan = "Apr"; break;
			case "05":	$bulan = "Mei"; break;
			case "06":	$bulan = "Jun"; break;
			case "07":	$bulan = "Jul"; break;
			case "08":	$bulan = "Agu"; break;
			case "09":	$bulan = "Sep"; break;
			case "10":	$bulan = "Okt"; break;
			case "11":  $bulan = "Nov"; break;
			case "12":  $bulan = "Des"; break;
			default:	$bulan = "Unknown"; break;
		}
		
		return $waktu[2]."-".$bulan."-".$waktu[0];
	}
}

if (!function_exists('bulan_indo')) {
	function bulan_indo($val)
	{
		switch($val)
		{
			case "01":	$bulan = "Januari";    break;
			case "02":  $bulan = "Februari";   break;
			case "03":	$bulan = "Maret";     break;
			case "04":	$bulan = "April";     break;
			case "05":	$bulan = "Mei";       break;
			case "06":	$bulan = "Juni";      break;
			case "07":	$bulan = "Juli";      break;
			case "08":	$bulan = "Agustus";    break;
			case "09":	$bulan = "September"; break;
			case "10":	$bulan = "Oktober";   break;
			case "11":  $bulan = "November";  break;
			case "12":  $bulan = "Desember";  break;
			default:	$bulan = "Unknown";   break;
		}
		
		return $bulan;
	}
}

if (!function_exists('bulan_indo_singkat')) {
	function bulan_indo_singkat($val)
	{
		switch($val)
		{
			case "01":	$bulan = "Jan"; break;
			case "02":  $bulan = "Feb"; break;
			case "03":	$bulan = "Mar"; break;
			case "04":	$bulan = "Apr"; break;
			case "05":	$bulan = "Mei"; break;
			case "06":	$bulan = "Jun"; break;
			case "07":	$bulan = "Jul"; break;
			case "08":	$bulan = "Agu"; break;
			case "09":	$bulan = "Sep"; break;
			case "10":	$bulan = "Okt"; break;
			case "11":  $bulan = "Nov"; break;
			case "12":  $bulan = "Des"; break;
			default:	$bulan = "Unknown";   break;
		}
		
		return $bulan;
	}
}

if (!function_exists('hari_indo')) {
	function hari_indo($val)
	{
		switch($val)
		{
			case "0":	$hari = "Minggu";    break;
			case "1":	$hari = "Senin";    break;
			case "2":  	$hari = "Selasa";   break;
			case "3":	$hari = "Rabu";     break;
			case "4":	$hari = "Kamis";     break;
			case "5":	$hari = "Jum'at"; break;
			case "6":	$hari = "Sabtu";      break;
			default:	$hari = "Unknown";   break;
		}
		
		return $hari;
	}
}

if (!function_exists('hari_indo_singkat')) {
	function hari_indo_singkat($val)
	{
		switch($val)
		{
			case "0":	$hari = "Min";    break;
			case "1":	$hari = "Sen";    break;
			case "2":  	$hari = "Sel";   break;
			case "3":	$hari = "Rab";     break;
			case "4":	$hari = "Kam";     break;
			case "5":	$hari = "Jum";       break;
			case "6":	$hari = "Sab";      break;
			default:	$hari = "Unk";   break;
		}
		
		return $hari;
	}
}

if (!function_exists('leading_zeros')) {
	function leading_zeros($num,$numDigits)
	{
		return sprintf("%0".$numDigits."d",$num);
	}
}

if (!function_exists('replace_string')) {
	function replace_string()
	{
		return array(" ", "+", ",");
	}
}

if (!function_exists('date_swap')) {
	function date_swap($datawaktu)
	{
		$waktu = explode('-',$datawaktu);
		return $waktu[2]."-".$waktu[1]."-".$waktu[0];
	}
}

if (!function_exists('secondsToTime')) {
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		//return $dtF->diff($dtT)->format('%a Hari %h Jam %i Menit %s Detik');
		$hasil = '';
		$hasil .= ($dtF->diff($dtT)->format('%a') != '0')?' '.$dtF->diff($dtT)->format('%a').' Hari':'';
		$hasil .= ($dtF->diff($dtT)->format('%H') != '0')?' '.$dtF->diff($dtT)->format('%H').' Jam':'';
		$hasil .= ($dtF->diff($dtT)->format('%i') != '0')?' '.$dtF->diff($dtT)->format('%i').' Menit':'';
		$hasil .= ($dtF->diff($dtT)->format('%s') != '0')?' '.$dtF->diff($dtT)->format('%s').' Detik':'';
		return $hasil;
	}
}

?>