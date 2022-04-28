<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function array_to_point($arr)
{
	$opt = array();
	foreach($arr as $tgt):
		$angka = (int) $tgt['target'];
		$opt[$angka] = $tgt['jumlah'];
	endforeach;
	return $opt;
}

function array_to_comma($arr)
{
	$comma = '';
	foreach($arr as $tgt=>$val):
		$angka = (int) $val;
		$comma .= $angka.',';
	endforeach;
	return substr($comma, 0, strlen($comma)-1 );
}

function base_point($time_mode)
{
	$arr = array();
	switch ($time_mode) {
		case 'date':
			// $arr[$this->input->post('date_date_cd')] = '0';
			for ($i=0; $i <= 23; $i++) {
				$arr[$i] = '0';
			}
		break;

		case 'month':
			for ($i=1; $i < 32; $i++) {
				$arr[$i] = '0';
			}
		break;

		case 'year':
			for ($i=1; $i < 13; $i++) {
				$arr[$i] = '0';
			}
		break;
	}

	return $arr;
}

function combine($base, $val)
{
	$final = array();
	foreach ($base as $key => $value) {
		$new_val = (isset($val[$key])) ? $val[$key] : $value;
		$final[$key] = $new_val;
	}
	return $final;


}
