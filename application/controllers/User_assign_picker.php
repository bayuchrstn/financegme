<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_assign_picker extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Model_user_assign', 'user_assign');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($selected_structure='', $selected_assigned='')
	{
		$arr = array();
		$arr['structure'] = $this->arr_to_option($this->get_structure());
		$arr['assigned'] = $this->arr_to_option($this->get_assigned($selected_structure));
		// $arr['selected_location'] = $selected_location;
		echo json_encode($arr);
	}

	function get_structure()
	{
		$array = array(
			'custom'				=> 'User',
			'divisi'				=> 'Divisi',
			'department'			=> 'Department',
			'sub_department'		=> 'Sub Department',
			'jabatan'				=> 'Jabatan',
		);
		return $array;
	}

	function get_assigned($selected_structure)
	{
		return $this->user_assign->get_assigned($selected_structure);
	}


	function arr_to_option($arr)
	{
		$options = '';
		if(!empty($arr)):
			foreach($arr as $key=>$val):
				$options .= '<option value="'.$key.'">'.$val.'</option>';
			endforeach;
		endif;
		return $options;
	}

}
