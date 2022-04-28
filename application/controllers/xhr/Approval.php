<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
        $this->load->model('Model_approval', 'approval');
        // $this->load->model('Model_bcn', 'bcn');
	}

    function index($modul='', $task_id='')
    {
		$data = array();
		$data['modul'] = $modul;
		$data['task_id'] = $task_id;
		$data['approval_cfg'] = $this->approval->get_config($modul);
		// pre($data);
        $this->load->view('approval/index', $data, FALSE);
    }

	function update()
	{
		cekpost();
	}

	function checkbox_generator()
	{
		if(!$this->form_validation->run('sender')):
			$data = array();
			$this->load->view('approval/generator', $data, FALSE);
		else:
			$arr = array();
			// pre($_POST);
			$xxc = $this->input->post('option');
			$option = explode(',', $xxc);
			// pre($option);
			if(!empty($option)):
				foreach($option as $row):
					$split_option = explode('|', $row);
					// $arr[$split_option[0]] = $split_option[1];
					$arr[] = array(
						'value'		=> $split_option[0],
						'text'		=> $split_option[1],
					);
				endforeach;
			endif;
			// pre($arr);
			// echo serialthis($arr);
			// echo json_encode($arr);

			$json =  json_encode($arr);
			$json = str_replace('"',"'",$json);
			echo $json;

			echo '<br><a href="'.base_url().'xhr/approval/checkbox_generator">back</a>';
		endif;
	}


}
