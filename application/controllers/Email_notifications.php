<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_notifications extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_email_notification', 'email_notification');
		$this->lang->load('email_notification');
		$this->active_root_menu = $this->lang->line('email_notification_alltitle');
		$this->browser_title = $this->lang->line('email_notification_alltitle');
		$this->modul_name = $this->lang->line('email_notification_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	public function index()
	{
		valid_action('email_notifications');
		$this->breadcrumb = array(
				$this->lang->line('email_notification_alltitle')	=> '#',
			);
		$data = array();
		$this->js_include .= $this->ui->js_include('wysiwyg');
		$this->js_include .= $this->ui->js_include('bootstrap_multiselect');
		$this->js_inject .= $this->load->view('email_notification/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('email_notification/js', $data, TRUE);
		$this->js_inject .= $this->load->view('email_notification/valid', $data, TRUE);
		$data['placeholders'] = $this->email_notification->tag_placeholder();
		$data['email_agent'] = $this->email_notification->get_agent_email();
		$data['update_view'] = $this->load->view('email_notification/update', $data, TRUE);
		$konten = $this->load->view('email_notification/index', $data, TRUE);
		$this->admin_view($konten);
	}

	public function update($id='')
	{
		valid_action('email_notifications');
		ajax_only();
		if(!$this->form_validation->run('email_notification_update')):
			$detail = $this->email_notification->detail($id);
			$arr = array();
			$arr['action'] = base_url().'email_notifications/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			echo json_encode($arr);
		else:
			// cekpost();
			// if($this->input->post('receiver')=='defined'):
			// 	$str_agent = join(', ', $this->input->post('receiver'));
			// else:
			// 	$str_agent = '';
			// endif;

			$this->email_notification->update();

			$arr_msg['status'] = 'sukses';
			$arr_msg['msg'] = $this->lang->line('email_notification_success_update');
			echo json_encode($arr_msg);
		endif;
	}

	public function data()
	{
		$email_notification = $this->email_notification->all();

		$arr = array();
		$arr['data'] = array();
		if(!empty($email_notification)):
			$urut = 0;
			foreach($email_notification as $row):
				$urut++;

				$hidden_form['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_email_notification(\''.$row['id'].'\');" class="edit_button" ');
		        $action = $this->actionform->dropdown($hidden_form);

				if($row['status']=='enable'):
					$status = '<span class="label label-success">Enable</span>';
				else:
					$status = '<span class="label label-danger">Disabled</span>';
				endif;

				$info = '<span class="label border-left-danger label-striped"><i class="icon-envelop2"></i> '.clean_string($row['name'], '70').'</span><br/>'.$row['description'];

				$arr['data'][] = array(
						'x',
						'<span class="label label-default">'.$row['code'].'</span>',
						$info,
						$status,
						$action
					);
			endforeach;
		endif;
		$ret = json_encode($arr);
		echo $ret;
	}

}
