<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		// $this->load->model('model_brand', 'brand');
		// $this->lang->load('brand');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function task_attachment($task_category='marketing_progress')
	{
		switch ($task_category) {
			default:
				$upload_dir = FILE_PATH_ATTACHMENT.$task_category.'/';
			break;
		}
		$params = array(
			'param_name' 			=> 'attachment',
			'upload_dir' 			=> $upload_dir,
			'accept_file_types' 	=> '/\.(gif|jpe?g|png)$/i',
		);
        $this->load->library("Uploadhandler", $params);
	}

	function request($req_code='')
	{
		switch ($req_code) {
			default:
				$upload_dir = FILE_PATH_ATTACHMENT.$req_code.'/';
			break;
		}

		// pre($upload_dir);

		$params = array(
			'param_name' 			=> 'attachment',
			'upload_dir' 			=> $upload_dir,
			'accept_file_types' 	=> '/\.(gif|jpe?g|png)$/i',
		);
        $this->load->library("Uploadhandler", $params);
	}

	function people_doc()
	{
		$upload_dir = FILE_PATH_ATTACHMENT.'people_doc';

		// pre($upload_dir);

		$params = array(
			'param_name' 			=> 'file_name',
			'upload_dir' 			=> $upload_dir,
			'accept_file_types' 	=> '/\.(gif|jpe?g|png)$/i',
		);
		// pre($params);
        $this->load->library("Uploadhandler", $params);
	}



}
