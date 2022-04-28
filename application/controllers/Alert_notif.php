<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alert_notif extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('user');
		$this->load->model('model_alert_notif', 'alert_notif');

		$this->active_root_menu = 'Notifikasi';
		$this->browser_title = 'Daftar Notifikasi';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';

	}
	

	function index()
	{
		$data = array();
		$data['tabs'] = $this->alert_notif->tabs();
		$data['set_ui'] = $this->alert_notif->set_ui();
		$this->js_inject .= $this->load->view('alert_notif/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('alert_notif/js', $data, TRUE);
		$this->js_inject .= $this->load->view('alert_notif/valid', $data, TRUE);
		$konten = $this->load->view('alert_notif/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function data($status='unread')
	{
		// ajax_only();
		$where = array(
			// 'status'	=> $status,
			'user_id'	=> my_id(),
			'is_hidden'	=> 0
		);
		if ($status=='starred') {
			$where['is_starred'] = 1;
		} else {
			$where['status'] = $status;
		}
		$lists = $this->alert_notif->get_datatables($where);
		$data = array();
		$no = $this->input->post('start') ? $this->input->post('start') : 0;
		foreach ($lists as $list) {
			$no++;
			$content_url = '<a href="'.base_url().'alert_notif/read/'.$list->id.'"></a>';
			// $btn = '<a class="btn btn-xs btn-danger" onclick="action_delete('.$list->id.');"><i class="fa fa-times"></i> Delete</a>';
			$row = array();
			$row['urut'] = $no;
			$row['id'] = intval($list->id);
			$row['alert_code'] = $list->alert_code;
			$row['title'] = $list->title;
			$row['content'] = $list->content;
			$row['date_create'] = date('d M Y H:i', strtotime($list->date_create));
			// $row['button']	= $btn;
			$row['date_open'] = is_null($list->date_open) ? NULL : date('d M Y H:i', strtotime($list->date_open));
			$row['date_read'] = is_null($list->date_read) ? NULL : date('d M Y H:i', strtotime($list->date_read));
			$row['url_link'] = $list->url_link;
			$row['status'] = $list->status;
			$row['related_id'] = $list->related_id;
			$row['is_starred'] = intval($list->is_starred);
			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw') ? $this->input->post('draw') : 0,
			"recordsTotal" => $this->alert_notif->count_all($where),
			"recordsFiltered" => $this->alert_notif->count_filtered($where),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function my_notif()
	{
		$user_id = my_id();
		$condition = array(
			'user_id'	=> $user_id,
			'status'	=> 'unread',
			'is_hidden'	=> 0
		);
		$detail = $this->alert_notif->get_datatables($condition);
		$data = array();
		$data = arr_string_to_int( $detail, array('id','user_id','is_hidden') );

		$arr = array();
		foreach ($data as $row) {
			$arr[] = array(
				'id'	=> $row['id'],
				'title'	=> $row['title'],
				'content'	=> $row['content'],
				'date_create'	=> $row['date_create']
			);
		}

		echo encodeJson($arr);
	}

	function get_user_receiver($modul_code)
	{
		$data = $this->alert_notif->get_user_by_modul($modul_code);
		echo encodeJson($data);
	}
	function get_user_receiver_task($task_id)
	{
		$data = $this->alert_notif->get_user_task($task_id);
		echo encodeJson($data);
	}

	function update($mode='html')
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array();
		$data = $this->alert_notif->detail($id);
		if (count($data)>0) {
			$this->alert_notif->update($data['id'],$status);
			$arr = $this->alert_notif->detail($data['id']);
			if ($mode=='json') {
				echo json_encode($arr);
			} else {
				redirect(base_url().$arr['url_link']);
			}
		} else {
			$arr = array(
				'status'	=> 401,
				'message'	=> 'Unauthorized'
			);
			echo json_encode($arr);
		}
	}

	function insert()
	{
		$this->alert_notif->insert();
		$data = array(
			'status'	=> 200,
			'message'	=> 'Insert success'
		);
		echo encodeJson($data);
	}

	function getStramFile()
	{
		$path = $this->input->post('file');
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$file = file_get_contents($path);
		$base64 = base64_encode($file);
		$data = array(
			'image'	=> $base64,
			'type'	=> $type
		);
		echo json_encode($data);
		// echo $data;
	}

}

/* End of file Alert_notif.php */
/* Location: ./application/controllers/Alert_notif.php */