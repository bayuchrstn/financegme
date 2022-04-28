<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller {

	public function __construct()
    {
		parent::__construct();

		check_login();
		$this->lang->load('setting');
		$this->selected_menu = 'Setting';
		$this->selected_submenu = '';
		$this->load->model('model_setting', 'setting');

		$this->breadcrumb = array(
	          	'Home'      								=> base_url().'dashboard',
	            $this->lang->line('setting_title')			=> base_url().'setting'
	        );
		$this->browser_title = $this->lang->line('setting_title');
		$this->js_inject = '';
	}

	public function index()
	{
		valid_action('setting');
		if($this->form_validation->run('setting_update')):
			$arr_msg = array();
			$arr_msg['post'] = $_POST;
			foreach($_POST as $post=>$val):
				if($post != 'fake_setting' && $post !='submit' && $post !='selected_setting'):
					$up = "UPDATE {PRE}setting SET value ='".$val."' WHERE setting='".$post."' ";
					// pre($up);
					$this->db->query($up);
				endif;
			endforeach;
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = 'Data setting berhasil disimpan';
			$response = json_encode($arr_msg);
			echo $response;
		else:
			$data = array();
			$this->js_inject .= $this->load->view('setting/js', $data, TRUE);
			$this->js_inject .= $this->load->view('setting/valid', $data, TRUE);
			$data['view_insert'] = $this->load->view('setting/insert', $data, TRUE);
			$konten = $this->load->view('setting/index', $data, TRUE);
			$this->admin_view($konten);
		endif;
	}

	function tabby($selected='')
	{
		$data['selected'] = $selected;
		$this->load->view('setting/tabby', $data);
	}
}
