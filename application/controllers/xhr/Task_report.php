<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_report extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// basic_auth_login();
		check_login();

        $this->load->model('model_request', 'request');
		$this->load->model('model_customer', 'customer');
		$this->load->model('request/model_task_teknis', 'task_teknis');
		$this->load->model('model_location', 'location');
		$this->load->model('request/model_my_task', 'my_task');
		$this->load->model('request/model_boq', 'boq');
		$this->load->model('request/Model_permintaan_barang', 'permintaan_barang');
		$this->load->model('request/Model_task_report', 'task_report');

		$this->lang->load('request/my_task');

        // $this->load->model('request/Model_request_replace', 'request_replace');
        $this->load->model('Model_bcn', 'bcn');
	}

    function index()
    {
        echo 'Task_report';
    }

	function link_type_picker($type='survey', $ps='primary', $jenis='wr', $report_id='0' )
	{
		$data = array();
		$data['ps'] = $ps;
		$data['report_id'] = $report_id;
		switch ($jenis) {
			case 'wr':
				$view = 'wireless';
			break;
			case 'fo':
				$view = 'fo';
			break;

			default:
				$view = 'nothing';
			break;
		}
		echo $this->load->view('request/my_task/report_form/link/'.$type.'/'.$ps.'/'.$view, $data, TRUE);
	}


    function create($task_id='')
	{
        $task_detail = $this->request->detail($task_id);
		// pre($task_detail);
        $report_detail = $this->request->get_task_report($task_id);
		// pre($report_detail);
		$id_report = '';
		$report_id = '';
        if(!$this->form_validation->run('sender')):
            $data = array();
			$data['task_id'] = $task_id;
			$data['task_detail'] = $task_detail;
			$data['report_detail'] = $report_detail;
			$data['modal_report_ui'] = $this->my_task->modal_report_ui($task_detail['category']);
			// pre($data);

			$data['report_ext'] = (!empty($report_detail)) ? $this->task_report->get_report_ext($report_detail['id_report']) : array();

			switch ($task_detail['category']) {

				case 'pre_survey':
					$data['pre_survey_data'] = (!empty($report_detail)) ? $this->task_report->get_pre_survey_data($report_detail['id_report']) : array();
					$view_laporan = 'request/my_task/report_form/'.$task_detail['category'].'/index';
					$id_report = $report_detail['id_report'];
				break;

				case 'survey':
					$data['survey_link_primary'] = (!empty($report_detail)) ? $this->task_report->get_survey_link($report_detail['id_report'], 'primary') : array();
					$data['survey_link_secondary'] = (!empty($report_detail)) ? $this->task_report->get_survey_link($report_detail['id_report'], 'secondary') : array();
					$view_laporan = 'request/my_task/report_form/'.$task_detail['category'].'/index';
					$id_report = $report_detail['id_report'];
				break;

				case 'installasi_new':
					$data['install_link_primary'] = (!empty($report_detail)) ? $this->task_report->get_install_link($report_detail['id_report'], 'primary') : array();
					$data['install_link_secondary'] = (!empty($report_detail)) ? $this->task_report->get_install_link($report_detail['id_report'], 'secondary') : array();
					$view_laporan = 'request/my_task/report_form/'.$task_detail['category'].'/index';
					$id_report = $report_detail['id_report'];
				break;

				// case 'survey':
				case 'dismantle':
				case 'replace':
				case 'installasi':
				// case 'installasi_new':
					$view_laporan = 'request/my_task/report_form/'.$task_detail['category'].'/index';
				break;

				default:
					$view_laporan = 'request/my_task/report_form/general/index';
				break;
			}
			echo $this->load->view($view_laporan, $data, TRUE);
        else:
            $arr = array();
			$task_id = $this->input->post('id');

			//difilter dulu
			$filter = $this->request->filter_boleh_laporan();
			if($filter['allow_report']=='0'):
				$arr['status'] = 'failed';
				$arr['msg'] = $filter['msg'];
				echo json_encode($arr);
				exit;
			endif;

			$params = array();

			///main action
			///membuat / update "task" dengan task category "task_report"
			$cek = $this->task_teknis->cek_laporan($task_id);
			if(empty($cek)):
				$params['task_category'] = 'task_report';
				$params['status'] = $this->input->post('status_pekerjaan');
				$nr = $this->request->insert($params);
				//----------------------------------
				$report_id = $nr['last_id'];
				//----------------------------------
				$last_main_action = $this->db->last_query();
			else:
				$params['task_category'] = 'task_report';
				$params['id'] = $cek['id'];
				$params['body'] = $this->input->post('body_fake');
				$this->request->update($params);
				//----------------------------------
				$report_id = $cek['id'];
				//----------------------------------
				$last_main_action = $this->db->last_query();
			endif;

			// set report ext
			$this->task_report->set_report_ext($report_id);
			// set report ext

			// update koordinat
			if ( ($this->input->post('koordinat') || $this->input->post('koordinat_klien')) && $this->input->post('location_id') ) {
				$this->task_teknis->update_koordinat();
			}
			// end update koordinat

			//debug main action
			$arr['debug_main_action'] = $last_main_action;
			//debug main action

			//update status_pekerjaan selain survey yg butuh approval
			if ( !($this->input->post('category')=='survey' && $this->input->post('status_pekerjaan')=='need_approval') ) 
				$this->my_task->update_task_status($task_id);

			$kategori_lap = $this->input->post('category');
			switch ($kategori_lap) {
				case 'pre_survey':
					$pre_survey_ext = $this->task_report->set_pre_survey_data($report_id);
				break;

				case 'survey':
					//insert boq
					// $this->boq->insert_boq_by_task_id($report_detail['id_report']);
					$this->boq->insert_boq_by_task_id($report_id);
					// get boq
					// $data['boq'] = $this->boq->detail($report_detail['id_report']);
					$this->task_report->set_survey_link($report_id, 'primary');
					$this->task_report->set_survey_link($report_id, 'secondary');
				break;

				case 'installasi':
					$barang_dipasang = $this->permintaan_barang->laporan_barang_dipasang($task_id);
					$save_barang_dipasang = $this->my_task->save_barang_dipasang($barang_dipasang, $report_id);
					$arr['debug_category'] = $save_barang_dipasang;
				break;

				case 'replace':
					$barang_dipasang = $this->permintaan_barang->laporan_barang_dipasang_replace($task_id);
					$save_barang_dipasang = $this->my_task->save_barang_dipasang($barang_dipasang, $report_id);
					$arr['debug_category'] = $save_barang_dipasang;
					break;

				case 'installasi_new':
					$this->task_report->set_install_link($report_id, 'primary');
					$this->task_report->set_install_link($report_id, 'secondary');
					$this->my_task->save_barang_installasi_new($report_id);
				break;
			}


			$data = $this->get_task_detail($report_id,'array');
			// Email
			if($this->input->post('flag_email')):
				$email_support = $this->emailer->sendto('support');
				$receiver = $email_support;

				switch ($data['task_category']) {
					//only task report and marketing progress
					case 'task_report':
						$judul = 'Lap.Pekerjaan';
						break;
					
					default:
						$judul = 'Marketing.Request';
						break;
				}
				$subject = 'ERP#'.$judul.'#'.$data['id'].'#'.$data['subject'];

				$html = $this->load->view('email/template/report_mail', $data, TRUE);
				$email['to'] = $receiver;

				if (!empty($data['data_location']['data_marketing']['email'])) {
					$email['cc'] = $data['data_location']['data_marketing']['email'];
				}
				
				$email['subject'] = $subject;
				$email['body'] = $html;

				$debug = $this->send_email->compose($email);
			endif;
			// Email

			// alert notif
			if (!empty($data['data_location']['data_marketing']['id'])) {
				$params_alert = array(
					'alert_code'	=> 'task_report',
					'title'	=> 'Laporan Pekerjaan',
					'content'	=> $data['subject'],
					'user_id'	=> $data['data_location']['data_marketing']['id'],
					'related_id'	=> $report_id,
					'url_link'	=> 'marketing_progress'
				);
				$this->alert_notif->insert($params_alert);
			}
			// end alert notif

            $arr['msg'] = 'Data berhasil disimpan';
            $arr['status'] = 'success';
            $arr['post'] = $_POST;
            echo json_encode($arr);
        endif;
	}

	function get_task_detail($id, $type='json')
	{
		$data = array();

		$result = $this->get_report_detail($id, 'array');


		if ($result):
			$data = $result;
			$arr_location = array('pre_customer', 'customer', 'bts', 'customer_non');
			//detail location
			if (in_array($result['location'], $arr_location)) {
				switch ($result['location']) {
					case 'bts':
						$location_table = 'bts';
						break;
					
					default:
						$location_table = 'customer';
						break;
				}
				$data_location = $this->get_table_data($location_table, array('id' => $result['location_id']), 'row_array' );
			} else {
				$location_table = 'master';
				$data_location = $this->get_table_data($location_table, array(
						'code' => $result['location_id'],
						'category' => $result['location']
					), 
					'row_array');
				if ($data_location['num_rows'] > 0) {
					$data_location_category = $this->get_table_data('location', array(
							'code'	=> $data_location['data']['category']
						), 'row_array'
					);
					$data_location['data']['category_name'] = !empty($data_location_category['data']['name']) ? $data_location_category['data']['name'] : $data_location['data']['category_name'];
				}
			}
			$data['data_location'] = $data_location['num_rows']>0 ? $data_location['data'] : array();

			if ($location_table=='customer') {
				$data_marketing = $this->get_table_data('users', array('id' => $data_location['data']['id_am']), 'row_array' );
				$data_contact = $this->get_table_data('contact_person', array('customer_id' => $result['location_id']), 'result_array');
				$data['data_location']['data_contact'] = $data_contact['data'];

				//customer_product
				$data['data_location']['data_product'][0] = array(
					'name'	=> '',
					'price'	=> '',
					'value'	=> '',
					'satuan_bandwidth' => ''
				);
				$data_product = $this->get_table_data('customer_product', array('customer_id' => $result['location_id']) ,'result_array');
				if ($data_product['num_rows'] > 0) {
					$i = 0;
					foreach ($data_product['data'] as $row) {
						$product_id = !empty($row['product_id_new']) ? $row['product_id_new'] : $row['product_id'];
						$detail_product = $this->get_table_data('product', array('code'	=> $product_id), 'row_array');

						$data['data_location']['data_product'][$i] = array(
							'name'	=> $detail_product['data']['name'],
							'price'	=> !empty($row['product_price']) ? $row['product_price'] : $detail_product['data']['price'],
							'value'	=> !empty($row['product_value']) ? $row['product_value'] : $detail_product['data']['value'],
							'satuan_bandwidth'	=> !empty($row['satuan_bandwidth']) ? $row['satuan_bandwidth'] : $detail_product['data']['satuan_bandwidth']
						);
						$i++;
					}
				}

				if ($data_marketing['num_rows']>0) {
					foreach ($data_marketing['data'] as $key => $value) {
						switch ($key) {
							case 'id': 
							case 'name':
							case 'email':
							case 'regional':
							case 'area':
								$data['data_location']['data_marketing'][$key] = $value;
								break;
							
							default:
								// code...
								break;
						}
					}
				}
			}

			// task parent
			$data['task_parent'] = $this->get_report_detail($result['up'], 'array');
			
			// task child
			$data_task_child = $this->get_table_data('task', array('up' => $result['id']), 'row_array');
			$data['task_child'] = $data_task_child['num_rows']>0  ? $this->get_report_detail($data_task_child['data']['id'], 'array') : array();

			// laporan
			if ( $result['task_category']!='task_report' && $data_task_child['num_rows']>0 ) :

				if ($result['task_category']=='marketing_progress') {
					$category = $data['task_child']['category'];
				} else {
					$category = $result['category'];
				}

				$condition = array(
					'id >='	=> $result['id'],
					'task_category'	=> 'task_report',
					'status'	=> 'selesai',
					'location_id'	=> $result['location_id'],
					'category'	=> $category
				);
				$data_laporan = $this->get_table_data('task', $condition, 'row_array');
				$data['laporan'] = $data_laporan['num_rows']>0 ? $this->get_report_detail($data_laporan['data']['id'], 'array') : array();

				// barang
				if ($data_laporan['num_rows']>0) :
					// request out
					$condition_request_out = array(
						'up'	=> $data_laporan['data']['up'],
						'task_category'	=> 'request_out',
						'location_id'	=> $result['location_id']
					);
					$data_request_out = $this->get_table_data('task', $condition_request_out, 'row_array');

					$data_item_detail_out = array();
					if ($data_request_out['num_rows']>0) {
						$this->db->select('task_item_out.*, users.name AS approved_name, 
							item.item_name, item_detail.nomor_barang,  item_detail.mac_address, item_detail.barcode, brand.item_categories as brand_name, category.item_categories as category_name')
							->join('item_detail','task_item_out.item_detail_id = item_detail.id','left')
							->join('users','task_item_out.approved_by = users.id','left')
							->join('item','task_item_out.item_id = item.id', 'left')
							->join('item_categories category', 'item.category_id = category.id', 'left')
							->join('item_categories brand', 'item.brand = brand.id', 'left');
						$data_item_detail_out = $this->db->where('task_id',$data_request_out['data']['id'])->get('task_item_out')->result_array();
					}

					// request in
					$condition_request_in = array(
						'up'	=> $data_laporan['data']['up'],
						'task_category'	=> 'request_in',
						'location_id'	=> $result['location_id']
					);
					$data_request_in = $this->get_table_data('task', $condition_request_in, 'row_array');


					/*
					$condition_request_cancel_out = array(
						'up'	=> $data_laporan['data']['up'],
						'task_category'	=> 'request_out',
						'location_id'	=> $result['location_id']
					);
					*/
					switch ($category) {
						case 'installasi':
						case 'installasi_new':
							$data['laporan']['list_barang_out'] = $data_item_detail_out;
							break;
						case 'dismantle':
							
							break;
						case 'replace':
							
							break;
						case 'general':
							
							break;
						default:
							// code...
							break;
					}
				endif;

			elseif($result['task_category']=='task_report') : 

				$is_replace = $result['category'] == 'replace';
				// request out
				$condition_request_out = array(
					'up'	=> $result['up'],
					'task_category'	=> $is_replace ? 'request_replace' : 'request_out',
					'location_id'	=> $result['location_id']
				);
				$data_request_out = $this->get_table_data('task', $condition_request_out, 'row_array');
				$data_item_detail_out = array();
				if ($data_request_out['num_rows']>0) {
					$this->db->select('task_item_out.*, users.name AS approved_name, 
						item.item_name, item_detail.nomor_barang, item_detail.mac_address, item_detail.barcode,  brand.item_categories as brand_name, category.item_categories as category_name')
						->join('item_detail','task_item_out.item_detail_id = item_detail.id','left')
						->join('users','task_item_out.approved_by = users.id','left')
						->join('item','task_item_out.item_id = item.id', 'left')
						->join('item_categories category', 'item.category_id = category.id', 'left')
						->join('item_categories brand', 'item.brand = brand.id', 'left');
					$data_item_detail_out = $this->db->where('task_id',$data_request_out['data']['id'])->get('task_item_out')->result_array();
				}

				$data['list_barang_out'] = $data_item_detail_out;

				// request in
				$condition_request_in = array(
					'up'	=> $result['up'],
					'task_category'	=> $is_replace ? 'request_replace' : 'request_in',
					'location_id'	=> $result['location_id']
				);
				$data_request_in = $this->get_table_data('task', $condition_request_in, 'row_array');
				// print_r($data_request_in); exit;
				$data_item_detail_in = array();
				if ($data_request_in['num_rows']>0) {
					$this->db->select('task_item_in.*, users.name AS approved_name, 
						item.item_name, item_detail.nomor_barang, item_detail.mac_address, item_detail.barcode,  brand.item_categories as brand_name, category.item_categories as category_name')
						->join('item_detail','task_item_in.item_detail_id = item_detail.id','left')
						->join('users','task_item_in.approved_by = users.id','left')
						->join('item','item_detail.item_id = item.id', 'left')
						->join('item_categories category', 'item.category_id = category.id', 'left')
						->join('item_categories brand', 'item.brand = brand.id', 'left');
					$data_item_detail_in = $this->db->where('task_id',$data_request_in['data']['id'])->get('task_item_in')->result_array();
				}
				$data['list_barang_in'] = $data_item_detail_in;

			else:

			endif;

		else:
			$data = array(
				'err'	=> 404,
				'message'	=> 'Not Found'
			);
		endif;

		switch ($type) {
			case 'array':
				return $data;
				break;
			case 'echo':
				$this->load->view('task/task_detail', $data, FALSE);
				break;
			
			default:
				header("Content-type: application/json");
				echo json_encode($data);
				break;
		}

	}

	function get_report_detail($id, $type='json')
	{
		$data = array();
		$this->db->where('id', $id);
		$q = $this->db->get('task');
		if ($q->num_rows() > 0) {
			$result = $q->row_array();
			$data = $result;

			//author
			$data_author = $this->get_table_data('users', array('id' => $result['author']), 'row_array');
			if ($data_author['num_rows']>0) {
				$data['author'] = array(
					'id' => $data_author['data']['id'],
					'name' => $data_author['data']['name'],
					'email' => $data_author['data']['email'],
					'regional' => $data_author['data']['regional'],
					'area' => $data_author['data']['area'],
				);
			}

			// user assign
			$data_user_assign = $this->get_table_data('task_user_assigned', array('task_id' => $result['id']));
			if ($data_user_assign['num_rows']>0) {
				$user_assinged = array();
				foreach ($data_user_assign['data'] as $row) {
					$assign = $this->get_table_data('users', array('id' => $row['user_id']), 'row_array')['data'];

					$user_assinged[] = array(
						'id'	=> $assign['id'],
						'name'	=> $assign['name'],
						'email'	=> $assign['email'],
						'regional'	=> $assign['regional'],
						'area'	=> $assign['area'],
					);
				}

				$data['user_assinged'] = $user_assinged;
			}

			// task report
			$data_task_report = $this->get_table_data('task_report', array('task_id' => $result['id']) );
			$data['task_report'] = $data_task_report['num_rows']>0 ? $data_task_report['data'] : array();

			// task approval
			$data_task_approval = $this->get_table_data('task_approval', array('task_id' => $result['id']) );
			$data['task_approval'] = $data_task_approval['num_rows']>0 ? $data_task_approval['data'] : array();

			// task attachment
			$data_task_attachment = $this->get_table_data('task_attachment', array('task_id' => $result['id']) );
			$data['task_attachment'] = $data_task_attachment['num_rows']>0 ? $data_task_attachment['data'] : array();

			// task boq
			$data_task_boq = $this->get_table_data('task_boq', array('task_id' => $result['id']) );
			$data['task_boq'] = $data_task_boq['num_rows']>0 ? $data_task_boq['data'] : array();
			if (count($data['task_boq'])>0) {
				$i=0;
				foreach ($data['task_boq'] as $row) {
					if ($row['mode'] == 'barang') {
						$this->db->select('item.id AS id,
							item.item_name AS item_name,
							item.jumlah AS jumlah,
							brand.item_categories AS brand_name,
							cat.item_categories AS category_name')
							->join('item_categories brand','brand.id=item.brand')
							->join('item_categories cat','cat.id=item.category_id');
						$this->db->where('item.id', $row['item_id']);
						$query_boq = $this->db->get('item');
						if ($query_boq->num_rows() > 0) {
							$data_boq = $query_boq->row_array();
							$data['task_boq'][$i]['item_name'] = $data_boq['item_name'];
							$data['task_boq'][$i]['brand_name'] = $data_boq['brand_name'];
							$data['task_boq'][$i]['category_name'] = $data_boq['category_name'];
						}
					}
					$i++;
				}
			}

			// task comment
			$data_task_comment = $this->get_table_data('task_comment', array('task_id' => $result['id']) );
			$data['task_comment'] = $data_task_comment['num_rows']>0 ? $data_task_comment['data'] : array();
			if (!empty($data['task_comment'])) {
				$i = 0;
				foreach ($data['task_comment'] as $r_comment) {
					$data['task_comment'][$i]['author_name'] = $this->get_table_data('users', array('id' => $r_comment['author']), 'row_array')['data']['name'];
					$i++;
				}
			}

			// task item masuk
			$data_task_item_in = $this->get_table_data('task_item_in', array('task_id' => $result['id']) );
			$data['task_item_in'] = $data_task_item_in['num_rows']>0 ? $data_task_item_in['data'] : array();

			// task item keluar
			$data_task_item_out = $this->get_table_data('task_item_out', array('task_id' => $result['id']) );
			$data['task_item_out'] = $data_task_item_out['num_rows']>0 ? $data_task_item_out['data'] : array();

			// task item batal keluar
			$data_task_item_out_cancel = $this->get_table_data('task_item_out_cancel', array('task_id' => $result['id']) );
			$data['task_item_out_cancel'] = $data_task_item_out_cancel['num_rows']>0 ? $data_task_item_out_cancel['data'] : array();

			// laporan harian
			$data_task_laporan_harian = $this->get_table_data('task_laporan_harian', array('task_id' => $result['id']) );
			$data['task_laporan_harian'] = $data_task_laporan_harian['num_rows']>0 ? $data_task_laporan_harian['data'] : array();

			// marketing approval
			$data_task_marketing_approval = $this->get_table_data('task_marketing_approval', array('task_id' => $result['id']) );
			$data['task_marketing_approval'] = $data_task_marketing_approval['num_rows']>0 ? $data_task_marketing_approval['data'] : array();

			// marketing request
			$data_task_marketing_request = $this->get_table_data('task_marketing_request', array('task_id' => $result['id']) );
			$data['task_marketing_request'] = $data_task_marketing_request['num_rows']>0 ? $data_task_marketing_request['data'] : array();

			// task mutasi
			$data_task_mutasi = $this->get_table_data('task_mutasi', array('task_id' => $result['id']) );
			$data['task_mutasi'] = $data_task_mutasi['num_rows']>0 ? $data_task_mutasi['data'] : array();

			// pekerjaan teknis
			$data_task_pekerjaan_teknis = $this->get_table_data('task_pekerjaan_teknis', array('task_id' => $result['id']) );
			$data['task_pekerjaan_teknis'] = $data_task_pekerjaan_teknis['num_rows']>0 ? $data_task_pekerjaan_teknis['data'] : array();

			// task pengadaan
			$data_task_pengadaan = $this->get_table_data('task_pengadaan', array('task_id' => $result['id']) );
			$data['task_pengadaan'] = $data_task_pengadaan['num_rows']>0 ? $data_task_pengadaan['data'] : array();

			// pengadaan pembanding
			$data_task_pengadaan_pembanding = $this->get_table_data('task_pengadaan_pembanding', array('task_id' => $result['id']) );
			$data['task_pengadaan_pembanding'] = $data_task_pengadaan_pembanding['num_rows']>0 ? $data_task_pengadaan_pembanding['data'] : array();

			// report instalasi
			$data_install_report = $this->get_table_data('task_report_install_link', array('task_id' => $result['id']));
			$data['task_report_install_link'] = $data_install_report['num_rows'] > 0 ? $data_install_report['data'] : array();

			// report link
			$data_report_link = $this->get_table_data('task_report_link', array('task_id' => $result['id']));
			$data['task_report_link'] = $data_report_link['num_rows']>0 ? $data_report_link['data'] : array();

			// data presurvey
			$data_presurvey = $this->get_table_data('task_report_presurvey', array('task_id' => $result['id']));
			$data['task_report_presurvey'] = $data_presurvey['num_rows']>0 ? $data_presurvey['data'] : array();

			// data survey
			$data_survey = $this->get_table_data('task_report_survey_link', array('task_id' => $result['id']));
			$data['task_report_survey_link'] = $data_survey['num_rows']>0 ? $data_survey['data'] : array();

			// primary link
			$data_primary_link = $this->get_table_data('task_report_primary_link', array('task_id' => $result['id']));
			$data['task_report_primary_link'] = $data_primary_link['num_rows']>0 ? $data_primary_link['data'] : array();

			// secondary link
			$data_secondary_link = $this->get_table_data('task_report_secondary_link', array('task_id' => $result['id']));
			$data['task_report_secondary_link'] = $data_secondary_link['num_rows']>0 ? $data_secondary_link['data'] : array();

			// master category
			$data_master_category = $this->get_table_data('master', array('code' => $result['category']), 'row_array');
			$data['detail_category'] = $data_master_category['num_rows']>0 ? $data_master_category['data'] : array();
		}

		if ($request_type='array') {
			return $data;
		} else {
			header("Content-type: application/json");
			echo json_encode($data);
		}
	}

	function teknis_mrk_req_attachment($task_id, $type='json')
	{
		$data = array();
		$arr = array();
		$arr = $this->task_report->get_attachment_parent($task_id);

		// if (isset($arr['parent'])) {
		// 	$except = array('parent');
		// 	$i = 0;
		// 	foreach ($arr as $key => $value) {
		// 		if (!in_array($key, $except)) {
		// 			$data[$i][$key] = $value;
		// 		}
		// 	}
		// }
		echo json_encode($arr);
	}

	function get_table_data($table, $condition=array(), $type='result_array')
	{
		$this->db->where($condition);
		$query = $this->db->get($table);
		$data['data'] = $type=='row_array' ? $query->row_array() : $query->result_array();
		$data['num_rows'] = $query->num_rows();
		return $data;
	}

	function send_mail_task($task_id)
	{
		$data = $this->get_task_detail($task_id,'array');

		$email_support = $this->emailer->sendto('support');

		$receiver = $email_support;

		$receiver .= !empty($data['data_location']['data_marketing']['email']) ? ','.$data['data_location']['data_marketing']['email'] : '';

		switch ($data['task_category']) {
			//only task report and marketing progress
			case 'task_report':
				$judul = 'Lap.Pekerjaan';
				break;
			
			default:
				$judul = 'Marketing.Request';
				break;
		}

		$subject = 'ERP#'.$judul.'#'.$data['id'].'#'.$data['subject'];

		$html = $this->load->view('email/template/report_mail', $data, TRUE);
		echo $html;

		/* sendmail */
		// $email['to'] = $receiver;
		// $email['subject'] = $subject;
		// $email['body'] = $html;

		// $sendmail = $this->send_email->compose($email);
		// echo json_encode($sendmail);
	}

	function send_mail_request($task_id)
	{
		$data = $this->get_task_detail($task_id,'array');
		print_r($data); exit;
	}

	function send_mail_laphar($task_id)
	{
		$this->load->model('request/model_laporan_harian','laporan_harian');
		$this->load->model('model_bts', 'bts');
		$data = array();
		$detail = $this->request->detail($task_id);
		$data = $detail;
		$data['task_ext'] = $this->laporan_harian->get_task_ext($detail['id'], $detail);
		$data['customer'] = $detail['location']=='bts' ? $this->bts->detail($detail['location_id']) : $this->customer->detail_customer($detail['location_id']);
		// print_r($data);
		$html = $this->load->view('email/template/laporan_harian', $data, TRUE);
		echo $html;
	}

}
