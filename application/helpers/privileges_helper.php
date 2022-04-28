<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function modul_full_access($modul_code='')
{
	$CI =& get_instance();

	$full = $CI->is_valid_token ? $CI->tokenArray['sub']['modul_access'] : $CI->session->userdata('modul_access');
	// print_r($tokenArray);exit();

	if(is_admin() || is_admin_regional()):
		return true;
	else:
		if(in_array($modul_code, $full['full_access'])):
			return true;
		else:
			return false;
		endif;
	endif;
}

function modul_full_view($modul_code='')
{
	$CI =& get_instance();

	$full = $CI->is_valid_token ? $CI->tokenArray['sub']['modul_access'] : $CI->session->userdata('modul_access');
	if(is_admin() || is_admin_regional()):
		return true;
	else:
		if(in_array($modul_code, $full['full_view'])):
			return true;
		else:
			return false;
		endif;
	endif;
}

// function info_gak_boleh($modul_code, $msg="Anda tidak memiliki hak akses")
// {
// 	$CI =& get_instance();
//
// 	$boleh = allow_modul($modul_code);
// 	if( !$boleh ):
// 		$html = '<div class="alert alert-danger alert-styled-left alert-bordered">';
// 		$html .= $msg;
// 		$html .= '</div>';
// 		echo $html;
// 	endif;
// }

// function gak_boleh($modul_code, $msg="Anda tidak memiliki hak akses")
// {
// 	$boleh = allow_modul($modul_code);
// 	if(!$boleh):
// 		$arr_msg = array();
// 		$arr_msg['status'] = 'gagal';
// 		$arr_msg['msg'] = $msg;
// 		$response = json_encode($arr_msg);
// 		echo $response;
// 		exit();
// 	endif;
// }

function is_admin()
{
	$CI =& get_instance();

	if(my_level()=='su'):
		return TRUE;
	else:
		return FALSE;
	endif;
}

function is_admin_regional()
{
	$CI =& get_instance();

	if(my_level()=='sr'):
		return TRUE;
	else:
		return FALSE;
	endif;
}

// function allow_element($modul_code)
// {
// 	$CI =& get_instance();
// 	if(is_admin()):
// 		return TRUE;
// 	else:
// 		$CI->db->where('modul', $modul_code);
// 		$CI->db->where('user_group_id', my_level());
// 		$query = $CI->db->get('privileges');
// 		$privileges = $query->row_array();
//
// 		if(!empty($privileges)):
// 			return TRUE;
// 		else:
// 			return FALSE;
// 		endif;
// 	endif;
// }


//ini  masih dipakai maul
function allow_modul($modul_code)
{
	$CI =& get_instance();

	if(is_admin()):
		return TRUE;
	else:
		$query = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_level()."' AND modul='".$modul_code."' ");
		$privileges = $query->row_array();

		if(!empty($privileges)):
			return TRUE;
		else:
			return FALSE;
		endif;
	endif;
}

// function allow_modul_oldx($modul_code)
// {
// 	$CI =& get_instance();
//
// 	if(is_admin() || is_admin_regional()):
// 		return TRUE;
// 	else:
//
//
//
// 		$query = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_level()."' AND modul='".$modul_code."' ");
// 		$privileges = $query->row_array();
//
// 		if(!empty($privileges)):
// 			return TRUE;
// 		else:
// 			return FALSE;
// 		endif;
// 	endif;
// }

function valid_action($modul_code)
{
	$CI =& get_instance();
	if(is_admin() || is_admin_regional()):
		return TRUE;
	else:
		$lock = 'yes';

		$sb_sub_department = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_sub_department()."' AND modul='".$modul_code."' ")->result_array();
		if(empty($sb_sub_department)):
			$sb_department = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_department()."' AND modul='".$modul_code."' ")->result_array();
			if(empty($sb_department)):
				$sb_divisi = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_divisi()."' AND modul='".$modul_code."' ")->result_array();
				if(empty($sb_divisi)):
					$sb_jabatan = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_jabatan()."' AND modul='".$modul_code."' ")->result_array();
					if(empty($sb_jabatan)):
						$lock = 'yes';
					else:
						$lock = 'no';
					endif;
				else:
					$lock = 'no';
				endif;
			else:
				$lock = 'no';
			endif;
		else:
			$lock = 'no';
		endif;

		if($lock=='yes'):
			flash('message', 'Anda tidak memiliki hak askes tindakan ini');
			redirect(base_url().'eject');
			exit();
		else:
			return true;
		endif;

	endif;
}

//Privileges gate  for ajax
function have_access($modul_code)
{
	$CI =& get_instance();
	if(is_admin() || is_admin_regional()):
		return TRUE;
	else:
		// $CI->db->where('modul', $modul_code);
		// $CI->db->where('user_group_id', my_level());
		$query = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_level()."' AND modul='".$modul_code."' ");
		$privileges = $query->row_array();
		// pre($CI->db->last_query());
		// exit;
		if(empty($privileges)):
			return FALSE;
		else:
			return TRUE;
		endif;
	endif;
}

//redirect helper
function set_access_redirect($status=TRUE)
{
	$CI =& get_instance();
	$array = array(
		'access_redirect' => $status
	);
	$CI->session->set_userdata( $array );
}

function get_access_redirect()
{
	$CI =& get_instance();
	$status = FALSE;
	if (!empty($CI->session->userdata('access_redirect'))) {
		$status = $CI->session->userdata('access_redirect');
	}
	return $status;
}

// function super_user_only()
// {
// 	$CI =& get_instance();
// 	if(is_admin()):
// 		return TRUE;
// 	else:
// 		flash('message', 'Anda tidak memiliki hak askes tindakan ini');
// 		redirect(base_url().'eject');
// 		exit();
// 	endif;
// }

// function my_own_data($data_user_id='', $modul='')
// {
// 	if($data_user_id=='')
// 	{
// 		return TRUE;
// 	}
//
// 	if(my_id()==$data_user_id || my_level()==ADMIN_CODE || my_level()==ROOT_CODE){
// 		return TRUE;
// 	} else {
// 		flash('message', 'Anda tidak memiliki hak askes tindakan ini');
// 		redirect(base_admin().'eject');
// 		exit();
// 	}
// }

// function other_data($modul_code)
// {
// 	$CI =& get_instance();
// 	if(is_admin()):
// 		return TRUE;
// 	else:
// 		$query = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_level()."' AND modul='".$modul_code."' ");
// 		$privileges = $query->row_array();
//
// 		if(!empty($privileges)):
// 			return TRUE;
// 		else:
// 			return FALSE;
// 		endif;
// 	endif;
// }

//TRUE JIKA PUNYA AKSES
function have_privileges($modul_code)
{
	$CI =& get_instance();
	if(is_admin() || is_admin_regional()):
		return TRUE;
	else:
		$lock = 'yes';

		$sb_sub_department = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_sub_department()."' AND modul='".$modul_code."' ")->result_array();
		if(empty($sb_sub_department)):
			$sb_department = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_department()."' AND modul='".$modul_code."' ")->result_array();
			if(empty($sb_department)):
				$sb_divisi = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_divisi()."' AND modul='".$modul_code."' ")->result_array();
				if(empty($sb_divisi)):
					$sb_jabatan = $CI->db->query("SELECT * FROM {PRE}privileges WHERE user_group_id='".my_jabatan()."' AND modul='".$modul_code."' ")->result_array();
					if(empty($sb_jabatan)):
						$lock = 'yes';
					else:
						$lock = 'no';
					endif;
				else:
					$lock = 'no';
				endif;
			else:
				$lock = 'no';
			endif;
		else:
			$lock = 'no';
		endif;

		if($lock=='yes'):
			return false;
		else:
			return true;
		endif;

	endif;
}
