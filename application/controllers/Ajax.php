<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
	}

	function request()
	{
		echo rand();
	}

	function up_selected($id='')
	{
		$this->load->model('Model_request', 'request');
		$data_up = $this->request->detail($id);
		echo json_encode($data_up);
	}

	function cart_item_out($cart_div='')
	{
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		$data['random'] = rand();
		$data['cart_div'] = $cart_div;
		$data['cart'] = $this->cart->contents();
		echo $this->load->view('request/request_out/cart_item_out', $data, TRUE);
	}

	function built_cart_form($item_id)
	{
		$arr = array();
		$this->db->where('id', $item_id);
		$arr = $this->db->get('item')->row_array();
		echo json_encode($arr);
	}

	function up_request_forms($id, $mode='location')
	{
		$forms = '';
		$this->db->where('id', $id);
		$data = $this->db->get('task')->row_array();
		switch ($mode) {
			// case '':
			// break;

			default:
				$forms .= '<input type="hidden" name="location" value="'.$data['location'].'">';
				$forms .= '<input type="hidden" name="location_id" value="'.$data['location_id'].'">';
			break;
		}
		echo $forms;
	}

	function location_dismatle_info($task_id)
	{
		$arr = array();
		$this->load->model('Model_bcn', 'bcn');
		$this->load->model('Model_request', 'request');
		$this->load->model('Model_location', 'location');
		$this->load->model('Model_item_transaction', 'item_transaction');
		$this->load->model('Model_item_detail', 'item_detail');
		$data = array();
		$data['task_id'] = $task_id;
		$detail = $this->request->detail($task_id);
		$data['parent_detail'] = $detail;
		$location_name = $this->location->show($detail['location'], $detail['location_id']);
		$list_item_terpasang = $this->item_transaction->list_item_terpasang($detail['location'], $detail['location_id']);
		$item_terpasang = $this->item_transaction->item_terpasang($detail['location'], $detail['location_id']);
		$options = '';
		// pre($data);
		if(!empty($item_terpasang)):
			foreach($item_terpasang as $row):
				$options .= '<option value="'.$row['item_id'].'">'.$row['brand_name'].'  ---  '.$row['category_name'].'  ---  '.$row['item_name'].'</option>';
			endforeach;
		endif;

		$arr['item_transaction'] = $options;
		// $arr['carts'] =  $this->load->view('request/request_in/location_dismatle_info', $data, TRUE);
		$arr['parent_detail'] =  $detail;
		$arr['location_name'] =  $location_name;
		echo json_encode($arr);
	}

	function location_replace_info($task_id)
	{
		$arr = array();

		$this->load->model('Model_request', 'request');
		$this->load->model('Model_location', 'location');

		$detail = $this->request->detail($task_id);

		$location_name = $this->location->show($detail['location'], $detail['location_id']);

		$arr['parent_detail'] =  $detail;
		$arr['location_name'] =  $location_name;
		// pre($arr);
		echo json_encode($arr);
	}

	function cart_item_in()
	{
		$data = array();
		echo $this->load->view('request/request_in/cart_item_in', $data, TRUE);
	}

	function item_out($task_id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$this->db->where('task_id', $task_id);
		$data['current_item_out'] = $this->db->get('task_item_out')->result_array();
		echo $this->load->view('request/request_out/current_item', $data, TRUE);
	}

	function item_out_approval($task_id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$this->load->model('Model_request', 'request');

		$detail = $this->request->detail($task_id);

		$this->db->where('task_id', $task_id);
		$data['current_item_out'] = $this->db->get('task_item_out')->result_array();

		$data['task_id'] = $task_id;
		$data['detail'] = $detail;
		echo $this->load->view('request/barang_keluar/current_item', $data, TRUE);
	}

	function item_in_approval($task_id)
	{
		$this->load->model('Model_bcn', 'bcn');

		$this->db->where('task_id', $task_id);
		$data['current_item_in'] = $this->db->get('task_item_in')->result_array();
		// pre($this->db->last_query());

		$data['task_id'] = $task_id;
		echo $this->load->view('request/barang_masuk/current_item', $data, TRUE);
	}

	function item_replace_approval($task_id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$this->load->model('request/Model_barang_replace', 'barang_replace');
		$data['task_id'] = $task_id;
		$data['current_item_in'] = $this->barang_replace->get_approval_in($task_id);
		$data['current_item_out'] = $this->barang_replace->get_approval_out($task_id);
		echo $this->load->view('request/barang_replace/replace_in_out', $data, TRUE);
	}

	function item_detail_select_picker($id)
	{
		$this->load->model('Model_bcn', 'bcn');

		$this->db->where('id', $id);
		$detail = $this->db->get('task_item_out')->row_array();

		$arr = array();
		$arr['title'] = $this->bcn->item_info($detail['item_id'], 'default');
		$arr['current_approved_item_detail'] = ($detail['item_detail_id'] !='') ? $detail['item_detail_id'] : '';

		$options = '';
		$item_detail_data = $this->db->query("SELECT id, nomor_barang, mac_address FROM {PRE}item_detail WHERE item_id='".$detail['item_id']."' AND item_status='available' ")->result_array();
		$where_item_detail = array(
			'item_id'	=> $detail['item_id'],
			'item_status'	=> 'available',
			'regional'	=> session_scope_regional(),
			'area'	=> session_scope_area()
		);
		$item_detail_data = $this->db->select('id, nomor_barang, mac_address')->where($where_item_detail)->get('item_detail')->result_array();
		$query_item_detail = $this->db->last_query();
		if(!empty($item_detail_data)):
			foreach($item_detail_data as $items):
				$mac = ($items['mac_address'] !='') ? ' - '.$items['mac_address'] : '';
				$det = $items['nomor_barang'].$mac;
				$options .= '<option value="'.$items['id'].'">'.$det.'</option>';
			endforeach;
		endif;

		$arr['options'] = $options;
		$arr['item'] = $id;
		$arr['task_id'] = $detail['task_id'];
		$arr['item_id'] = $detail['item_id'];
		$arr['query_item_detail'] = $query_item_detail;
		echo json_encode($arr);
	}

	function save_item_out()
	{
		$this->load->model('Model_item_transaction', 'item_transaction');
		$this->load->model('Model_bcn', 'bcn');
		$arr = array();
		if($this->input->post('item_detail_picker') && $this->input->post('item_out_id')):

			// $current_edited = $this->db->query("SELECT * FROM {PRE}task_item_out WHERE id='".$this->input->post('item_out_id')."'")->row_array();

			$data = array(
					'status'			=> 'approved',
					'approved_by'		=> my_id(),
					'approved_date'		=> now(),
					'item_detail_id'	=> $this->input->post('item_detail_picker')
				);
			$this->db->where('id', $this->input->post('item_out_id'));
			$approved = $this->db->update('task_item_out', $data);
			if($approved):
				//update status pada table master
				//masih belum fix ini nantinya statusnya
				//kemungkinan anti ada status global lock untuk item perangkat
				$this->item_transaction->set_status($data['item_detail_id'], 'master', 'approved_out');

				//jika aproval ingi diganti / diulang makasa status yang lama di available lg
				if($this->input->post('current_approved_item_detail') !=''):
					$this->item_transaction->set_status($this->input->post('current_approved_item_detail'), 'master', 'available');
				endif;

				//generate info barang dipasang
				$arr['barang_dikeluarkan'] = $this->bcn->item_detail_info($data['item_detail_id'], 'nomor_mac');

				//data di lock by item_id
				$task_id =$this->input->post('task_id');
				$item_id =$this->input->post('item_id');
				$this->db->query("UPDATE {PRE}task_item_out SET flock='y' WHERE task_id='".$task_id."' AND item_id='".$item_id."'");
			endif;
			// $arr['query'] = $this->db->last_query();
		endif;
		$arr['post'] = $_POST;
		$arr['row'] = $this->input->post('data_row');
		$arr['task_id'] = $task_id;
		echo json_encode($arr);
	}

	function item_in($task_id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$this->db->where('task_id', $task_id);
		$data['current_item_out'] = $this->db->get('task_item_in')->result_array();
		echo $this->load->view('request/request_in/current_item', $data, TRUE);
	}

	function item_detail_info($id)
	{
		$arr = array();
		$this->load->model('Model_item_transaction', 'item_transaction');
		$data = $this->item_transaction->item_detail_info($id);
		if(!empty($data)):
			$arr['bcn'] = $opt = $data['brand_name'].' / '.$data['cat_name'].' / '.$data['item_name'];
			foreach($data as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
		// pre($data);
		echo json_encode($arr);
	}

	function update_current_item_out()
	{
		$arr = array();
		$arr['post'] = $_POST;
		$data = array(
				'owner_status'	=> $this->input->post('status'),
				// 'qty'			=> $this->input->post('qty'),
			);
		$this->db->where('id', $this->input->post('id'));
		$res_update = $this->db->update('task_item_out', $data);
		$arr['res_update'] = $res_update;
		echo json_encode($arr);
	}

	function create_report($task_id='')
	{
		$this->load->model('model_request', 'request');
		$this->load->model('model_customer', 'customer');
		$this->load->model('request/model_task_teknis', 'task_teknis');
		$this->load->model('model_location', 'location');

		$this->lang->load('request/task_report');

		// pre($task_id);
		$task_detail = $this->request->detail($task_id);
		$report_detail = $this->request->get_task_report($task_id);
		// pre($task_detail['category']);

		if(!$this->form_validation->run('sender')):

			$data = array();
			$data['task_detail'] = $task_detail;
			$data['report_detail'] = $report_detail;
			switch ($task_detail['category']) {

				default:
					$form_laporan = $task_detail['category'];
				break;
			}
			echo $this->load->view('request/my_task/report_form/'.$form_laporan, $data, TRUE);

		else:
			$arr = array();
			$arr['post'] = $_POST;

			//difilter dulu
			$filter = $this->request->filter_boleh_laporan();
			if($filter['allow_report']=='0'):
				$arr['status'] = 'failed';
				$arr['msg'] = $filter['msg'];
				echo json_encode($arr);
				exit;
			endif;

			//update status task
			$status = $this->input->post('status_pekerjaan');
			$task_id = $this->input->post('id');
			$query = "UPDATE {PRE}task SET status='".$status."' WHERE id='".$task_id."'";
			$this->db->query($query);

			$cek = $this->db->query("SELECT * FROM {PRE}task WHERE up='".$task_id."' and task_category='task_teknis_report' ")->result_array();

			//membuat laporan
			$params = array();
			$params['task_category'] = 'task_teknis_report';
			$params['author'] = my_id();
			$params['date_created'] = now();
			$params['date_start'] = ($this->input->post('date_start')) ? $this->input->post('date_start') : now();
			$params['regional'] = session_scope_regional();
			$params['area'] = session_scope_area();
			$params['subject'] = '';
			$params['body'] = $_POST['body_fake'];
			$params['flock'] = 'n';
			$params['up'] = $task_id;

			if(empty($cek)):
				$insert_result = $this->crud->insert('task', $params, array('id'));

				//task extends
				$ext = array();
				$this->request->task_ext($insert_result['last_id'], 'task_report', $ext);

				if($this->input->post('attachment')):
					$this->attachment->insert('task', $insert_result['last_id'], $this->input->post('attachment'));
				endif;

			else:
				$id_report = $this->input->post('id_report');
				$this->db->query("UPDATE {PRE}task SET body='".$_POST['body_fake']."' WHERE id='".$id_report."' and task_category='task_teknis_report' ");

				//task extends
				$ext = array();
				$this->request->task_ext($id_report, 'task_report', $ext);

				//attachment
				if($this->input->post('attachment')):
					$this->attachment->insert('task', $id_report, $this->input->post('attachment'));
				endif;

			endif;
			$arr['status'] = 'success';
			$arr['msg'] = 'sukses';
			echo json_encode($arr);
		endif;
	}

	function task_report_form($task_id)
	{
		$this->load->model('model_request', 'request');
		$this->load->model('model_customer', 'customer');
		$this->load->model('request/model_task_teknis', 'task_teknis');
		$this->load->model('model_location', 'location');

		if(!$this->form_validation->run('task_report_form')):
			$task_detail = $this->request->detail($task_id);

			$arr = array();
			$arr['task_detail'] = $task_detail;

			$data = array();
			$data['task_detail'] = $task_detail;

			if($task_detail['location']=='pre_customer' || $task_detail['location']=='customer'):
				$data['jenis_form'] = $this->customer->get_jenis_link($task_detail['location_id']);
			else:
				$data['jenis_form'] = 'default';
			endif;

			$arr['customer_detail'] = $this->load->view('customer/show/detail', $this->customer->show($task_detail['location_id'], 'detail'), TRUE);

			//installasi
			if($task_detail['category']=='installasi'):
				$arr['daftar_barang_keluar'] = $this->load->view('request/request_out/item_out_report', $data, TRUE);
			endif;

			$detail_x = $this->task_teknis->detail($task_id);
			$task_ext_x = $this->task_teknis->get_task_ext($detail_x['id']);
			$data_task_info['detail'] = $detail_x;
			$data_task_info['task_ext'] = $task_ext_x;

			$arr['task_detail'] = $this->load->view('request/task_teknis/show', $data_task_info, TRUE);

			switch ($task_detail['category']) {
				case 'dismantle':
					$arr['form'] = $this->load->view('request/my_task/report_form/dismantle', $data, TRUE);
				break;

				case 'installasi':
					$arr['form'] = $this->load->view('request/my_task/report_form/installasi', $data, TRUE);
				break;

				case 'replace':
					$arr['form'] = $this->load->view('request/my_task/report_form/replace', $data, TRUE);
				break;

				case 'installasi_new':
					$arr['form'] = $this->load->view('request/my_task/report_form/installasi_new', $data, TRUE);
				break;

				//survey
				default:
					$arr['form'] = $this->load->view('request/my_task/report_form/survey', $data, TRUE);
				break;
			}

			echo json_encode($arr);
		else:
			cekpost();
		endif;
	}

	function marketing_request_tasking()
	{
		$arr = array();
		$this->load->model('model_location', 'location');
		$this->load->model('model_user_assign', 'user_assign');
		//
        // $check = $this->check_request_survey_ts($task_id);
        // if(empty($check)):

			$post_param = $this->input->post('parent');

            $data = array(
                'up' => $post_param['up'],
                'task_category' => 'task_teknis',
                'category' => ($post_param['category']=='survey') ? 'survey' : 'installasi',
                'author' => my_id(),
                'date_created' => now(),
                'status' => 'progress',
                'date_start' => $this->input->post('date_start'),
                'date_due' => $this->input->post('date_due'),
                'subject' => $this->input->post('subject'),
                'body' => $this->input->post('body_fake'),
                'regional' => $post_param['regional'],
                'area' => $post_param['area'],
                'location' => $post_param['location'],
                'location_id' => $post_param['location_id'],
            );
            $this->db->insert('task', $data);
			$last_id = $this->db->insert_id();
			// $arr['query_insert_survey_ts'] = $this->db->last_query();
			// $params = array();
			// $this->request->task_ext($this->db->insert_id(), 'task_marketing_request', $params);
			// endif;
			$this->user_assign->save($last_id, $this->input->post('user_assigned'));

		$arr['post'] = $_POST;
		$arr['ch'] = $data;
		echo json_encode($arr);
	}

	function item_out_editor($id)
	{
		$this->load->model('Model_bcn', 'bcn');
		if(!$this->input->post('status_kepemilikan')):
			$arr = array();
			$this->db->where('id', $id);
			$arr['detail'] = $this->db->get('task_item_out')->row_array();
			$arr['action'] = base_url().'ajax/item_out_editor/'.$id;
			$arr['title'] = $this->bcn->item_info($arr['detail']['item_id'], 'default');
			// pre($arr);
			echo json_encode($arr);
		else:
			$arr = array();
			$arr['post'] = $_POST;
			echo json_encode($arr);
		endif;
	}

	function cart_boq()
	{
		$data = array();
		echo $this->load->view('request/boq/cart', $data, TRUE);
	}

	function json_task_info($task_id='')
	{
		$arr = array();
		$this->db->where('id', $task_id);
		$data = $this->db->get('task')->row_array();
		if($data):
			foreach($data as $key=>$val):
				$arr[$key] = $val;
			endforeach;
			$arr['za'] = $this->db->last_query();
		endif;
		// pre($arr);
		echo json_encode($arr);
	}

	function boq_view_lap_survey()
	{
		echo $this->load->view('request/boq/boq_view_lap_survey', '', TRUE);
	}

	function save_barang_keluar()
	{
		$arr = array();

		$data = array(
			'status'	=> $this->input->post('status')
		);

		if($this->input->post('status')=='approved'):
			$data['flock'] = 'y';
		else:
			$data['flock'] = 'n';
		endif;

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('task', $data);

		$params_item_transaction = array();

		$arr['post'] = $_POST;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	function save_barang_masuk()
	{
		$arr = array();
		$this->load->model('request/Model_barang_masuk', 'barang_masuk');
		$boleh_approval = $this->barang_masuk->boleh_approve($this->input->post('id'));
		if($boleh_approval):

			//update status task
			$data = array(
					'status'	=> $this->input->post('status'),
					'flock'		=> ($this->input->post('status')=='approved') ? 'y' : 'n'
				);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('task', $data);

			$arr['status'] = 'success';
			$arr['msg'] = 'Data berhasil disimpan';
		else:
			$arr['status'] = 'failed';
			$arr['msg'] = 'Approval gagal, barang masuk belum diterima semua';
		endif;

		echo json_encode($arr);
	}

	function save_barang_replace()
	{
		$arr = array();
		$this->load->model('request/Model_barang_replace', 'barang_replace');
		$barang_masuk_approve = $this->barang_replace->barang_masuk_approve($this->input->post('id'));
		$barang_keluar_approve = $this->barang_replace->barang_keluar_approve($this->input->post('id'));

		if(!$barang_masuk_approve):
			$arr['status'] = 'failed';
			$arr['msg'] = 'Barang kembali ada yg belum di approve';
			echo json_encode($arr);
			exit;
		endif;

		if(!$barang_keluar_approve):
			$arr['status'] = 'failed';
			$arr['msg'] = 'Barang keluar ada yg belum di approve';
			echo json_encode($arr);
			exit;
		endif;

		$data = array(
				'status'	=> $this->input->post('status'),
				'flock'		=> ($this->input->post('status')=='approved') ? 'y' : 'n'
			);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('task', $data);
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';

		$arr['post'] = $_POST;
		$arr['barang_masuk_approve'] = $barang_masuk_approve;
		$arr['barang_keluar_approve'] = $barang_keluar_approve;
		echo json_encode($arr);
	}

	function info_refe($task_id)
	{
		$this->load->model('model_request', 'request');
		$this->db->where('id', $task_id);
		$this->db->select('task.task_category as task_category');
		$task = $this->db->get('task')->row_array();
		$modul = $this->request->info_modul($task['task_category']);
		// pre($modul);
		echo json_encode($modul);
	}

	function check_session()
	{
		$limit = 43200; //every 12 hours
		$now = time();

		$this->db->select('id, ip_address, timestamp');
		$this->db->where('timestamp <', $now-$limit)
			->order_by('timestamp','desc');
		$query = $this->db->get('sessions', 100, 0);
		$data = $query->result_array();
		echo json_encode($data);
		// echo date('Y-m-d H:i:s','1537781584');
	}

	function cron_remove_session()
	{
		$limit = 43200; //interval 12 hours
		$now = time();

		$this->db->where('timestamp <', $now-$limit);
		$this->db->delete('sessions');
		// echo $now-$limit;
	}

	function get_task_comment($task_id)
	{
		$arr = array();
		$this->load->model('Model_task', 'm_task');
		$upper_id = $this->m_task->get_upper_task($task_id);
		$data = $this->m_task->get_task_child($upper_id);
		$related_id = $this->m_task->get_related_task_id($data);
		$arr_related_id = explode(',', $related_id);
		$arr_related_id_new = array();
		foreach ($arr_related_id as $value) {
			if ($value!='') {
				$arr_related_id_new[] = $value;
			}
		}

		$task_comment = $this->m_task->get_task_comment($arr_related_id_new);
		$arr['data'] = $task_comment;
		echo json_encode($arr);
	}

	function get_task_related_user($task_id)
	{
		$arr = array();
		$this->load->model('Model_task', 'm_task');
		$upper_id = $this->m_task->get_upper_task($task_id);
		$data = $this->m_task->get_task_child($upper_id);
		$related_id = $this->m_task->get_related_task_id($data);
		$arr_related_id = explode(',', $related_id);
		$arr_related_id_new = array();
		foreach ($arr_related_id as $value) {
			if ($value!='') {
				$arr_related_id_new[] = $value;
			}
		}

		$user_list = $this->m_task->get_related_user_task($arr_related_id_new);
		$arr['data'] = $user_list;
		// echo json_encode($arr);
		print_r($arr); exit;
	}

}
