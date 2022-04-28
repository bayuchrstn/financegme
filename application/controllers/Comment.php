<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Model_comment', 'comment');
		$this->load->model('Model_task', 'm_task');

	}

	function index($modul='', $parent='')
	{
		if(!$this->form_validation->run('comment')):
			$data = array();
			$data['modul'] = $modul;
			$data['parent'] = $parent;
			$this->load->view('comment/index', $data, FALSE);
		else:
			$arr = array();
			$params = array(
					'date_post'		=> now(),
					'author'		=> my_id(),
				);
			$this->crud->insert('comment', $params, array('id'));
			$arr['post'] = $_POST;
			echo json_encode($arr);
		endif;
	}

	function lists($modul='', $parent='')
	{
		$data = array();
		$data['current'] = $this->comment->get($parent);
		$this->load->view('comment/lists', $data);
	}

	function update()
    {

    }

    function insert_task_comment()
    {
    	$data = array('status' => 'failed');
    	if ($this->input->post('task_id')) {
    		$params = array(
    			'task_id'	=> $this->input->post('task_id'),
    			'author'	=> my_id(),
    			'author_type'	=> 'user',
    			'date_post'	=> time(),
    			'content'	=> $this->input->post('comment')
    		);
    		$this->crud->insert('task_comment', $params, array('id'));

    		$task_id = $this->input->post('task_id');
    		$comment = $this->input->post('comment');

    		$upper_id = $this->m_task->get_upper_task($task_id);
			$data_task = $this->m_task->get_task_child($upper_id);
			$related_id = $this->m_task->get_related_task_id($data_task);
			$arr_related_id = explode(',', $related_id);
			$arr_related_id_new = array();
			foreach ($arr_related_id as $value) {
				if ($value!='') {
					$arr_related_id_new[] = $value;
				}
			}

			$user_list = $this->m_task->get_related_user_task($arr_related_id_new);
			if (!empty($user_list)) {
				foreach ($user_list as $user) {
					if (my_id() != $user['user_id']) {
						$params_alert = array(
							'alert_code'	=> $user['task_category']=='mrk' ? 'admin_sales' : $user['task_category'],
							'title'	=> 'Pesan Komentar - '.$user['task_subject'],
							'content'	=> $comment,
							'user_id'	=> $user['user_id'],
							'related_id'	=> $user['task_id'],
							'url_link'	=> $user['task_category']=='mrk' ? 'admin_sales' : $user['task_category']
						);
						$this->alert_notif->insert($params_alert);
					}
				}
			}
    		
    		$data = array(
    			'status' => 'success'
    		);
    	}
    	echo json_encode($data);
    }

}
