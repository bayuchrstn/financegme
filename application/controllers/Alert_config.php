<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alert_config extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		// $this->lang->load('dashboard');
		$this->browser_title = 'Progress';
		$this->load->model('model_alert', 'alert');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index($pid='')
	{
		$this->breadcrumb = array(
				'Dashboard'	=> '#',
			);
		// $detail = $this->progress->detail($pid);
		// if(empty($detail)):
		// 	show_404();
		// endif;
		$data = array();
		$data['pid'] = $pid;
		$data['modal_view'] = $this->load->view('alert_config/modal', $data, TRUE);
		$this->js_inject .= $this->load->view('alert_config/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('alert_config/js', $data, TRUE);
		$this->js_inject .= $this->load->view('alert_config/valid', $data, TRUE);

		$konten = $this->load->view('alert_config/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function update($id='')
	{
		$arr = array();
		$data = array();
		$detail = $this->alert->detail_config($id);

		$detail_config = array();
		if(!empty($detail)):
			foreach($detail as $row=>$val):
				$detail_config[$row] = $val;
			endforeach;
			$detail_config['arr_divisi'] = explode(',', $detail['divisi']);
			$detail_config['arr_department'] = explode(',', $detail['department']);
			$detail_config['arr_sub_department'] = explode(',', $detail['sub_department']);
			$detail_config['arr_jabatan'] = explode(',', $detail['jabatan']);
			$detail_config['arr_user_id'] = explode(',', $detail['user_id']);
		endif;

		$data['detail'] = $detail_config;
		if(!$this->form_validation->run('sender')):
			$arr['html'] = $this->load->view('alert_config/form/update', $data, TRUE);
			echo json_encode($arr);
		else:
			$data = array();

			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['max_show'] = $this->input->post('max_show');
			$data['time_interval'] = $this->input->post('time_interval');

			if($this->input->post('divisi')):
				$post = $this->input->post('divisi');
				$final = implode(',', $post);
				$data['divisi'] = $final;
			else:
				$data['divisi'] = '';
			endif;

			if($this->input->post('department')):
				$post = $this->input->post('department');
				$final = implode(',', $post);
				$data['department'] = $final;
			else:
				$data['department'] = '';
			endif;

			if($this->input->post('sub_department')):
				$post = $this->input->post('sub_department');
				$final = implode(',', $post);
				$data['sub_department'] = $final;
			else:
				$data['sub_department'] = '';
			endif;

			if($this->input->post('jabatan')):
				$post = $this->input->post('jabatan');
				$final = implode(',', $post);
				$data['jabatan'] = $final;
			else:
				$data['jabatan'] = '';
			endif;

			if($this->input->post('user_id')):
				$post = $this->input->post('user_id');
				$final = implode(',', $post);
				$data['user_id'] = $final;
			else:
				$data['user_id'] = '';
			endif;

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('alert_config', $data);

			$arr['data'] = $data;
			$arr['post'] = $_POST;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	public function data()
	{
		$data = $this->alert->data_config();
		// pre($data); exit;
		// pre($this->db->last_query());
		$arr = array();
		$arr['data'] = array();
		if(!empty($data)):
			$urut = 0;
			foreach($data as $row):
				$urut++;

				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				// $target_url = ($row['link_url'] !='') ? base_url($row['link_url']) : "#";
				// $konten = '<a href="'.$target_url.'">'.$row['content'].'</a>';

				$arr['data'][] = array(
						'x',
						'<b>'.$row['name'].'</b><br>'.$row['note'].'<br>[ Kode : '.$row['code'].' ]',
						$this->alert->get_group_name($row['divisi'], 'divisi'),
						$this->alert->get_group_name($row['department'], 'department'),
						$this->alert->get_group_name($row['sub_department'], 'sub_department'),
						$this->alert->get_group_name($row['jabatan'], 'jabatan'),
						$this->alert->get_group_name($row['user_id'], 'user_id'),
						$action
					);
			endforeach;
		endif;
		// pre($arr);
		$ret = json_encode($arr);
		echo $ret;
	}

	function tes()
	{
		$params['link_url'] = 'progress/index/1';
		$alert_config = $this->alert->get_config('m1', $params);
		pre($alert_config);
	}

}
