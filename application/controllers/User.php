<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('user');
		$this->load->model('model_user', 'user');
		$this->load->model('model_usergroup', 'usergroup');
		$this->load->model('model_master', 'master');

		$this->active_root_menu = 'User / Usergroup';
		$this->browser_title = $this->lang->line('user_alltitle');
		$this->modul_name = $this->lang->line('user_alltitle');

		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';

	}

	public function index($customer_group='')
	{
		valid_action('usergroup');

		$this->set_shortcut();
		$this->breadcrumb = array(
				$this->lang->line('user_alltitle')	=> '#',
			);
		$data = array();
		$data['usergroup_lists'] = $this->usergroup->arr_usergroup_reg();
		$data['privileges_tree'] = $this->usergroup->privileges_tree();
		$data['scope'] = $this->user->view_scope();
		$data['departement'] = $this->master->arr('departement');
		$data['arr_regional'] =  $this->regional->arr_regional();
		// pre($data['arr_regional']);
		$data['arr_area'] =  $this->regional->arr_area('1');
		$this->js_inject .= $this->load->view('user/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('user/js', $data, TRUE);
		$this->js_inject .= $this->load->view('user/valid', $data, TRUE);

		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('jquery_tree');
		$this->css_include .= $this->ui->load_css('jquery_ui');
		$this->css_include .= $this->ui->load_css('jquery_tree');

		$data['insert_view'] = $this->load->view('user/insert', $data, TRUE);
		$data['update_view'] = $this->load->view('user/update', $data, TRUE);
		$data['delete_view'] = $this->load->view('user/delete', $data, TRUE);
		$data['usergroup_view'] = $this->load->view('usergroup/privileges', $data, TRUE);

		$konten = $this->load->view('user/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function insert()
	{
		ajax_only();
		$arr = array();

		if($this->form_validation->run('user_insert')):
			$arr['post'] = $_POST;
			//cek username dipakai orang lain apa gak?
			// if(!$this->user->valid_username('insert', $this->input->post('username') )):
			// 	$arr_msg['status'] = 'gagal';
			// 	$arr_msg['msg'] = 'Username sudah dipakai orang lain';
			// 	$response = json_encode($arr_msg);
			// 	echo $response;
			// 	exit;
			// endif;
			$params = array();
			$params['password'] = pass_generator($this->input->post('password'));
			$params['registration_date'] = now();
			$params['view_scope'] = 'regional';
			$params['regional'] = session_scope_regional();
			$params['area'] = session_scope_area();
			$result_insert = $this->crud->insert('users', $params, array('id'));

			if($result_insert):
				$arr['status'] = 'success';
				$arr['msg'] = 'Data berhasil disimpan';
			else:
				$arr['status'] = 'failed';
				$arr['msg'] = 'Data gagal disimpan';
			endif;
		endif;
		$response = json_encode($arr);
		echo $response;
	}

	public function update($id='')
	{
		$detail = $this->user->detail($id);
		if(!$this->form_validation->run('user_update')):
			$arr = array();
			$arr['action'] = base_url().'user/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			$arr_msg = array();
			$this->user->update();
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		if($this->form_validation->run('user_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('users');
			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = 'User '.$detail['name'].' '.$this->lang->line('user_success_delete');
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$detail = $this->user->detail($id);
			$arr = array();
			$arr['action'] = base_url().'user/delete/'.$detail['id'];
			$related = $this->related->user($detail['id']);
			$arr['data_info'] = $this->data_info($detail);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_delete') : $this->lang->line('dialog_no_delete');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		endif;
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'Name'		=> $detail['name'],
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	function set_shortcut()
	{
		$fa = '<a onclick="input_user();" href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn legitRipple">Input User <b><i class="icon-plus3"></i></b></a>';
		$this->feature_action =  $fa;
	}

	public function data()
	{
		$users = $this->user->all_user();
		$user = $users['data'];
		// pre($this->db->last_query());
		$arr = array();
		$arr['data'] = array();
		if(!empty($user)):
			$urut = 0;
			foreach($user as $row):
				$urut++;
				// pre($row);
				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_user(\''.$row['id'].'\');" ');
		        $action = $this->actionform->dropdown($hidden_form);

				// $grp = '<a onclick="update_usergroup_from_user(\''.$row['group_id'].'\');" href="javascript:void(0);">'.$row['group_name'].'</a>';

				$status = ($row['status']=='active') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Non Active</span>';

				// $info_scope = ($row['view_scope_note']=='group') ? $row['scope_departement'] : $row['view_scope_note'];

				$jabatan = $this->usergroup->jabatan_name($row['jabatan']);
				// $jabatan = $jabatan_data['name'];

				$divisi_show = '<a onclick="update_usergroup_from_user('.$row['divisi_id'].')" href="javascript:void(0);">'.$row['divisi_name'].'</a>';
				$department_show = '<a onclick="update_usergroup_from_user('.$row['department_id'].')" href="javascript:void(0);">'.$row['department_name'].'</a>';
				$sub_department_show = '<a onclick="update_usergroup_from_user('.$row['sub_department_id'].')" href="javascript:void(0);">'.$row['sub_department_name'].'</a>';
				$jabatan_show = '<a onclick="update_usergroup_from_user('.$row['jabatan_id'].')" href="javascript:void(0);">'.$jabatan.'</a>';

				$user_info = $row['name'];
				// $user_info .= '<span class="label border-left-danger label-striped">View Scope : '.$info_scope.'</span>';
				$arr['data'][] = array(
						'x',
						$user_info,
						$divisi_show,
						$department_show,
						$sub_department_show,
						$jabatan_show,
						$status,
						$action
					);
			endforeach;
		endif;
		$arr['query'] = $users['last_query'];
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;

	}

	function set_assigned($user_id, $assigned_status)
	{
		if($assigned_status=='yes'):
			$data = array(
				'tag'	=> 'assigned_user'
			);
		else:
			$data = array(
				'tag'	=> ''
			);
		endif;
		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
		// pre($data);
		// redirect(base_url().'user');
		$arr_msg['status'] = 'sukses';
		$arr_msg['msg'] = 'Data berhasil disimpan';

		echo json_encode($arr_msg);
	}

	function register_valid_username()
	{
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get('users')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function register_valid_email()
	{
		$this->db->where('email', $this->input->post('email'));
		$cek = $this->db->get('users')->result_array();
		if(empty($cek)):
			echo 'true';
		else:
			echo 'false';
		endif;
	}

	function dds($mode='', $parent='')
	{
		$options = '';
		$data = $this->user->dds($mode, $parent);
		if(!empty($data)):
			foreach($data as $row=>$val):
				$options .= '<option value="'.$row.'">'.$val.'</option>';
			endforeach;
		endif;
		echo $options;
	}

}
