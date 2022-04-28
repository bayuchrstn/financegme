<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->lang->load('task');
		$this->load->model('model_task', 'task');
		$this->load->model('model_task_teknis', 'task_teknis');
		$this->active_root_menu = $this->lang->line('task_alltitle');
		$this->browser_title = $this->lang->line('task_alltitle');
		$this->modul_name = $this->lang->line('task_alltitle');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function forme()
	{
		echo 'ascasc';
	}

	public function index($filter='')
	{
		if($filter==''):
			// pre('gak ada filter');
		endif;

		$this->breadcrumb = array(
			'Home' => base_url(),
			$this->lang->line('task_panel_title') => '#'
		);
		$data = array();
		$data['filter'] = $filter;

		$this->js_inject .= $this->load->view('task/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('task/js', $data, TRUE);
		$this->js_inject .= $this->load->view('task/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');

		$data['update_view'] = $this->load->view('task/update', $data, TRUE);
		$data['insert_view'] = $this->load->view('task/insert', $data, TRUE);
		$data['delete_view'] = $this->load->view('task/delete', $data, TRUE);

		$konten = $this->load->view('task/index', $data, TRUE);
		$this->admin_view($konten);

	}

	public function get_category($id)
	{
		ajax_only();
		$data = $this->task->arr_category($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$options = array();
		$options['server_side_validation'] = 'task_insert';
		$options['table'] = 'task';
		$options['data'] = array(
				'task_name'	=> ($this->input->post('task_name')) ? htmlspecialchars($this->input->post('task_name')) : '',
				'code_name'		=> ($this->input->post('task_code')) ? htmlspecialchars($this->input->post('task_code')) : '',
				'category_id'			=> $this->input->post('task_category'),
				'brand'		=> $this->input->post('task_brand'),
				'jumlah'			=> $this->input->post('task_jumlah')!='' ? $this->input->post('task_jumlah') : '0',
				'input_date'		=> date('Y-m-d H:i:s')
			);
		$options['msg_success'] = $this->lang->line('task_success_insert');
		$options['msg_failed'] = $this->lang->line('task_failed_insert');
		// echo json_encode($options);
		$this->frame->insert($options);
	}

	public function update($id='')
	{
		valid_action('task');
		ajax_only();
		if(!$this->form_validation->run('task_update')):
			$detail = $this->task->detail($id);
			$arr = array();
			$arr['arr_category'] = $this->task->arr_category($detail['brand']);
			$arr['action'] = base_url().'task/update/'.$detail['id'];
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		else:
			// cekpost();
			$arr_msg = array();
			$data = array(
					'task_name'	=> ($this->input->post('task_name')) ? htmlspecialchars($this->input->post('task_name')) : '',
					'code_name'		=> ($this->input->post('task_code')) ? htmlspecialchars($this->input->post('task_code')) : '',
					'category_id'			=> $this->input->post('task_category'),
					'brand'		=> $this->input->post('task_brand'),
					'jumlah'			=> $this->input->post('task_jumlah')!='' ? $this->input->post('task_jumlah') : '0'
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('task', $data);

			$arr_msg['status'] = 'success';
			$arr_msg['msg'] = $this->lang->line('task_success_update');
			echo json_encode($arr_msg);
		endif;
	}


	public function delete($id='')
	{
		$detail = $this->task->detail($id);
		if($this->form_validation->run('task_delete')):
			$arr_msg = array();
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('task');
			$arr_msg['status'] = 'sukses';
			$arr_msg['detail'] = $detail;
			$arr_msg['msg'] = $detail['task_name'].' '.$this->lang->line('dialog_delete_success');
			$arr_msg['post'] = $_POST;
			echo json_encode($arr_msg);
		else:
			ajax_only();
			$arr = array();
			$arr['action'] = base_url().'task/delete/'.$detail['id'];
			$related = $this->related->task($detail['id']);
			$arr['data_info'] = $this->data_info($detail);
			$arr['removable'] = (!$related) ? 'yes' : 'no';
			$arr['remove_confirm'] = (!$related) ? $this->lang->line('dialog_confirm_delete') : $this->lang->line('dialog_no_delete');
			if(!empty($detail)):
				foreach($detail as $field=>$val):
					$arr[$field] = $val;
				endforeach;
			endif;
			// pre($arr);
			echo json_encode($arr);
		endif;
	}

	function data_info($detail)
	{
		$data = array();
		$data['label_width'] = '100';
		$data['sparator_width'] = '10';
		$data['info'] = array(
				'Nama task'		=> $detail['task_name'],
				'Kode'			=> $detail['code_name']
				// 'Email'		=> $detail['email'],
			);
		$opt = $this->ui->load_template('table_data_info', $data);
		return $opt;
	}

	public function data($code, $filter='')
	{
		$filter = array();

		switch ($code) {
			case 'request':
				$filter[] = array('task.status', '=', 'request');
			break;

			case 'dijadwalkan':
				$filter[] = array('task.status', '=', 'dijadwalkan');
			break;

			case 'selesai':
				$filter[] = array('task.status', '=', 'selesai');
			break;

			default:
				# code...
				break;
		}

		$task = $this->task->data('pekerjaan_teknis', $filter);
		echo $this->task_teknis->build_json($task);
	}

	// build data for report
	public function data_report($task_category, $category='survey', $status='request')
	{
		$filter=array();
		$filter[] = array('task.status', '=', $status);
		$filter[] = array('task.category', '=', $category);

		// param ini dikirim otomatis oleh Jquery datatables
		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $this->input->post('order')[0]['column'];
	    $orderBy = $this->input->post('columns')[$orderByColumnIndex]['data'];
	    $orderType = $this->input->post('order')[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// EDIT DISINI
		$recordsTotal = $this->task->total_record($task_category, $filter);

		//jika ada pencarion
		if( $this->input->post('search')['value'] ):
			$query = $this->searching_data($task_category, $orderBy, $orderType, $length, $start, $filter);
			$recordsFiltered = $this->total_searching_data($task_category, $filter);
		//bukan pencarian
		else:
			$query = $this->task->all_data($task_category, $start, $length, $filter);
			$recordsFiltered = $recordsTotal;
		endif;

		$task = array();
		$data = $query->result_array();
		$task['data'] = $data;
		$task['draw'] = intval($draw);
		$task['recordsTotal'] = $recordsTotal;
		$task['recordsFiltered'] = $recordsFiltered;
		$task['draw'] = intval($draw);
		// pre($res);

		$formated_data = array();
		if(!empty($task['data'])):
			foreach($task['data'] as $row):
				// pre($row);

				//location_id
				$location = $this->task->location($row['location'], $row['location_id']);
				// pre($location);

				//focus marketing progress
				$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//action form
				$button['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_laporan_harian(\''.$row['id'].'\');" class="edit_button" ');
				$button['detail'] = array('label'=>$this->lang->line('all_detail'), 'url'=>'javascript:void(0);', 'icon'=>'icon-enter', 'more'=>'onclick="detail_laporan_harian(\''.$row['id'].'\');" class="edit_button" ');
				$action = $this->actionform->dropdown($button);

				$formated_data[] = array(
					'id'									=> '1',
					'date'									=> format_date($row['date_created']),
					'date_start'							=> format_date($row['date_start']),
					'date_due'								=> format_date($row['date_due']),
					'subject'								=> $subject,
					'author'								=> clean_string($row['author_name'], 40),
					'location'								=> clean_string($location, 40),
					// 'action'								=> $action,
				);
			endforeach;
		endif;
		// pre($formated_data); exit;

		$response = array(
			"draw" 				=> $task['draw'],
			"recordsTotal" 		=> $task['recordsTotal'],
			"recordsFiltered" 	=> $task['recordsFiltered'],
			"data" 				=> $formated_data
		);
		// pre($response);
		echo json_encode($response);
	}

	function get()
	{
		$fields = $this->task->get_fields(); // model_task

		$data = array_filter(from_array_camel_key($this->input->post()), function($val, $key) use($fields) {
			return in_array($key, $fields) && !empty($val);
		}, ARRAY_FILTER_USE_BOTH);

		$tasks = $this->task->get_by($data)->result(); // model_task

		header("Content-type: application/json");
		echo json_encode($tasks);
	}

}

/* End of file task.php */
/* Location: ./application/controllers/task.php */
