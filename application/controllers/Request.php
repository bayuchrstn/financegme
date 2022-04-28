<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();

		$this->load->model('model_request', 'request');
		$this->load->model('model_location', 'location');
		$this->load->model('model_user_assign', 'user_assign');
		$this->load->model('model_user', 'user');
		$this->load->model('model_email_list', 'email_list');
		$this->load->model('Model_item_transaction', 'item_transaction');
		$this->load->model('Model_location', 'location');

		$this->active_root_menu = '';
		$this->browser_title = '';
		$this->modul_name = '';
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function request_model_loader($req_code)
	{
		// pre($req_code);
		$this->load->model('request/model_'.$req_code, $req_code);
	}

	public function index($req_code='', $filter='')
	{
		// pre($this->uri->segment(2));
		// pre($req_code);
		// pre($filter);

		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		// exit;

		if($this->uri->segment(2)=='r'):
			$modul_code = $modul['code'].'_report';
		else:
			$modul_code = $modul['code'];
		endif;

		// valid_action($modul['code']);
		valid_action($modul_code);

		$this->lang->load('request/'.$modul['code']);
		$this->request_model_loader($modul['code']);
		$modul_str = $modul['code'];
		$set_ui = $this->$modul_str->set_ui();
		$tabs = $this->$modul_str->tabs();
		// pre($tabs);
		// pre($set_info);

		$this->breadcrumb = $set_ui['breadcrumb'];

		$data = array();
		$data['filter'] = $filter;
		$data['arr_filter'] = un_filter_serialthis($filter);
		$data['modul'] = $modul;
		$data['req_code'] = $req_code;
		$data['set_ui'] = $set_ui;
		$data['tabs'] = $tabs;
		// pre($data['arr_filter']);
		// pre($data); exit;

		// $this->js_include .= $this->ui->js_include('jmd');
		$this->js_include .= $this->ui->js_include('editable');
		$this->js_include .= $this->ui->js_include('jquery_ui');
		$this->js_include .= $this->ui->js_include('ajax_upload');
		$this->js_inject .= $this->load->view('request/js_request', $data, TRUE);
		$this->js_inject .= $this->load->view('request/'.$modul['code'].'/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('request/'.$modul['code'].'/js', $data, TRUE);
		$this->js_inject .= $this->load->view('request/'.$modul['code'].'/js_upload', $data, TRUE);

		// if ($req_code!='my_task') :
			$this->js_inject .= $this->load->view('request/'.$modul['code'].'/valid', $data, TRUE);
		// endif;

		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('wysiwyg');
		$this->js_include .= $this->ui->js_include('time_picker');
		$this->js_include .= $this->ui->js_include('google_maps');

		$data['update_view'] = $this->load->view('request/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('request/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('request/delete', $data, TRUE);
		$data['search_view'] = $this->load->view('request/search', $data, TRUE);
		$data['index_ext_view'] = $this->load->view('request/'.$modul['code'].'/index_ext_view', $data, TRUE);
		$data['modal_view'] = $this->load->view('request/'.$modul['code'].'/modal', $data, TRUE);
		$data['global_modal_view'] = $this->load->view('request/modal', $data, TRUE);

		$main_index_view = (empty($tabs)) ? 'index' : 'index_tab';
		// pre($main_index_view);

		$konten = $this->load->view('request/'.$main_index_view, $data, TRUE);
		$this->admin_view($konten);

	}

	function emulator($req_code='mkt_ts', $filter='')
	{
		// pre($req_code);
		$this->index($req_code, $filter);
	}

	function r($req_code='mkt_ts', $filter='')
	{
		$this->index($req_code, $filter);
	}

	public function insert()
	{
		ajax_only();
		$arr = array();
		if($this->form_validation->run('request_insert')):

			$post_req_code = $this->input->post('req_code');
			$this->request_model_loader($post_req_code);

			$params = array();
			$params['task_category'] = $this->input->post('task_category');
			$params['author'] = my_id();
			$params['date_created'] = now();
			$params['date_start'] = ($this->input->post('date_start')) ? $this->input->post('date_start') : now();

			if ($this->input->post('date_end')) {
				$params['date_end'] = $this->input->post('date_end');
			}

			$params['regional'] = session_scope_regional();
			$params['area'] = session_scope_area();
			$params['body'] = $_POST['body_fake'];
			$params['flock'] = 'n';

			//custom up (optional)
			if($this->input->post('up_select')):
				$params['up'] = $this->input->post('up_select');
			endif;

			//main insert action
			$insert_result = $this->crud->insert('task', $params, array('id'));

			//attachment (optional)
			if($this->input->post('attachment')):
				$attachment_index = $this->input->post('attachment_index');

				if (!$attachment_index):
					$attachments = $this->input->post('attachment');
				else:
					// multiple file input
					$attachments = array();
					$log_attach = array();

					foreach ($attachment_index as $key => $value) {
						$attachment = "attachment_".$value;
						$upload = upload_file($attachment, UPLOAD_PATH);

						if (isset($upload['file_name'])):
							array_push($attachments, $upload['file_name']);
						else:
							array_push($log_attach, $upload['error']);
						endif;
					}
					$arr['upload_log'] = $log_attach;
				endif;

				$this->attachment->insert('task', $insert_result['last_id'], $attachments); // MY_Controller -> Model_attachment
			endif;

			// boq
			$boqs = $this->input->post('boq');
			if(!empty($boqs)):
				switch ($this->input->post('boq_mode')) {
					case 'update':
						$this->load->model('request/model_boq', 'm_boq');

						foreach ($boqs as $id => $data) {
							$this->m_boq->put_by_id($id, $data);
						}
						break;
				}
			endif;

			//User assigned (optional)
			if($this->input->post('user_assigned')):
				$this->user_assign->save_pld($insert_result['last_id'], $this->input->post('user_assigned'));
			endif;

			//task ext
			$this->$post_req_code->task_ext($insert_result['last_id']);

			//global hook
			$hook_res = $this->$post_req_code->hook($insert_result['last_id'], 'insert');

			$arr['post'] = $_POST;
			$arr['hook_res'] = $hook_res;
			$arr['status'] = 'success';
			$arr['msg'] = 'Data behasil disimpan';
		endif;
		$response = json_encode($arr);
		echo $response;
	}

	function show($id='', $req_code='', $mode='echo')
	{
		// pre($id);
		// pre($req_code);
		// pre($mode);
		$data = array();
		$modul = $this->request->info_modul($req_code);
		$modul_code = $modul['code'];
		$this->request_model_loader($modul['code']);

        // -----------------------------------------------------------
		$detail = $this->$modul_code->detail($id);
		// -----------------------------------------------------------

		if(empty($detail)):
			echo 'no data'; exit;
		endif;

		// -----------------------------------------------------------
		$task_ext = $this->$modul_code->get_task_ext($detail['id'], $detail);
		// $task_ext = $this->$modul_code->get_task_ext($detail['id']);
		// -----------------------------------------------------------

		$data['modul'] = $modul;
		$data['detail'] = $detail;
		$data['task_ext'] = $task_ext;
		$data['task_report'] = $this->request->get_task_report($detail['id']);
		// pre($data);

		switch ($mode) {
			case 'return':
				return $this->load->view('request/'.$modul['code'].'/show', $data, TRUE);
				break;
			case 'json':
				echo json_encode($data);
				break;
			
			default:
				echo $this->load->view('request/'.$modul['code'].'/show', $data, TRUE);
				break;
		}

	}

	function widget($req_code='', $mode='default')
	{
		// pre($req_code);
		// pre($mode);
		// $data = array();
		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		$modul_code = $modul['code'];
		// pre($modul_code);
		$this->request_model_loader($modul['code']);

		switch ($mode) {

			default:
				// $view = 'widget_default';
				$view = $mode;
			break;
		}

		$data = $this->$modul_code->widget($mode, $modul);
		// pre($data);

		// pre('request/'.$modul['code'].'/widget/'.$view);
		echo $this->load->view('request/'.$modul['code'].'/widget/'.$view , $data, TRUE);
	}

	public function update($id='', $req_code='')
	{
		// valid_action('marketing_progress');
		// ajax_only();
		$detail = $this->request->detail($id);
		// pre($detail['id']);
		$modul = $this->request->info_modul($req_code);
		// pre($modul); exit;

		$modul_code = $modul['code'];
		$this->request_model_loader($modul['code']);

		if(!$this->form_validation->run( 'request_update' )):
			$arr = array();

			$arr['action'] = base_url().$modul['url'].'/update/'.$detail['id'];
			$arr['user_assigned'] = $this->user_assign->get($detail['id']);
			$arr['task_ext'] = $this->$modul_code->get_task_ext($detail['id'], $detail);
			$arr['params_ext'] = $this->$modul_code->params_ext($detail);


			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			// cekpost();
			$debuger = array();
			$params = array();

			//boleh gak?
			$task_category_priv  = $this->input->post('task_category');
			if(!$this->request->allow_update($task_category_priv, $detail['author'])):
				$arr_msg['status'] = 'failed';
				$arr_msg['msg'] = 'Anda tidak mempunyai hak akses';
				echo json_encode($arr_msg);
				exit;
			endif;
			//boleh gak?

			if($detail['flock']=='y'):
				$arr_msg['status'] = 'failed';
				$arr_msg['msg'] = 'Data sudah terkunci, tidak bisa diupdate';
				echo json_encode($arr_msg);
				exit;
			endif;


			$params['body'] = $_POST['body_fake'];

			// if(!$this->input->post('escape_main_task')):
			$main_task_update_result = $this->crud->update('task', $params, array('id'));
			$debuger['main_task_update_result'] = $main_task_update_result;
			// endif;

			if($this->input->post('attachment')):
				$attachment_index = $this->input->post('attachment_index');

				if (!$attachment_index):
					$attachments = $this->input->post('attachment');
				else:
					// multiple file input
					$attachments = array();

					foreach ($attachment_index as $key => $value) {
						$attachment = "attachment_".$value;
						$upload = upload_file($attachment, UPLOAD_PATH);

						if (isset($upload['file_name'])):
							array_push($attachments, $upload['file_name']);
						endif;
					}
				endif;

				$this->attachment->insert('task', $this->input->post('id'), $attachments); // MY_Controller -> Model_attachment
			endif;

			if($this->input->post('user_assigned')):
				$this->user_assign->save_pld($this->input->post('id'), $this->input->post('user_assigned'));
			endif;

			//task ext
			$this->$modul_code->task_ext($this->input->post('id'));

			//global hook
			$hook_res = $this->$modul_code->hook($this->input->post('id'), 'update');

			$debuger['hook_res'] = $hook_res;
			$debuger['post'] = $_POST;

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = 'Data behasil disimpan';
			$arr_msg['debuger'] = $debuger;
			echo json_encode($arr_msg);
		endif;
	}

	public function data($req_code='', $filter='')
	{
		// pre($req_code);
		$this->request_model_loader($req_code);
		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		$this->$req_code->data($modul, $filter);
	}

	//untuk report disini
	public function data_report($req_code='', $filter='')
	{
		// pre($req_code);
		$this->request_model_loader($req_code);
		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		$this->$req_code->data($modul, $filter, 'report');
	}
	//untuk report disini


	public function data_task_ts($req_code='', $status='', $filter='')
	{
		// pre($req_code);
		$this->request_model_loader($req_code);
		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		$this->$req_code->data($modul, $status, $filter);
	}

	public function dt($req_code='', $status='', $filter='')
	{
		// pre($req_code);
		// pre($status);
		// pre($filter);
		$this->request_model_loader($req_code);
		$modul = $this->request->info_modul($req_code);
		// pre($modul);
		$this->$req_code->data($modul, $status, $filter);
	}

	function focus($marketing_progress_id)
	{
		$detail = $this->task->detail($marketing_progress_id);
		$info_customer = $this->customer->detail_customer($detail['id']);
		$info_category = $this->master->master_by_code('marketing_progress_category', $detail['category']);
		$attachments = $this->attachment->get('task', $detail['id']);
		$detail['customer_name'] = $info_customer['customer_name'];
		$detail['mp_category'] = $info_category['name'];
		$detail['attachments'] = $attachments;
		$data = array();
		$data['detail'] = $detail;
		$content = $this->load->view('marketing_progress/focus', $data, TRUE);

		$arr = array();
		$arr['modal_title'] = $this->lang->line('marketing_progress_focus_title');
		$arr['modal_icon'] = $this->theme->icon('marketing_progress');
		$arr['modal_size'] = 'modal-lg';
		$arr['modal_content'] = $content;
		echo json_encode($arr);
	}

	function sample_serial()
	{
		$this->load->model('model_ticket','ticket');
		$arr = array('category'	=> 'pre_survey');
		$serial = filter_serialthis($arr);
		$unserial = un_filter_serialthis($serial);
		echo $serial;
		echo '<br>';
		pre($unserial);
		// $data = $this->ticket->data($serial);
		// pre($data);
	}

}

/* End of file marketing_progress.php */
/* Location: ./application/controllers/marketing_progress.php */
