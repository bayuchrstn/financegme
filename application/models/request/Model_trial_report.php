<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_trial_report extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget()
	{
		return array();
	}

	function sub_title($filter='', $url='')
	{
		return '';
	}

	function hook($task_id, $mode='insert', $data=array())
	{
		$arr = array();
		if ($mode='insert') {
			$where = array('task_id' => $task_id);
			$checklist = serialize($data);
			$dt = array(
				'status'	=> 'done',
				'checklist'	=> $checklist,
				'note'		=> $this->input->post('note') ? $this->input->post('note') : '',
				'date_report'	=> now(),
				'id_user_report'	=> my_id(),
				'flag_lock'	=> '1'
			);

			$this->db->where($where)
				->update('trial', $dt);

			//sendmail
			$checklist_arr = array();
			$detail = $this->detail($task_id);
			$trial_question = unserialize($detail['trial']['data']['checklist']);

			$q_quest = $this->db->where('category', 'trial_questions')
				->order_by('order', 'asc')
				->get('master');
			$master_quest = $q_quest->result_array();

			if (!empty($trial_question)) {
				$i=0;
				foreach ($trial_question as $value) {
					$checklist_arr[] = array(
						'urut'	=> $i+1,
						'pertanyaan' => $master_quest[$i]['note'],
						'jawaban' => $value['jawaban'],
						'uraian'	=> $value['uraian']
					);
					$i++;
				}
				$detail['trial']['data']['checklist'] = $checklist_arr;
			}

			$html = $this->load->view('email/template/laporan_trial', $detail, TRUE);

			$email_support = $this->emailer->sendto('support');
			$receiver = $email_support;

			$judul = 'Laporan.Trial';
			$subject = 'ERP#'.$judul.'#'.$detail['id'].'#'.$detail['customer']['data']['customer_name'];

			$email['to'] = $receiver;
			// $email['cc'] = $detail['customer']['data']['am_email'];
			$email['subject'] = $subject;
			$email['body'] = $html;

			$debug = $this->send_email->compose($email);

			// end sendmail
			$arr['result'] = array(
				'status'	=> 'success',
				'msg'	=> 'Insert Data Successfully',
				'sendmail' => $debug
			);
		}
		return $arr;
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function tabs()
	{
		$arr = array();
		$arr['selected'] = array(
			'name'=>'Request',
			'code'=>'request',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Nama Pelanggan'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Action'),
			)
		);
		$arr[] = array(
			'name'=>'Selesai',
			'code'=>'done',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Nama Pelanggan'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Action'),
			)
		);
		return $arr;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Laporan Trial' => '#'
			);

		if($this->uri->segment(2)=='r'):
			$arr['main_action'] = array();
		else:
			$arr['main_action'] = array(
					// '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
				);
		endif;



		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Marketing'),
				array('label'   => 'Customer'),
				array('label'   => 'Tanggal'),
				// array('label'   => 'Judul'),
				array('label'   => 'Status'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			);
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		$this->request->task_ext($task_id, 'task_laporan_harian', $params);
	}

	function get_task_ext($task_id)
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_laporan_harian')->row_array();
		return $data;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
		// if(!empty($task_detail)):
		// 	foreach($task_detail as $key=>$val):
		// 		$arr[$key] = $val;
		// 	endforeach;
		// endif;
		$task = $task_detail;
		if (!empty($task)) {
			$arr = $task;
			$arr['task_marketing_request'] = $this->get_table_data('task_marketing_request', array('task_id'	=> $task_id), 'row_array');
			$arr['trial'] = $this->get_table_data('trial', array('task_id'	=> $task_id), 'row_array');

			if ($arr['trial']['data']['id_user_report']!=0) {
				$dt_reporter = $this->get_table_data('users', array('id'	=> $arr['trial']['data']['id_user_report']), 'row_array');
				$arr['trial']['data']['report_name'] = $dt_reporter['data']['name'];

				$arr['trial']['data']['report_date'] = date('d M Y H:i:s', strtotime($arr['trial']['data']['date_report']) );
			}

			$arr['customer'] = $this->get_table_data('customer', array('id'	=> $task['location_id']), 'row_array');
			if ( $arr['customer']['num_rows'] > 0 ) {
				if ( $arr['customer']['data']['contact_person']=='' ) {
					$contact_person = $this->get_table_data('contact_person', array('customer_id' => $arr['customer']['data']['id']), 'row_array');
					$arr['customer']['data']['contact_person'] = $contact_person['data']['name'];
					$arr['customer']['data']['telephone_home'] = $contact_person['data']['telephone_home'];
					$arr['customer']['data']['telephone_mobile'] = $contact_person['data']['telephone_mobile'];
					$arr['customer']['data']['telephone_work'] = $contact_person['data']['telephone_office'];
					$arr['customer']['data']['email'] = $contact_person['data']['email'];
				}
				$data_marketing = $this->get_table_data('users', array('id'	=> $arr['customer']['data']['id_am']), 'row_array');
				$arr['customer']['data']['am_name'] = $data_marketing['data']['name'];
				$arr['customer']['data']['am_email'] = $data_marketing['data']['email'];
			}
		}
		return $arr;
	}

	function filtering($filter='')
	{
		if($filter !=''):
			$filter = un_filter_serialthis($filter);
			// pre($filter);
			$this->db->where('location_id', $filter['location_id']);
		endif;
	}

	function data($modul, $filter)
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');

		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['data'];
	    $orderType = $post_order[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// pre($modul);
		// pre($filter);

		// Edit Here
		// $this->filtering($filter);
		$this->db->where('trial.status', $filter);
		$this->db->select('COUNT({PRE}trial.id) as total');
		// $this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
		$qryrecordsTotal = $this->db->get('trial')->row_array();
		$recordsTotal = $qryrecordsTotal['total'];

		if( $post_search['value'] ):

			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$where_string .= " AND {PRE}trial.status='".$filter."' ";

			// Edit Here
			$this->db->where( $where_string );
			$this->db->select('trial.id, trial.task_id, customer.customer_name, task_marketing_request.date_request_start, task_marketing_request.date_request_end');
			$this->db->join('task', 'task.id = trial.task_id', 'left')
				->join('task_marketing_request','task_marketing_request.task_id=task.id','left')
				->join('customer','customer.id = task.location_id','left');
			$query = $this->db->get("trial", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->db->join('task', 'task.id = trial.task_id', 'left')
				->join('task_marketing_request','task_marketing_request.task_id=task.id','left')
				->join('customer','customer.id = task.location_id','left');
			$this->db->where( $where_string );
			$total_filtered = $this->db->get("trial")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			// $this->filtering($filter);
			$this->db->where('trial.status', $filter);
			$this->db->select('trial.id, trial.task_id, customer.customer_name, task_marketing_request.date_request_start, task_marketing_request.date_request_end');
			$this->db->join('task', 'task.id = trial.task_id', 'left')
				->join('task_marketing_request','task_marketing_request.task_id=task.id','left')
				->join('customer','customer.id = task.location_id','left');
			$query = $this->db->get("trial", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
				// pre($row);
				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = $filter=='request' ? '<a onclick="insert(\''.$row['task_id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Buat Laporan</a>' : '<a onclick="show(\''.$row['task_id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Lihat Laporan</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'urut'	=> $urut,
					'trial_id'	=> $row['id'],
					'task_id'	=> $row['task_id'],
					'customer_name'	=> $row['customer_name'],
					'date_start'	=> $row['date_request_start'],
					'date_end'	=> $row['date_request_end'],
					'action'								=> $action,
				);
			endforeach;
		endif;
		// exit;
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
			case 'shift' :
				$this->db->where('category', 'shift');
				$data = $this->db->get('master')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['code']] = $row['name'];
					endforeach;
				endif;
			break;

			case 'jenis_laporan_harian' :
				$this->db->where('category', 'jenis_laporan_harian');
				$data = $this->db->get('master')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['code']] = $row['name'];
					endforeach;
				endif;
			break;

			//pre customer
			default:
				$data = $this->db->get('customer')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['customer_name'];
					endforeach;
				endif;
			break;
		}

		return($arr);
	}

	function get_table_data($table, $condition=array(), $type='result_array')
	{
		$this->db->where($condition);
		$query = $this->db->get($table);
		$data['data'] = $type=='row_array' ? $query->row_array() : $query->result_array();
		$data['num_rows'] = $query->num_rows();
		return $data;
	}


}

/* End of file Model_trial_report.php */
/* Location: ./application/models/request/Model_trial_report.php */