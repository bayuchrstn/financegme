<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alert extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('user');
		$this->load->model('model_alert', 'alert');

		$this->active_root_menu = 'Notifikasi';
		$this->browser_title = 'Daftar Notifikasi';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';

	}

	public function index($customer_group='')
	{
		// valid_action('alert');
		$data = array();
		$this->js_inject .= $this->load->view('alert/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('alert/js', $data, TRUE);
		$this->js_inject .= $this->load->view('alert/valid', $data, TRUE);
		$konten = $this->load->view('alert/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function delete($id='')
	{
		if($this->input->post('alert_id')):
			// $detail = $this->alert->detail($id);

			$arr = array();
			$arr['status'] = 'success';
			$arr['msg'] = 'Notifikasi berhasil dihapus';
			echo json_encode($arr);
		endif;
	}

	public function data()
	{
		$data = $this->alert->data();
		// pre($data); exit;
		// pre($this->db->last_query());
		$arr = array();
		$arr['data'] = array();
		if(!empty($data)):
			$urut = 0;
			foreach($data as $row):
				$urut++;

				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="delete_notification(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-trash"></i> Delete</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$target_url = ($row['link_url'] !='') ? base_url($row['link_url']) : "#";
				$konten = '<a href="'.$target_url.'">'.$row['content'].'</a>';

				$arr['data'][] = array(
						'x',
						$konten,
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;

	}

	function getuk()
	{
		$this->alert->get();
	}

	function _create()
	{
		// membuat alert ->
		$params['link_url'] = 'progress/index/435345341';
		$alert_config = $this->alert->get_config('m1', $params);
		$this->alert->create($alert_config);
		// membuat alert ->
	}

}
