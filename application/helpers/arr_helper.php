<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('my_test')){
	/**
	 * fungsi debug data return
	 * @param array $data
	 */
	function my_test($data=array())
	{
		echo "<pre>";
		var_dump($data);
		exit();
	}
}

function simple_arr($source, $val)
{
	$arr = array();
	if(!empty($source)):
		foreach($source as $row):
			$arr[] = $row[$val];
		endforeach;
	endif;
	return $arr;
}
if(!function_exists('CII')){
	function CII () {
		return $CI =& get_instance();
	}
}

if(!function_exists('my_json')){
	function my_json ($data,$status=200) {
	
		CII()->output
		->set_status_header($status)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($data, JSON_PRETTY_PRINT))
		->_display();
		exit;
	}
}
function arr_to_query($arr)
{
	$CI =& get_instance();
	switch ($arr[1]) {
		case '=':
			$CI->db->where($arr[0], $arr[2]);
		break;

		case '!=':
			$CI->db->where($arr[0].' !=', $arr[2]);
		break;

		default:
		break;
	};
}

function arr($source, $key, $val)
{
	$arr = array();
	if(!empty($source)):
		foreach($source as $row):
			$arr[$row[$key]] = $row[$val];
		endforeach;
	endif;
	return $arr;
}

function arr_to_comma($arr=array())
{
	$comma = '';
	if(!empty($arr)):
		foreach($arr as $row):
			$comma .= "'".$row."', ";
		endforeach;
	endif;
	$comma = substr($comma, 0, strlen($comma)-2);
	return $comma;
}

function arr_string_to_int($data,$int_arr=array())
{
	$i = 0;
	$arr = array();
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			if (in_array($key, $int_arr)) {
				$arr[$i][$key] = intval($value);
			} else {
				$arr[$i][$key] = $value;
			}
		}
		$i++;
	}
	return $arr;
}
