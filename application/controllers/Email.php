<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('user');
		$this->load->model('model_email_list', 'email_list');

		$this->active_root_menu = 'Email';
		$this->browser_title = 'Email';
		$this->modul_name = 'Email';

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';

	}

	public function index($customer_group='')
	{
		valid_action('email');

		$this->breadcrumb = array(
				'Email'	=> '#',
			);
		$data = array();
		$modul = $this->email_list->info_modul('email');
		$data['modul'] = $modul;
		$data['tabs'] = $this->email_list->tabs();
		// $data['usergroup_lists'] = $this->usergroup->arr_usergroup_reg();
		// $data['privileges_tree'] = $this->usergroup->privileges_tree();
		// $data['scope'] = $this->user->view_scope();
		// $data['departement'] = $this->master->arr('departement');
		// $data['arr_regional'] =  $this->regional->arr_regional();


		$this->js_inject .= $this->load->view('email/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('email/js', $data, TRUE);
		$this->js_inject .= $this->load->view('email/valid', $data, TRUE);

		$data['modal_view'] = $this->load->view('email/modal', $data, TRUE);
		$data['update_view'] = $this->load->view('email/update', $data, TRUE);

		$konten = $this->load->view('email/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function update($id='')
	{
		$detail = $this->email_list->detail($id);
		if(!$this->form_validation->run('email_update')):
			$arr = array();
			$arr['action'] = base_url().'email/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			$arr = array();
			$arr['post'] = $_POST;
			$this->crud->update('email', array(), array('id'));
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	public function data($category='')
	{
		$email = $this->email_list->data($category);
		// pre($email); exit;
		// pre($this->db->last_query());
		$arr = array();
		$arr['data'] = array();
		$arr['debug'] = $email;
		if(!empty($email)):
			$urut = 0;
			foreach($email as $row):
				$urut++;

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$arr['data'][] = array(
						'x',
						$row['name'],
						$row['code'],
						$row['receiver'],
						$row['note'],
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;

	}



}
