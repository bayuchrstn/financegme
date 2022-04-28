<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachment extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_attachment', 'attachment');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index($task_id)
	{
		$data['attachments'] = $this->attachment->get('task', $task_id);
		echo $this->load->view('attachment/index', $data, TRUE);
	}

	function delete($id='')
	{
		$this->db->where('id', $id);
		$this->db->delete('task_attachment');
	}


}
