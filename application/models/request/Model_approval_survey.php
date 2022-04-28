<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_approval_survey extends CI_Model {

	function __construct()
    {
        parent:: __construct();
    }

	function widget($mode)
	{
		$arr = array();
		switch ($mode) {

			default:

				$arr_jenis_task = array(
					'survey' => 'Survey',
					'installasi' => 'Installasi',
					'dismantle' => 'Dismantle',
					'replace' => 'Replace',
					'general' => 'General',
				);
				$arr['arr_jenis_task'] = $arr_jenis_task;
				$arr['table'] = array();

				foreach($arr_jenis_task as $code=>$val):
					$this->db->order_by('id', 'desc');
					$this->db->where('task_category', 'task_teknis');
					$this->db->where('category', $code);
					$this->db->select('task.*');
					// $this->db->select('author.name as author_name');
					// $this->db->join('users author', 'author.id = task.author', 'left');
					$data['task_lists'] = $this->db->get('task', 10)->result_array();
					$arr['table'][$code] = $this->load->view('request/task_teknis/widget_task', $data, TRUE);
				endforeach;
				// pre($arr);
			break;
		}
		return $arr;
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function hook($task_id)
	{
		$arr = array();
		// $arr['save_boq'] = $this->save_boq($task_id);
		// $arr['copy_item_from_ts'] = $this->copy_item_from_ts($task_id);
		return $arr;
	}

    function copy_item_from_ts($task_id)
    {
        if($this->input->post('prefix')=='insert'):
            $sql = "INSERT INTO {PRE}task_boq (task_id, item_id, supplier, qty, price, mode) SELECT CONCAT('".$task_id."'), item_id, supplier, qty, price, mode FROM {PRE}task_boq WHERE task_id='".$this->input->post('up_select')."' ";
            $this->db->query($sql);
        endif;
    }

	function save_boq($task_id)
    {
		$arr = array();
		$cart = $this->cart->contents();
		// $key = $this->cart_to_key($cart);
		// $data = $this->cart_to_arr($cart);
        if(!empty($cart)):
    		$arr_sql = array();
    		foreach($cart as $data):

    			$sql = "INSERT INTO {PRE}task_boq (task_id, item_id, supplier, qty, price, mode) VALUES ('".$task_id."', '".$data['name']."', '".$data['options']['supplier']."', '".$data['qty']."', '".$data['price']."', '".$data['options']['mode']."')";
    			$qcek = "SELECT * from {PRE}task_boq WHERE task_id='".$task_id."' AND item_id='".$data['name']."' AND supplier='".$data['options']['supplier']."' ";
    			$cek = $this->db->query($qcek)->result_array();
    			if(empty($cek)):
    				$this->db->query($sql);
    			endif;

    			$arr_sql[] = $sql;

    		endforeach;
    		$arr['arr_sql'] = $arr_sql;
    		$this->cart->destroy();
        endif;
		return $arr;

    }

	function tabs()
	{
		$arr = array();

        // ticket to helpdesk
        $arr['selected'] = array(
        	'name'	=> 'Open',
        	'code'	=> 'ticket_helpdesk_open',
        	'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Judul'),
				array('label'   => 'Pembuat'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Action'),
			)
        );
        $arr[] = array(
        	'name'	=> 'Solve',
        	'code'	=> 'ticket_helpdesk_solve',
        	'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Judul'),
				array('label'   => 'Pembuat'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Action'),
			)
        );
        $arr[] = array(
        	'name'	=> 'Closed',
        	'code'	=> 'ticket_helpdesk_closed',
        	'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Judul'),
				array('label'   => 'Pembuat'),
				array('label'   => 'Lokasi'),
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
				'Pekerjaan Teknis' => '#'
			);

		if($this->uri->segment(2)=='r'):
			$arr['main_action'] = array();
		else:
			$arr['main_action'] = array(
					// '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> Create Ticket</a>',
					// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
					// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
				);
		endif;

        $arr['modal_insert_title'] = 'Create Ticket';
        $arr['modal_update_title'] = 'Update Ticket';

		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Dari'),
				array('label'   => 'Judul'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Tanggal Request'),
				array('label'   => 'Kategori'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			);
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		// $this->request->task_ext($task_id, 'task_pekerjaan_teknis', $params);
	}

	function get_task_ext($task_id)
	{
        $this->db->where('task_id', $task_id);
		$data = $this->db->get('gmd_task_ticket')->row_array();
		return $data;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
        // pre($task_detail['location']);
        // pre($task_detail['location_id']);

		// customize
		// $jenis_pekerjaan = $this->master->master_by_code('jenis_pekerjaan_teknis', $task_detail['category']);
		// $pelaksana = $this->request->get_user_assigned($task_detail['id']);
		// $pelaksana = implode(", ", $pelaksana);
		// customize

		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
		// $arr['jenis_pekerjaan'] = $jenis_pekerjaan['name'];
		// $arr['pelaksana'] = $pelaksana;
		if(!empty($task_detail)):
			foreach($task_detail as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
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

	function data($modul, $status, $filter, $view_mode='')
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');
		$draw = $this->input->post('draw');
		$start  = $this->input->post('start');
		$length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// pre($modul);
		// pre($status);
		// pre($filter);

		// Edit Here
		$this->filtering($filter);
		$this->scope->where('task');
		$this->db->where('task.status', $status);
		$this->db->where('task_category', $modul['categories']);
		$this->db->where('up', '');
		$this->db->select('COUNT({PRE}task.id) as total');
		$qryrecordsTotal = $this->db->get('task')->row_array();
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

			// Edit Here
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;

			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where( $where_string );
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('up', '');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name, usr.name AS user_assigned_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left')
				->join('users usr','task_user_assigned.user_id = usr.id','left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where( $where_string );
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('up', '');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name, usr.name AS user_assigned_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left')
				->join('users usr','task_user_assigned.user_id = usr.id','left');
			$total_filtered = $this->db->get("task")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;

			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('up', '');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name, usr.name AS user_assigned_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left')
				->join('users usr','task_user_assigned.user_id = usr.id','left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
				// pre($row);

				//focus marketing progress
				$subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				//pembuat task
				$pembuat = $row['author_name'];

				//pelaksana
				$pelaksana = !empty($row['user_assigned_name']) ? $row['user_assigned_name'] : 'Tombol Ambil task';

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'date_start'							=> format_date($row['date_start']),
					'subject'								=> $subject,
					'pembuat'								=> $pembuat,
					'lokasi'								=> $lokasi,
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

			case 'ticket_status' :
				$data = $this->master->arr('ticket_status');
				if(!empty($data)):
					foreach($data as $key=>$val):
						$arr[$key] = $val;
					endforeach;
				endif;
			break;

            case 'ticket_type' :
				$data = $this->master->arr('ticket_type');
				if(!empty($data)):
					foreach($data as $key=>$val):
						$arr[$key] = $val;
					endforeach;
				endif;
			break;

            case 'ticket_priority' :
				$data = $this->master->arr('ticket_priority');
				if(!empty($data)):
					foreach($data as $key=>$val):
						$arr[$key] = $val;
					endforeach;
				endif;
			break;

			case 'ticket_helpdesk_status' :
				$data = $this->master->arr('ticket_helpdesk_status');
				if(!empty($data)):
					foreach($data as $key=>$val):
						$arr[$key] = $val;
					endforeach;
				endif;
			break;

			default:
				$arr['test'] = 'Hello';
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		// $arr['hello'] = $this->select_option('hello');
		$arr['ticket_status'] = $this->select_option('ticket_helpdesk_status');
		$arr['ticket_type'] = $this->select_option('ticket_type');
		$arr['ticket_priority'] = $this->select_option('ticket_priority');
		return $arr;
	}

	function get_ticket_child($up)
	{
		$arr = array();
		//get detail ticket
		$this->db->select('task.*, task_log.code AS task_code, users.name AS author_name')
			->join('task_log', 'task.id = task_log.task_id', 'left')
			->join('users', 'task.author = users.id','left')
			->where('task.up', $up);
		$query = $this->db->get('task');
		$data = $query->result_array();
		if ($query->num_rows() > 0) {
			$i=0;
			foreach ($data as $row) {
				$child = $this->get_ticket_child($row['id']);
				$data_child = count($child) > 0 ? $child : array();
				foreach ($row as $key => $value) {
					$arr[$i][$key] = $value;
				}
				$arr[$i]['child'] = $data_child;
				$i++;
			}
		}
		return $arr;
	}

}

/* End of file Model_approval_survey.php */
/* Location: ./application/models/request/Model_approval_survey.php */