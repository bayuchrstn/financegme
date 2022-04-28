<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_request extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
	}

	function index()
	{
		echo 'ajax request';
	}

	function penerimaan_barang_masuk($id='')
	{
		$this->load->model('request/Model_barang_masuk', 'barang_masuk');
		$this->load->model('Model_item_transaction', 'item_transaction');
		$arr = array();

		$detail = $this->barang_masuk->detail_item_masuk($id);
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			echo $this->load->view('request/barang_masuk/penerimaan_barang_masuk', $data, TRUE);
		else:
			$arr['post']  = $_POST;
			$task_id = $this->input->post('task_id');
			$id_item_detail = $this->input->post('id_item_detail');

			$cek = $this->db->query("SELECT * FROM {PRE}return_item WHERE task_id='".$task_id."' AND id_item_detail='".$id_item_detail."' ")->result_array();

			if($this->input->post('status') =='diterima'):
				if(empty($cek)):
					$data = array(
							'task_id'			=> $this->input->post('task_id'),
							'transaction_id'	=> $this->input->post('transaction_id'),
							'id_item_detail'	=> $this->input->post('id_item_detail'),
							'id_user_approve'	=> my_id(),
							'date_approve'		=> $this->input->post('date_approve'),
							'return_status'		=> $this->input->post('return_status'),
							'note'				=> $this->input->post('note'),
							'status'			=> '',
						);
					// pre($data);
					$arr['data'] = $data;
					$this->db->insert('return_item', $data);
				else:
					$data = array(
							'id_user_approve'	=> my_id(),
							'date_approve'		=> $this->input->post('date_approve'),
							'return_status'		=> $this->input->post('return_status'),
							'note'				=> $this->input->post('note'),
							'status'			=> '',
						);
						$this->db->where('task_id', $task_id);
						$this->db->where('id_item_detail', $id_item_detail);
						$this->db->update('return_item', $data);
				endif;
			endif;

			$id_task_ri = $this->input->post('id_task_ri');
			$flock = ($this->input->post('status')=='diterima') ? 'y' : 'n';
			$this->db->query("UPDATE {PRE}task_item_in SET status='".$this->input->post('status')."', flock='".$flock."', approved_by='".my_id()."', approved_date='".now()."' WHERE id='".$id_task_ri."' ");

			$this->item_transaction->approve_request_in($this->input->post('transaction_id'), $this->input->post('id_item_detail'));

			$arr['task_id'] = $task_id;
			echo json_encode($arr);
		endif;
	}

	function create_cart_pengadaan()
	{
		$arr = array();
		$this->lang->load('cart');

		$foptions = $this->input->post('options');

		if($foptions['type']=='pembanding'):
			$suffix = '_pembanding';
		else:
			$suffix = '';
		endif;
		$cart_name = $this->input->post('item_name');

		// -----------------------------------------------------
		$data = array(
			'id'      => ($this->input->post('item_selector')=='barang') ? $cart_name.$suffix : strtolower(url_title($this->input->post('item_id_custom'))),
			'qty'     => paranoid($this->input->post('qty')),
			'price'   => paranoid($this->input->post('price')),
			'name'    => ($this->input->post('item_selector')=='barang') ? $cart_name.$suffix : $this->input->post('item_id_custom'),
		);

		if($this->input->post('options')):
			foreach($this->input->post('options') as $key=>$val):
				$data['options'][$key] = $val;
			endforeach;
			$data['options']['supplier'] = $this->input->post('supplier');
			$data['options']['mode'] = $this->input->post('item_selector');
		endif;
		$this->cart->product_name_rules = '[:print:]';
		$cart_result = $this->cart->insert($data);
		// -----------------------------------------------------

		$arr['post'] = $_POST;
		$arr['data'] = $data;
		// $arr['foptions'] = $foptions['type'];
		$arr['suffix'] = $suffix;
		$arr['prefix'] = $this->input->post('prefix');
		$arr['cart_result'] = $cart_result;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	function create_cart_boq()
	{
		$arr = array();
		$this->lang->load('cart');

		$foptions = $this->input->post('options');

		$suffix = '';
		$cart_name = $this->input->post('item_name');

		// -----------------------------------------------------
		$data = array(
			'id'      => ($this->input->post('item_selector')=='barang') ? $cart_name.$suffix : strtolower(url_title($this->input->post('item_id_custom'))),
			'qty'     => paranoid($this->input->post('qty')),
			// 'price'   => paranoid($this->input->post('price')),
			'price'   => '0',
			'name'    => ($this->input->post('item_selector')=='barang') ? $cart_name.$suffix : $this->input->post('item_id_custom'),
		);

		if($this->input->post('options')):
			foreach($this->input->post('options') as $key=>$val):
				$data['options'][$key] = $val;
			endforeach;
		endif;
		$data['options']['supplier'] = '';
		$data['options']['mode'] = $this->input->post('item_selector');
		$this->cart->product_name_rules = '[:print:]';
		$cart_result = $this->cart->insert($data);
		// -----------------------------------------------------

		$arr['post'] = $_POST;
		$arr['data'] = $data;
		// $arr['foptions'] = $foptions['type'];
		$arr['suffix'] = $suffix;
		$arr['prefix'] = $this->input->post('prefix');
		$arr['cart_result'] = $cart_result;
		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	function loadcart($what='', $prefix='')
	{
		$data = array();
		$this->load->model('Model_supplier', 'supplier');
		$this->load->model('Model_bcn', 'bcn');
		$data['carts'] = $this->cart->contents();
		$data['prefix'] = $prefix;

		switch ($what) {
			//pembanding
			case 'pembanding':
				echo $this->load->view('request/pengajuan_barang/cart/cart_pembanding', $data, TRUE);
			break;

			//boq
			case 'boq':
				echo $this->load->view('request/boq/cart/cart_boq', $data, TRUE);
			break;

			//pengadaan
			default:
				echo $this->load->view('request/pengajuan_barang/cart/cart_pegadaan', $data, TRUE);
			break;
		}
	}

	function update_cart($what='', $rowid='', $prefix='')
	{
		$data = array();

		$data['carts'] = $this->cart->contents();
		$data['rowid'] = $rowid;
		$data['prefix_mode'] = $prefix;
		switch ($what) {

			//boq
			case 'boq':
				echo $this->load->view('request/boq/cart/form_edit_cart', $data, TRUE);
			break;

			//ts request replace in
			case 'request_replace_in':
				$this->load->model('Model_request', 'request');
				$data['cart_detail'] = $data['carts'][$rowid];
				$this->db->where('id', $data['cart_detail']['options']['item']);
				$data['item_detail'] = $this->db->get('item')->row_array();
				$data['parent_task_detail'] = $this->request->detail($data['cart_detail']['options']['task_parent']);
				echo $this->load->view('request/request_replace/cart/form_edit_in', $data, TRUE);
			break;

			//ts request replace out
			case 'request_replace_out':
				$this->load->model('Model_request', 'request');
				$data['cart_detail'] = $data['carts'][$rowid];
				$this->db->where('id', $data['cart_detail']['id']);
				$data['item_detail'] = $this->db->get('item')->row_array();
				$data['parent_task_detail'] = $this->request->detail($data['cart_detail']['options']['task_parent']);
				echo $this->load->view('request/request_replace/cart/form_edit_out', $data, TRUE);
			break;

			//pengadaan
			default:
				echo $this->load->view('request/pengajuan_barang/cart/form_edit_cart', $data, TRUE);
			break;
		}
	}



	function save_cart($what='')
	{
		$data = array();

		$data['carts'] = $this->cart->contents();
		switch ($what) {


			//pengadaan
			default:
				$arr = array();
				$data = array();
				foreach($_POST as $key=>$val):
					if($key=='price' || $key=='qty'):
						$data[$key] = paranoid($val);
					else:
						$data[$key] = $val;
					endif;
				endforeach;
				// pre($data);
				$this->cart->update($data);
				$arr['post'] = $_POST;
				$arr['prefix'] = $this->input->post('prefix');
				echo json_encode($arr);

			break;
		}
	}

	function show_pengadaan($mode='', $task_id)
	{
		$this->load->model('Model_supplier', 'supplier');
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		if($mode=='recomended'):
			$this->db->where('task_id', $task_id);
			$data['items'] = $this->db->get('task_pengadaan')->result_array();
			$data['table'] = 'task_pengadaan';
		else:
			$this->db->where('task_id', $task_id);
			$data['items'] = $this->db->get('task_pengadaan_pembanding')->result_array();
			$data['table'] = 'task_pengadaan_pembanding';
		endif;
		echo $this->load->view('request/pengajuan_barang/current/show_pengadaan', $data, TRUE);
	}

	function show_boq($task_id)
	{
		$this->load->model('Model_supplier', 'supplier');
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		$this->db->where('task_id', $task_id);
		$data['items'] = $this->db->get('task_boq')->result_array();
		$data['table'] = 'task_boq';
		echo $this->load->view('request/boq/current/show_boq', $data, TRUE);
	}

	function moderasi_boq($task_id)
	{
		$this->load->model('Model_supplier', 'supplier');
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		$this->db->where('task_id', $task_id);
		$data['items'] = $this->db->get('task_boq')->result_array();
		$data['table'] = 'task_boq';
		echo $this->load->view('request/boq/current/moderasi_boq', $data, TRUE);
	}

	function pengadaan_delete_item()
	{
		$arr = array();
		if(!$this->form_validation->run('sender')):
			echo json_encode($arr);
		else:
			echo json_encode($arr);
		endif;
	}

	function pengadaan_update_item($id, $table)
	{
		$arr = array();
		$this->db->where('id', $id);
		$detail = $this->db->get($table)->row_array();
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			echo $this->load->view('request/pengajuan_barang/current/form_edit_current', $data, TRUE);
		else:
			$arr['post']  = $_POST;
			$arr['task_id']  = $this->input->post('task_id');
			$data = array(
					'qty' 	=> paranoid($this->input->post('qty')),
					'price' => paranoid($this->input->post('price')),
				);
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			echo json_encode($arr);
		endif;
	}

	function boq_update_item($id)
	{
		$arr = array();
		$this->db->where('id', $id);
		$detail = $this->db->get('task_boq')->row_array();
		if(!$this->form_validation->run('sender')):
			$data = array();
			$data['detail'] = $detail;
			echo $this->load->view('request/boq/current/form_edit_current', $data, TRUE);
		else:
			$arr['post']  = $_POST;
			$arr['task_id']  = $this->input->post('task_id');
			$data = array(
					'qty' 	=> paranoid($this->input->post('qty')),
					'price' => paranoid($this->input->post('price')),
				);
			$this->db->where('id', $id);
			$this->db->update('task_boq', $data);
			echo json_encode($arr);
		endif;
	}

	function boq_delete_item($id)
	{
		$arr = array();
		$this->db->where('id', $id);
		$detail = $this->db->get('task_boq')->row_array();
		if(!empty($detail)):
			$this->db->where('id', $detail['id']);
			$this->db->delete('task_boq');
		endif;
		$arr['task_id'] = $detail['task_id'];
		echo json_encode($arr);
	}

	function admin_sales_form($modes='', $id='')
	{
		$this->lang->load('request/admin_sales');
		$this->load->model('model_request', 'request');
		$this->load->model('request/Model_admin_sales', 'admin_sales');
		$this->load->model('Model_customer', 'customer');
		if(!$this->form_validation->run('sender')):
			$detail = $this->request->detail($id);
			$data = array();
			$data['detail'] = $detail;
			$data['task_ext'] = $this->admin_sales->get_task_ext($detail['id']);
			if($detail['location']=='customer' || $detail['location']=='pre_customer'):
				$data['customer_data'] = $this->customer->detail_customer($detail['location_id']);
			else:
				$data['customer_data'] = array();
			endif;
			$fms = ($modes=='general') ? 'form_grid_general' : 'form_grid_new';
			echo $this->load->view('request/admin_sales/'.$fms, $data, TRUE);
		else:
			$arr = array();

			$params['body'] = $_POST['body_fake'];
			$this->crud->update('task', $params, array('id'));

			// update tgl req
			$mr = array(
				'date_request_start' => $this->input->post('date_request_start')
			);
			$this->db->where('task_id', $this->input->post('id'));
			$this->db->update('task_marketing_request', $mr);

			// if($this->input->post('mode')=='general'):
			// else:
			// endif;

			//installasi_new
			if ($this->input->post('mode')=='new') {
				$task_id = $this->input->post('id');
				$customer_group = $this->input->post('customer_group');
				$customer_id = $this->input->post('customer_id');
				$service_id = $this->input->post('service_id');
				$dt_task = $this->db->where('id', $task_id)->get('task')->row_array();
				$dt_customer = $this->db->where('id', $dt_task['location_id'])->get('customer')->row_array();
				$dt_customer_group = $this->db->where('id', $dt_customer['group_id'])->get('customer_group')->row_array();

				$params_customer = $dt_customer;
				$params_customer['customer_id'] = $customer_id;
				$params_customer['service_id'] = $service_id;

				$this->crud->update('customer', $params_customer, array('id'));

				$params_cust_group = $dt_customer_group;
				$params_cust_group['customer_id'] = $customer_id;
				$this->crud->update('customer_group', $params_cust_group, array('id'));
				$arr['is_install'] = true;
			}

			// progress update +++++++++++++++++++++++++++++++++++++++++++++
			// progress update tag
			if($this->input->post('progress_id')):
				$params_progress = array(
					'id'		=> $this->input->post('progress_id'),
					'task_id'	=> $this->input->post('id'),
					'label'		=> 'Admin Sales',
					'show_url'	=> 'admin_sales/show/'.$this->input->post('id').'/echo',
					'code'		=> 'admin_sales',
				);
				$progress = $this->progress->update($params_progress);
			endif;
			// progress update +++++++++++++++++++++++++++++++++++++++++++++

			//detail customer
			$detail = $this->request->detail($id!='' ? $id : $this->input->post('id'));
			$customer = $this->customer->detail_customer($detail['location_id']);
			$detail['customer'] = $customer;
			$detail['date_start'] = $this->input->post('date_request_start') ? $this->input->post('date_request_start') : $detail['date_start'];
			//end detail customer

			//jika dikirim update statusnya menjadi
			if($this->input->post('flag_send_request')=='Y'):
				$this->db->query('UPDATE {PRE}task SET status=\'sudah_dikirim\' WHERE id=\''.$this->input->post('id').'\' ');

				// Email
				// if($this->input->post('flag_email')):


					//request installasi
					$email_support = $this->emailer->sendto('support');
					$receiver = $email_support;

					$judul = 'Marketing.Request';

					$subject = 'ERP#'.$judul.'#'. ucwords( str_replace('_', ' ', $detail['category']) ) .'#'.$detail['id'].'#'.$detail['customer']['customer_name'];

					$view = $detail['category'];

					$html = $this->load->view('email/template/installasi_new', $detail, TRUE);
					$email['to'] = $receiver;
					$email['cc'] = $detail['customer']['am_email'];
					$email['subject'] = $subject;
					$email['body'] = $html;

					$debug = $this->send_email->compose($email);


					// $msb = $this->emailer->task_content($this->input->post('id'), 'marketing_request');
					// $email['to'] = $this->emailer->sendto('support');
					// $email['subject'] = $msb['subject'];
					// $email['body'] = $msb['body'];
					// $debug = $this->send_email->compose($email);

					// membuat alert ->
              //       $params_alert['link_url'] = 'progress/index/'.$progress_result['progress_id'];
            		// $alert_config = $this->alert->get_config('m1', $params_alert);
            		// $this->alert->create($alert_config);
					
				// endif;
				// Email

				$params_alert = array(
					'alert_code'	=> 'm3',
					'title'	=> 'Request Instalasi',
					'content'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : $this->input->post('subject'),
					'user_id'	=> $this->alert_notif->get_user_by_modul('view_marketing_request'),
					'related_id'	=> $this->input->post('id'),
					'url_link'	=> 'view_marketing_request'
				);
				$this->alert_notif->insert($params_alert);
        		// membuat alert ->

			endif;

			$arr['status'] = 'success';
			$arr['msg'] = 'data berhasil disimpan';
			echo json_encode($arr);
		endif;
	}

	function admin_sales_grouping($id)
	{
		$this->db->where('id', $id);
		$detail = $this->db->get('customer_group')->row_array();
		if(!empty($detail)):
			$group = $detail['customer_id'];
		else:
			$group = '';
		endif;
		echo $group;
	}

	function penjadwalan_marketing_request()
	{
		$this->load->model('model_request', 'request');
		$this->load->model('model_user_assign', 'user_assign');
		$arr = array();
		$ext = array();

		//membuat task teknis
		$params = array();
		$params['task_category'] = $this->input->post('task_category');
		$params['author'] = my_id();
		$params['date_created'] = now();
		$params['date_start'] = ($this->input->post('date_start')) ? $this->input->post('date_start') : now();
		$params['regional'] = session_scope_regional();
		$params['area'] = session_scope_area();
		$params['body'] = $_POST['body_fake'];
		$params['flock'] = 'n';
		$params['up'] = $this->input->post('id');

		$insert_result = $this->crud->insert('task', $params, array('id'));

		//User assigned (optional)
		if($this->input->post('user_assigned')):
			$this->user_assign->save($insert_result['last_id'], $this->input->post('user_assigned'));
		endif;

		//update status marketing request
		$task_data = array();
		$task_data['status'] = 'sudah_dijadwalkan';
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('task', $task_data);

		///------------------ ext
		$ext['id_user_penjadwalan'] = my_id();
		$ext['date_penjadwalan'] = now();
		$this->request->task_ext_partial($this->input->post('id'), 'task_marketing_request', $ext);
		///------------------ ext


		$arr['status'] = 'success';
		$arr['msg'] = 'Data berhasil disimpan';
		echo json_encode($arr);
	}

	// function replace_in($location='', $location_id='', $prefix='')
	// {
	// 	$arr = array();
	// 	if(!$this->form_validation->run('sender')):
	// 		$this->load->model('Model_location', 'location');
	// 		$this->load->model('Model_item_transaction', 'item_transaction');
	// 		// pre($location);
	// 		// pre($location_id);
	// 		// pre($prefix);
	// 		$data = array();
	// 		$data['location_name'] = $this->location->location_id_info($location, $location_id);
	// 		$data['location'] = $location;
	// 		$data['location_id'] = $location_id;
	// 		$data['prefix'] = $prefix;
	// 		// $data['barang_terpasang'] = $this->item_transaction->item_terpasang($location, $location_id);
	// 		echo $this->load->view('request/request_replace/cart/form_in', $data, TRUE);
	// 	else:
	// 		$arr['post']  = $_POST;
    //
	// 		$pitem_detail = $this->input->post('item_detail');
	// 		$split = explode('|', $pitem_detail);
    //
	// 		// ----------------------CART-------------------------------
	// 		$data = array(
	// 			'id'      => $split[0],
	// 			'qty'     => '1',
	// 			'price'   => '0',
	// 			'name'    => $split[0],
	// 		);
    //
	// 		if($this->input->post('options')):
	// 			foreach($this->input->post('options') as $key=>$val):
	// 				$data['options'][$key] = $val;
	// 			endforeach;
	// 			$data['options']['condition'] = $this->input->post('condition');
	// 			$data['options']['note'] = $this->input->post('note');
	// 			$data['options']['item'] = $this->input->post('item');
	// 			$data['options']['transaction_id'] =$split[1];
	// 		endif;
	// 		$this->cart->product_name_rules = '[:print:]';
	// 		$cart_result = $this->cart->insert($data);
	// 		// ----------------------CART-------------------------------
    //
	// 		$arr['status'] = 'success';
	// 		$arr['msg'] = 'Data berhasil disimpan';
	// 		echo json_encode($arr);
	// 	endif;
	// }

	// function replace_out($prefix='')
	// {
	// 	$arr = array();
	// 	if(!$this->form_validation->run('sender')):
	// 		$data = array();
	// 		$data['prefix'] = $prefix;
	// 		$data['prefix_mode'] = $prefix;
	// 		echo $this->load->view('request/request_replace/cart/form_out', $data, TRUE);
	// 	else:
	// 		$arr['post']  = $_POST;
    //
	// 		// ----------------------CART-------------------------------
	// 		$data = array(
	// 			'id'      => $this->input->post('item_name'),
	// 			'qty'     => paranoid($this->input->post('jumlah')),
	// 			'price'   => '0',
	// 			'name'    => $this->input->post('item_name'),
	// 		);
    //
	// 		if($this->input->post('options')):
	// 			foreach($this->input->post('options') as $key=>$val):
	// 				$data['options'][$key] = $val;
	// 			endforeach;
	// 			$data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
	// 			$data['options']['note'] = $this->input->post('note');
	// 		endif;
	// 		$this->cart->product_name_rules = '[:print:]';
	// 		$cart_result = $this->cart->insert($data);
	// 		// ----------------------CART-------------------------------
    //
	// 		$arr['status'] = 'success';
	// 		$arr['msg'] = 'Data berhasil disimpan';
	// 		$arr['prefix_mode'] = $prefix;
    //
	// 		echo json_encode($arr);
	// 	endif;
	// }

	function replace_cart($prefix='')
	{
		$this->load->model('Model_bcn', 'bcn');
		$data = array();
		$data['prefix'] = $prefix;
		echo $this->load->view('request/request_replace/cart/table', $data, TRUE);
	}

	function modal_cart_update_out_action()
	{
		// ----------------------CART-------------------------------
		$data = array(
			// 'id'      => $this->input->post('item_name'),
			'qty'     => paranoid($this->input->post('jumlah')),
			// 'price'   => '0',
			// 'name'    => $this->input->post('item_name'),
		);

		if($this->input->post('options')):
			foreach($this->input->post('options') as $key=>$val):
				$data['options'][$key] = $val;
			endforeach;
			$data['options']['status_kepemilikan'] = $this->input->post('status_kepemilikan');
			$data['options']['note'] = $this->input->post('note');
		endif;
		$data['rowid'] = $this->input->post('rowid');
		// pre($data);
		$this->cart->product_name_rules = '[:print:]';
		$this->cart->update($data);
		// ----------------------CART-------------------------------
	}

	function modal_cart_update_in_action()
	{
		$pitem_detail = $this->input->post('item_detail');
		$split = explode('|', $pitem_detail);
		// ----------------------CART-------------------------------
		$data = array(
			// 'id'      => $split[0],
			// 'qty'     => '1',
			// 'price'   => '0',
			// 'name'    => $split[0],
		);

		if($this->input->post('options')):
			foreach($this->input->post('options') as $key=>$val):
				$data['options'][$key] = $val;
			endforeach;
			$data['options']['condition'] = $this->input->post('condition');
			$data['options']['note'] = $this->input->post('note');
			$data['options']['item'] = $this->input->post('item_in_hidden');
			$data['options']['transaction_id'] = $this->input->post('transaction_hidden');
		endif;
		// pre($data);
		$data['rowid'] = $this->input->post('rowid');
		$this->cart->product_name_rules = '[:print:]';
		$this->cart->update($data);
		// ----------------------CART-------------------------------
	}

	function trial_questions($mode='echo',$type='print')
	{
		$this->load->model('request/model_trial_report','trial_report');
		$this->db->where('category', 'trial_questions');
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('master');
		$result = $query->result_array();
		switch ($mode) {
			case 'serialize':
				if ($this->input->post('trial_question')) {
					$arr = array();
					for ($i = 0; $i < sizeof($this->input->post('trial_question')); $i++) {
						$arr[] = array(
							'pertanyaan'	=> $this->input->post('trial_question')[$i],
							'jawaban' => $this->input->post('jawaban_'.$i) ? 'ya' : 'tidak',
							'uraian'	=> $this->input->post('trial_answer')[$i],
						);
					}
					switch ($type) {
						case 'insert':
							$task_id = $this->input->post('task_id');
							$process = $this->trial_report->hook($task_id, 'insert', $arr);
							$result = isset($process['result']) ? $process['result'] : $process;
							echo json_encode($result);
							break;
						
						default:
							echo json_encode( array('checklist'	=> serialize($arr)) );
							break;
					}
				}
				break;
			case 'unserialize':
				if ($this->input->post('checklist')) {
					$data = unserialize($this->input->post('checklist'));
					$arr = array();
					$i=0;
					foreach ($data as $value) {
						$arr[] = array(
							'pertanyaan' => $result[$i]['note'],
							'jawaban' => $value['jawaban'],
							'uraian'	=> $value['uraian']
						);
						$i++;
					}
					echo encodeJson($arr);
				}
				break;
			
			default:
				echo encodeJson($result);
				break;
		}
	}

	function cust_by_task($task_id)
	{
		$this->lang->load('request/admin_sales');
			$this->load->model('model_request', 'request');
			$this->load->model('request/Model_admin_sales', 'admin_sales');
			$this->load->model('Model_customer', 'customer');
		$detail = $this->request->detail($task_id);
		$customer = $this->customer->detail_customer($detail['location_id']);
		// print_r($detail); exit;
		$detail['customer'] = $customer;
		$id_am = $customer['id_am'];
		$html = $this->load->view('email/template/installasi_new', $detail, TRUE);
		echo $html;
		// print_r($detail); exit;
	}

	function laporan_trial($task_id)
	{
		$this->load->model('request/model_trial_report', 'trial_report');
		$arr = array();
		$detail = $this->trial_report->detail($task_id);
		$trial_question = unserialize($detail['trial']['data']['checklist']);

		$this->db->where('category', 'trial_questions');
		$this->db->order_by('order', 'asc');
		$q_quest = $this->db->get('master');
		$master_quest = $q_quest->result_array();

		if (!empty($trial_question)) {
			$i=0;
			foreach ($trial_question as $value) {
				$arr[] = array(
					'urut'	=> $i+1,
					'pertanyaan' => $master_quest[$i]['note'],
					'jawaban' => $value['jawaban'],
					'uraian'	=> $value['uraian']
				);
				$i++;
			}
			$detail['trial']['data']['checklist'] = $arr;
		}
		// echo json_encode($detail);
		// print_r($detail);
		$html = $this->load->view('email/template/laporan_trial', $detail, TRUE);
		echo  $html;
	}

	function lock_task($modul)
	{
		$this->load->model('Model_task', 'task');
		$arr = array();
		if ($this->input->post('id')) {
			if (have_privileges($modul)) {
				$id = $this->input->post('id');
				$this->task->lock_task($id);
				$arr['status'] = 'success';
				$arr['msg'] = 'Data behasil disimpan';
			} else {
				$arr['status'] = 'failed';
				$arr['msg'] = 'Anda tidak memiliki akses';
			}
			echo json_encode($arr); exit;
		}
	}

}
