<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function session_scope()
{
	$CI =& get_instance();
	$all_sessions = $CI->all_session;
	return $all_sessions['view_scope'];
}

function session_scope_regional()
{
	$CI =& get_instance();

	$all_sessions = $CI->all_session;
	return $all_sessions['scope_regional'];
}

function session_scope_regional_name()
{
	$CI =& get_instance();
	$all_sessions = $CI->all_session;
	return $all_sessions['scope_regional_name'];
}


//area

function session_scope_area()
{
	$CI =& get_instance();

	$all_sessions = $CI->all_session;
	return $all_sessions['scope_area'];
}

function session_scope_area_name()
{
	$CI =& get_instance();
	$all_sessions = $CI->all_session;
	return $all_sessions['scope_area_name'];
}

//time zone

function session_timezone()
{
	$CI =& get_instance();
	$all_sessions = $CI->all_session;
	return $all_sessions['timezone'];
}

function session_view_scope()
{
	$CI =& get_instance();
	$all_sessions = $CI->all_session;
	return $all_sessions['view_scope'];
}

function basic_auth_login()
{
	$CI =& get_instance();
	if ($CI->session->userdata('logged_in') != "ok" && $CI->input->server('PHP_AUTH_USER') && $CI->input->server('PHP_AUTH_PW')):
		$password = $CI->input->server('PHP_AUTH_PW');
		// $salt = sha1(md5($password).SALT);
		// $password = md5($password.$salt);
		$CI->db->where('username', $CI->input->server('PHP_AUTH_USER'))
			->where('password', $password);
		$CI->db->where('status', 'active');
		$query = $CI->db->get('users');
		$data = $query->row_array();

		if(isset($data) && !empty($data))
		{
			$dt = array(
					'username'  		=> $data['username'],
					'nama'  			=> $data['name'],
					'userid'  			=> $data['id'],
					'level'  			=> $data['level'],
					'divisi'  			=> $data['divisi'],
					'department'  		=> $data['department'],
					'sub_department'  	=> $data['sub_department'],
					'jabatan'  			=> $data['jabatan'],
					'view_scope'  		=> $data['view_scope'],
					'regional'  		=> $data['regional'],
					'scope_regional'	=> $data['regional'],
					'area'  			=> $data['area'],
					'scope_area'  		=> $data['area'],
					'logged_in'  		=> "ok"
				);
			// pre($dt); exit;

			$CI->session->set_userdata($dt);
		} else {
			$arr = array(
				'err'	=> 403,
				'message'	=> 'login failed'
			);
			echo json_encode($arr);
			exit();
		}
	endif;
}

function getBearerToken()
{
	// bearer sample
	$headers = null;
	$bearer = '';
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
    	$headers = trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            $bearer = $matches[1];
        }
    }	
    return $bearer;
}