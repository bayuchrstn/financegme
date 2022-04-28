<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function replace_this($source, $tg, $nw)
{
	$result = str_replace($tg, $nw, $source);
	return($result);
}

function rgb_color_code($human_color='', $trans='1')
{
	switch ($human_color) {
		case 'red':
			$code = 'rgba(255, 51, 51, 1)';
		break;

		case 'green':
			$code = 'rgba(0, 153, 0, 1)';
		break;

		case 'blue':
			$code = 'rgba(140, 176, 234, '.$trans.')';
		break;

		default:
			$code = 'rgba(255, 51, 51, 1)';
		break;
	}
	return $code;
}

function nik_join()
{
	$CI =& get_instance();
	$nik_satu = $CI->input->post('nik_satu');
	$nik_dua = $CI->input->post('nik_dua');
	$nik_tiga = $CI->input->post('nik_tiga');
	$nik_empat = $CI->input->post('nik_empat');

	$final = $nik_satu.'-'.$nik_dua.'.'.$nik_tiga.'-'.$nik_empat;
	return $final;
}

function pass_generator($input)
{
	$password = $input;
	$salt = sha1(md5($password).SALT);
	$password = md5($password.$salt);
	return $password;
}

function ago($date, $unit='1')
{
	$CI =& get_instance();
	$unix_time = strtotime($date);
	return timespan($unix_time, time(), $unit) . ' Ago' ;
}

function kode_karyawan($nama, $regional='1')
{
	$tiga_digit_nama = $regional.substr(strtolower($nama), 0, 3).uniqid();
	return $tiga_digit_nama;
}

function code_generator()
{
	$string = '';
	// You can define your own characters here.
	$characters = "QWERTYUIOPLKJHGFDSAZXCVBNM";

   	for ($p = 0; $p < 5; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   	}
	$code = $string.time();
	return $code;
}

function info_stop_here($msg="Anda tidak memiliki hak akses")
{
	$CI =& get_instance();
	$html = '<div class="alert alert-danger alert-styled-left alert-bordered">';
	$html .= $msg;
	$html .= '</div>';
	echo $html;
}

function stop_here($msg="Anda tidak memiliki hak akses")
{
	$arr_msg = array();
	$arr_msg['status'] = 'failed';
	$arr_msg['msg'] = $msg;
	$response = json_encode($arr_msg);
	echo $response;
	exit();
}

function get_setting($setting_name)
{
	$CI =& get_instance();
	$CI->db->where('setting',$setting_name);
	$qry = $CI->db->get('setting');
	$dt = $qry->row_array();
	// pre($CI->db->last_query());
	if(!empty($dt)):
		return $dt['value'];
	else:
		return '';
	endif;
}

function get_all_setting()
{
	$CI =& get_instance();
	$qry = $CI->db->get('setting');
	$dt = $qry->result_array();
	// pre($CI->db->last_query());
	$arr = array();
	if(!empty($dt)):
		foreach($dt as $row):
			$arr[$row['setting']] = $row['value'];
		endforeach;
	endif;
	return $arr;
}



function coro()
{
	$CI =& get_instance();
	$CI->output->enable_profiler(TRUE);
}

function upload_to_serialize($arr_file_name)
{
	$res = array();
	foreach($arr_file_name as $row):
		$res[$row] = array(
			'file_name' => $row,
			'real_path' => FILE_PATH_ATTACHMENT.$row,
			'url' 		=> URL_ATTACHMENT.$row
		);
	endforeach;
	return serialthis($res);
}

function clean_string($source, $limiter='')
{
	$opt = strip_tags($source);
	if($limiter ==''):
		$batas = '50';
	else:
		$batas = $limiter;
	endif;
	$opt = ellipsize($source, $batas, 1);
	return $opt;
}

function flash($name, $value, $type='alert-success')
{
	$CI =& get_instance();
	$val = array(
			'type' 	=> $type,
			'value'	=> $value
		);
	$CI->session->set_flashdata($name, $val);
}

function str_to_code($str='')
{
	$code = strtolower(url_title($str));
	$code = str_replace('-', '_', $code);
	return $code;
}

function ajax_only()
{
	$CI =& get_instance();

	if(!$CI->input->is_ajax_request()){
		exit('...');
	}
}

function arr_for_dropdown($source, $key, $label)
{
	$arr = array();
	if(!empty($source)):
		foreach($source as $row):
			$arr[$row[$key]] = $row[$label];
		endforeach;
	endif;
	return $arr;
}

function my($obj='id')
{
	$CI =& get_instance();
	$data =  $CI->ion_auth->user()->row();
	return $data->$obj;
}

function show_flash($name='message')
{
	$CI =& get_instance();
	if($CI->session->flashdata($name)):
		$val = $CI->session->flashdata($name);
		$data['msg'] = $val['value'];
		$data['type'] = $val['type'];
		return $CI->load->view('/flat/flash', $data, TRUE);
	else:
		return FALSE;
	endif;
}

function menit_ke_jam($minutes)
{
	$d = floor ($minutes / 1440);
	$h = floor (($minutes - $d * 1440) / 60);
	$m = $minutes - ($d * 1440) - ($h * 60);
	$m = floor($m);

	$hari = ($d !='') ? $d.' Hari' : '';
	$jam = ($h !='') ? $h.' Jam' : '';
	$menit = ($m !='') ? $m.' Menit' : '';

	return $hari.' '.$jam.' '.$menit;
}

function check_login()
{
	$CI =& get_instance();
	$token = getBearerToken();

	if ($token!='') {
		if (jwt_helper::validate($token)) {
			return true;
		} else {
			$token = jwt_helper::refresh($token);
			if (!$token) {
				$arr = array(
					'status'	=> 401,
					'message'	=> 'invalid login'
				);
			} else {
				$arr = array(
					'status'	=> 406,
					'message'	=> 'expired token',
					'token'	=> $token
				);
			}
			echo json_encode($arr); exit();
		}
	} elseif ($CI->session->userdata('logged_in') != "ok"){
		redirect('login'); exit();
	}
}

function pre($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function subzero($numb, $digit){
	return sprintf('%0'.$digit.'d', $numb);
}


function currency($angka='0', $matauang='rupiah')
{
	switch($matauang){
		case 'dolar':
			$opt = '$ '.$angka;
		break;

		default:
			$opt = 'Rp '.number_format($angka, '0', '', '.');
	}
	return $opt;
}

function upload_with_tumb($file='file', $path="", $nwidth=115, $nheight=115) {
	if(!empty($_FILES[$file]['name']) && $_FILES[$file]['name'] !=''){
	$CI =& get_instance();
	//$config['encrypt_name']  = true;
	$config['upload_path'] 	 = $path;
	$config['allowed_types'] = 'jpg|png|gif|jpeg';

	$CI->load->library('upload', $config);
	if ($CI->upload->do_upload($file)) {
		$gambar = $CI->upload->data();
		$newwidth = $nwidth;
		$newheight = $nheight;

		list($width, $height) = getimagesize($path . "/" . $gambar['file_name']);

		if ($width == $height) {
			$newwidth = $newwidth;
			$newheight = $newwidth;
		} else if($width > $height && $newheight < $height){
			$newheight = $height / ($width / $newwidth);
		} else if ($width < $height && $newwidth < $width) {
			$newwidth = $width / ($height / $newheight);
		} else {
			$newwidth  = $width;
			$newheight = $height;
		}

		$gambar['thumb']	=  $gambar['raw_name'] . $gambar['file_ext'];
		$srz_img=(!empty($_FILES[$file]['name']))? serialize($gambar) : "";
		//$srz_img=(!empty($_FILES[$file]['name']))? $gambar : "";

		$configx['image_library'] = 'gd2';
		$configx['source_image'] = $gambar['full_path'];
		$configx['create_thumb'] = TRUE;
		$configx['maintain_ratio'] = FALSE;
		$configx['width'] = $newwidth;
		$configx['height'] = $newheight;
		$configx['thumb_marker'] = '';
		$configx['new_image']    = $path."thumb";

		$CI->load->library('image_lib', $configx);
		$CI->image_lib->resize();

		return $srz_img;
	} else {
		echo $CI->upload->display_errors('<p>', '</p>');
		return false;
	}
	}
}

function delete_old_file($file='')
{
	$file = unserialize($file);
	$pic = $file['file_path'].$file['file_name'];
	if (file_exists($pic)):
		unlink($pic);
	endif;

	$pic_thumb = $file['file_path']."thumb/".$file['file_name'];
	if (file_exists($pic_thumb)):
		unlink($pic_thumb);
	endif;
}

function upload($file='file', $path="") {
	if(!empty($_FILES[$file]['name']) && $_FILES[$file]['name'] !=''){
		$CI =& get_instance();
		$config['upload_path'] 	 = $path;
		$config['allowed_types'] = 'jpg|png|gif|jpeg';

		$CI->load->library('upload', $config);
		if ($CI->upload->do_upload($file)) {
			$upfile = $CI->upload->data();
			$srz_img = serialize($upfile);
			return $srz_img;
		} else {
			echo $CI->upload->display_errors('<p>', '</p>'); exit;
		}
	} else {
		return FALSE;
	}
}

function multiple_upload($form_name, $folder_target='', $allowed_file = '', $current_file)
{
    $CI =& get_instance();
	$CI->load->library('image_lib');


	if($folder_target != ''){
		$config['upload_path'] = './'.$folder_target;
	} else {
		$config['upload_path'] = './upload/';
	}

	if($allowed_file != ''){
		$config['allowed_types'] = $allowed_file;
	} else {
		$config['allowed_types'] = 'gif|jpg|png';
	}

	$CI->load->library('upload', $config);

	foreach($_FILES[$form_name] as $key=>$val)
    {
    	$i = 1;
        foreach($val as $v)
        {
        	$field_name = "file_".$i;
            $_FILES[$field_name][$key] = $v;
            $i++;
		}
   	}

	unset($_FILES[$form_name]);

	$error = array();
    $success = array();

	foreach($_FILES as $field_name => $file)
    {
    	if ($CI->upload->do_upload($field_name))
        {
        	$hasil_upload = $CI->upload->data();
        	// pre($hasil_upload);
        	/* membuat thumbnail dan ideal image */
			$resize = ideal_and_thumbnail($folder_target.'/', $hasil_upload);
			if($resize){
				$hasil_upload['via_email'] = $hasil_upload['file_path'].'pic/'.$hasil_upload['file_name'];
			}

        	$success[] = $hasil_upload;
        }
    }

    // pre($success);

	if(!empty($current_file)){
		$success = array_merge($success, $current_file);
	}

	$srz_img = serialize($success);
	return $srz_img;
}

function replace_name_file($text='') {
	$find = strripos($text, '.');
	$hasil1 = substr($text, 0,$find);
	$rplc1 = preg_replace('/[^a-zA-Z0-9]/','_', $hasil1);
	$rplc2 = preg_replace('/_+/', '_', $rplc1);

	if (strlen($rplc2)>10) {
		$rplc2 = substr($rplc2, 0,10);

		if (strlen($rplc2)==strripos($rplc2,'_')+1) {
			$rplc2 = substr($rplc2, 0,strripos($rplc2,'_'));
		}
	}

	$hasil2 = substr($text, $find);
	$hasil_rplc = $rplc2.$hasil2;

	return $hasil_rplc;
}

function upload_file($name='', $path='') {
	$CI =& get_instance();

	$arr = array();
	$get_nama = replace_name_file($_FILES[$name]['name']);

	// $new_name = date('Ymd').enkripsi($get_nama);
	$new_name = date('Ymd').$get_nama;

	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
	$config['file_name'] = $new_name;
	$config['max_size']  = 0;
	$config['max_width']  = 0;
	$config['max_height']  = 0;

	$CI->load->library('upload', $config);

	// print_r($_FILES);

	if ($CI->upload->do_upload($name)) {
		$data = array('upload_data' => $CI->upload->data());
		// $file_name = $CI->upload->data('file_name');
		$file_name = $data['upload_data']['file_name'];
		$arr = array(
		'error'  => false,
		'file_name' => $file_name
		);
		// return $file_name;
	} else {
		$arr = array('error' => $CI->upload->display_errors());
		// return false;
	}
	// $arr['error'] = json_encode($_FILES);
	return $arr;
}

function ideal_and_thumbnail($path, $uploaded){

	$CI =& get_instance();
	$gambar = $uploaded;
	// pre($gambar);

	/* ideal */
	$newwidth = ($gambar['image_width'] >= 500) ? 500 : $gambar['image_width'];
	$newheight = ($gambar['image_height'] >= 500) ? 500 : $gambar['image_height'];
	list($width, $height) = getimagesize($path . "/" . $gambar['file_name']);

	if ($width == $height) {
		$newwidth = $newwidth;
		$newheight = $newwidth;
	} else if($width > $height && $newheight < $height){
		$newheight = $height / ($width / $newwidth);
	} else if ($width < $height && $newwidth < $width) {
		$newwidth = $width / ($height / $newheight);
	} else {
		$newwidth  = $width;
		$newheight = $height;
	}

	$cfg['image_library'] = 'gd2';
	$cfg['source_image'] = $gambar['full_path'];
	$cfg['create_thumb'] = FALSE;
	$cfg['maintain_ratio'] = FALSE;
	$cfg['width'] = $newwidth;
	$cfg['height'] = $newheight;
	$cfg['thumb_marker'] = '';
	$cfg['new_image']    = $path.'pic';
	// pre($cfg);

	$CI->image_lib->initialize($cfg);
    $CI->image_lib->resize();
    return true;
}


function getConfig($config)
{
	$CI =& get_instance();
	$CI->db->where('config',$config);
	$qry = $CI->db->get('config');
	$dt = $qry->row_array();
	return $dt['config_value'];
	//pre($dt);
}

function format_date($datetime, $jam='1')
{
	//pre($datetime);
	if($datetime !=''):
		if($datetime=='0000-00-00 00:00:00'):
			return '';
		else:
			$datetime = explode(' ', $datetime);
			$date = $datetime[0];
			$time = (isset($datetime[1])) ? $datetime[1] : '';
			$date = explode('-', $date);
			$jam = ($jam !='') ? substr($time, 0, strlen($time)-3) : '';
			return $date[2].'/'.$date[1].'/'.$date[0].' '.$jam;
		endif;
	else:
		return '';
	endif;
}

function human_datetime($datetime='', $jam='')
{
	//pre($datetime);
	if($datetime !=''):
		if($datetime=='0000-00-00 00:00:00'):
			return '';
		else:
			$datetime = explode(' ', $datetime);

			$date = $datetime[0];
			$time = (isset($datetime[1])) ? $datetime[1] : '';

			$date = explode('-', $date);
			switch($date[1])
			{
				// case '1' :	$bulan = 'Januari'; 	break;
				// case '2' : 	$bulan = 'februari';	break;
				// case '3' :	$bulan = 'Maret';		break;
				// case '4' :	$bulan = 'April';		break;
				// case '5' :	$bulan = 'Mei';			break;
				// case '6' :	$bulan = 'Juni';		break;
				// case '7' :	$bulan = 'Juli';		break;
				// case '8' :	$bulan = 'Agustus';		break;
				// case '9' :	$bulan = 'September';	break;
				// case '10' :	$bulan = 'Oktober';		break;
				// case '11' :	$bulan = 'November';	break;
				// case '12' :	$bulan = 'Desember';	break;
				// default:	$bulan = '';			break;
				case '1' :	$bulan = 'Jan'; 	break;
				case '2' : 	$bulan = 'Feb';		break;
				case '3' :	$bulan = 'Mar';		break;
				case '4' :	$bulan = 'Apr';		break;
				case '5' :	$bulan = 'Mei';		break;
				case '6' :	$bulan = 'Jun';		break;
				case '7' :	$bulan = 'Jul';		break;
				case '8' :	$bulan = 'Ags';		break;
				case '9' :	$bulan = 'Sep';		break;
				case '10' :	$bulan = 'Okt';		break;
				case '11' :	$bulan = 'Nov';		break;
				case '12' :	$bulan = 'Des';		break;
				default:	$bulan = '';		break;
			}
			$jam = ($jam !='') ? $time : '';
			return $date[2].' '.$bulan.' '.$date[0].' '.$jam;
		endif;
	else:
		return '';
	endif;
}

function number_to_month($number)
{
	switch($number)
	{
		case '1' :	$bulan = 'Januari'; 	break;
		case '2' : 	$bulan = 'Februari';	break;
		case '3' :	$bulan = 'Maret';		break;
		case '4' :	$bulan = 'April';		break;
		case '5' :	$bulan = 'Mei';			break;
		case '6' :	$bulan = 'Juni';		break;
		case '7' :	$bulan = 'Juli';		break;
		case '8' :	$bulan = 'Agustus';		break;
		case '9' :	$bulan = 'September';	break;
		case '10' :	$bulan = 'Oktober';		break;
		case '11' :	$bulan = 'November';	break;
		case '12' :	$bulan = 'Desember';	break;
	}
	return $bulan;
}

function split_date($mysql_datetime='2018-01-05 16:27:53')
{
	$arr = array();
	$tx = explode(' ', $mysql_datetime);
	$tanggal = explode('-', $tx[0]);
	$jam = explode(':', $tx[1]);
	$arr['tahun'] = $tanggal[0];
	$arr['bulan'] = $tanggal[1];
	$arr['tanggal'] = $tanggal[2];
	$arr['jam'] = $jam[0];
	$arr['menit'] = $jam[1];
	$arr['detik'] = $jam[2];
	return $arr;
}

function now()
{
	return date('Y-m-d H:i:s');
}

function my_id()
{
	$CI =& get_instance();
	return $CI->whoami['id'];
}

function my_name()
{
	$CI =& get_instance();
	return $CI->whoami['name'];
}

function my_photo()
{
	$CI =& get_instance();
	$ft = $CI->whoami['photo'];

	// return $ft;
	if($ft != ''):
		$ft = unserialize($ft);
		return base_url().'files/medium/'.$ft['file_name'];
	else:
		return base_url().'themes/flat/img/no_photo.gif';
	endif;
}

function my_email()
{
	$CI =& get_instance();
	return $CI->whoami['email'];
}

function my_level()
{
	$CI =& get_instance();
	return $CI->whoami['level'];
}

function my_username()
{
	$CI =& get_instance();
	return $CI->whoami['username'];
}

function my_group()
{
	$CI =& get_instance();
	$group = $CI->ion_auth->get_users_groups()->row();
	return $group->name;
}

function my_regional()
{
	$CI =& get_instance();
	return $CI->whoami['regional'];
}

function my_area()
{
	$CI =& get_instance();
	return $CI->whoami['area'];
}

function my_divisi()
{
	$CI =& get_instance();
	return $CI->whoami['divisi'];
}

function my_department()
{
	$CI =& get_instance();
	return $CI->whoami['department'];
}

function my_sub_department()
{
	$CI =& get_instance();
	return $CI->whoami['sub_department'];
}

function my_jabatan()
{
	$CI =& get_instance();
	return $CI->whoami['jabatan'];
}



function my_last_login()
{
	$CI =& get_instance();
	$CI->db->order_by('id', 'desc');
	$CI->db->where('id_user', my_id());
	$CI->db->where('activity', 'login');
	$query = $CI->db->get('log', 2);
	//pre($CI->db->last_query());
	$dt = $query->result_array();
	return $dt;
}

function my_ip() {
	$ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}


function photo_src()
{
	return base_url().'files/medium/';
}

function no_photo_src()
{
	return base_url().'themes/flat/img/no_photo.gif';
}


function get_bulan_from_angka($angka)
{
	switch($angka)
	{
		case '1' :	$bulan = 'Januari'; 	break;
		case '2' : 	$bulan = 'februari';	break;
		case '3' :	$bulan = 'Maret';		break;
		case '4' :	$bulan = 'April';		break;
		case '5' :	$bulan = 'Mei';			break;
		case '6' :	$bulan = 'Juni';		break;
		case '7' :	$bulan = 'Juli';		break;
		case '8' :	$bulan = 'Agustus';		break;
		case '9' :	$bulan = 'September';	break;
		case '10' :	$bulan = 'Oktober';		break;
		case '11' :	$bulan = 'November';	break;
		case '12' :	$bulan = 'Desember';	break;
	}
	return $bulan;
}

function cekpost(){
	$CI =& get_instance();
	pre($_POST);
	exit;
}

function cekvar($target, $ret='404', $msg=''){
	$CI =& get_instance();
	// pre($_POST);

	if(is_array($target)):
		if(empty($target)):
			if($msg !=''):
				flash('message', $msg);
			endif;

			if($ret=='404'):
				show_404();
			else:
				redirect($ret);
			endif;
		endif;
	else:
		if($target==''):
			if($msg !=''):
				flash('message', $msg);
			endif;

			if($ret=='404'):
				show_404();
			else:
				redirect($ret);
			endif;

		endif;
	endif;
}

function clean_output($output)
{
	$output = htmlentities($output);
	return $output;
}

if ( ! function_exists('paranoid'))
{
	function paranoid($string, $allowed = array()) {
			$allow = null;
			if (!empty($allowed)) {
				foreach ($allowed as $value) {
					$allow .= "\\$value";
				}
			}
			if (is_array($string)) {
				foreach ($string as $key => $clean) {
					$cleaned[$key] = preg_replace("/[^{$allow}0-9]/", "", $clean);
				}
			} else {
				$cleaned = preg_replace("/[^{$allow}0-9]/", "", $string);
			}
			return $cleaned;
		}
}
/**
 * FILTER CUMAN ANGKA DENGAN HURUF SAJA
 *
 */
if ( ! function_exists('clean'))
{
	function clean($string, $allowed = array()) {
				$allow = null;
				if (!empty($allowed)) {
					foreach ($allowed as $value) {
						$allow .= "\\$value";
					}
				}

				if (is_array($string)) {
					foreach ($string as $key => $clean) {
						$cleaned[$key] = preg_replace("/[^{$allow}a-zA-Z0-9]/", "", $clean);
					}
				} else {
					$cleaned = preg_replace("/[^{$allow}a-zA-Z0-9]/", "", $string);
				}
				return $cleaned;
	}
}

function serialthis($source)
{
	return base64_encode(serialize($source));
}

function unserialthis($serialize_data)
{
	$res =  @unserialize(base64_decode($serialize_data));
	if($res):
		return $res;
	else:
		return array();
	endif;
}

function filter_serialthis($array)
{
	return urlencode(serialthis($array));
}

function un_filter_serialthis($array)
{
	// pre($array);
	if($array =='0' || $array =='YTowOnt9'):
		return array();
	else:
		return unserialthis(urldecode($array));
	endif;
}

function email_mask($email)
{
	$mail=explode('@', $email);
	$user = $mail[0];

	$all = strlen($user);
	$dibagi = floor($all / 2);
	$jml_depan = $all - $dibagi;
	$jml_belakang = $dibagi;

	$user_depan = substr($user, 0, $jml_depan);

	$mask = '';
	for($i=0; $i<$jml_belakang; $i++):
		$mask .= '*';
	endfor;
	return $user_depan.$mask.'@'.$mail[1];
}

function terbilang_get_valid($str,$from,$to,$min=1,$max=9){
	$val=false;
	$from=($from<0)?0:$from;
	for ($i=$from;$i<$to;$i++){
		if (((int) $str{$i}>=$min)&&((int) $str{$i}<=$max)) $val=true;
	}
	return $val;
}

function terbilang_get_str($i,$str,$len){
	$numA=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
	$numB=array("","se","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
	$numC=array("","satu ","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
	$numD=array(0=>"puluh",1=>"belas",2=>"ratus",4=>"ribu", 7=>"juta", 10=>"milyar", 13=>"triliun");
	$buf="";
	$pos=$len-$i;
	switch($pos){
		case 1:
				if (!terbilang_get_valid($str,$i-1,$i,1,1))
					$buf=$numA[(int) $str{$i}];
			break;
		case 2:	case 5: case 8: case 11: case 14:
				if ((int) $str{$i}==1){
					if ((int) $str{$i+1}==0)
						$buf=($numB[(int) $str{$i}]).($numD[0]);
					else
						$buf=($numB[(int) $str{$i+1}]).($numD[1]);
				}
				else if ((int) $str{$i}>1){
						$buf=($numB[(int) $str{$i}]).($numD[0]);
				}
			break;
		case 3: case 6: case 9: case 12: case 15:
				if ((int) $str{$i}>0){
						$buf=($numB[(int) $str{$i}]).($numD[2]);
				}
			break;
		case 4: case 7: case 10: case 13:
				if (terbilang_get_valid($str,$i-2,$i)){
					if (!terbilang_get_valid($str,$i-1,$i,1,1))
						$buf=$numC[(int) $str{$i}].($numD[$pos]);
					else
						$buf=$numD[$pos];
				}
				else if((int) $str{$i}>0){
					if ($pos==4)
						$buf=($numB[(int) $str{$i}]).($numD[$pos]);
					else
						$buf=($numC[(int) $str{$i}]).($numD[$pos]);
				}
			break;
	}
	return $buf;
}

function toTerbilang($nominal){
	$buf="";
	$str=$nominal."";
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	return trim($buf);
}

function datetime_split($datetime)
{
	$split = explode(' ', $datetime);
	return $split[0];
}

//from kmi
function date_to_segment($datetime)
{
	//2015-12-16 07:00:00

	$arr_date = array();
	$first = explode(' ', $datetime);
	$tanggal = $first[0];
	$jam = $first[1];

	$pecah_tanggal = explode('-', $tanggal);
	$pecah_jam = explode(':', $jam);

	$arr_date['tahun'] = $pecah_tanggal[0];
	$arr_date['bulan'] = $pecah_tanggal[1];
	$arr_date['tanggal'] = $pecah_tanggal[2];
	$arr_date['jam'] = $pecah_jam[0];
	$arr_date['menit'] = $pecah_jam[1];
	$arr_date['detik'] = '00';

	// pre($arr_date);

	return $arr_date;
}

function nama_hari($tanggal){

    //2015-12-16 07:00:00

	$arr_datetime = date_to_segment($tanggal);
    $info=date('w', mktime(0, 0, 0, $arr_datetime['bulan'], $arr_datetime['tanggal'], $arr_datetime['tahun']));

    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };

}

function random_color($length=6){
	$chars = 'ABCDEF0123456789';
	$count = mb_strlen($chars);

	for ($i = 0, $result = ''; $i < $length; $i++) {
	    $index = rand(0, $count - 1);
	    $result .= mb_substr($chars, $index, 1);
	}

	return '#'.$result;
}

function default_date_format($date='1970-01-01')
{
	$date = date_create($date);

	$tanggal = date_format($date,'d');
	$hari = date_format($date,'w');
	// $hari_singkat = date_format($date,'D');

	$bulan = date_format($date,'m');
	$bulan_nama = number_to_month(date_format($date,'n'));

	$tahun = date_format($date,'Y');

	switch($hari){
        case '0': $hari_singkat = "Minggu"; break;
        case '1': $hari_singkat = "Senin"; break;
        case '2': $hari_singkat = "Selasa"; break;
        case '3': $hari_singkat = "Rabu"; break;
        case '4': $hari_singkat = "Kamis"; break;
        case '5': $hari_singkat = "Jumat"; break;
        case '6': $hari_singkat = "Sabtu"; break;
    };
    return $hari_singkat.', '.$tanggal.' '.$bulan_nama.' '.$tahun;
}

function strToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

function encodeJson($data=array())
{
	$CI =& get_instance();
	if ($CI->is_valid_token) {
		$arr = array(
			'data' => $data,
			'totalData'	=> count($data)
		);
		return json_encode($arr);
	} else {
		return json_encode($data);
	}
}

function interval_date($time_end, $time_start='', $lang='en')
{

	if ($time_start=='') {
		$time = time() - $time_end; // to get the time since that moment
	} else {
		$time = $time_end - $time_start; // to get the time since that moment
	}
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        $text = $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        $text = $text.' ago';
        return $text;
    }
}

function from_camel($some_string) {
	preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $some_string, $matches);
	$ret = $matches[0];

	foreach ($ret as &$match) {
		$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
	}

	return implode('_', $ret);
}

function from_array_camel_key($arr) {
	$new_arr = array();

	foreach ($arr as $key => $value) {
		$new_arr[from_camel($key)] = $value;
	}

	return $new_arr;
}

function detail_regional($code='')
{
	$CI =& get_instance();
	$arr = array();
	$area = $code=='' ? session_scope_area() : $code;
	$CI->db->where('code', $area);
	$q = $CI->db->get('regional');
	if ($q->num_rows() > 0) {
		$arr = $q->row_array();
	}
	return $arr;
}

function minify_js($value)
{
	$value = str_replace('<script type="text/javascript">', '', $value);
	$value = str_replace('<script>', '', $value);
	$value = str_replace('</script>', '', $value);
    $url = 'https://javascript-minifier.com/raw';

    // init the request, set some info, send it and finally close it
    $ch = curl_init($url);

    curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "input=".urlencode($value),
		CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded"
		),
	));

    $minified = curl_exec($ch);

    curl_close($ch);

    // output the $minified
    // $minified = $value;
    return $minified;
}
