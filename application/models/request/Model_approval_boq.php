<?php
class Model_approval_boq extends CI_Model {

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
		$arr['save_boq'] = $this->save_boq($task_id);
		return $arr;
	}

	function save_boq($task_id)
    {
		$arr = array();
		$cart = $this->cart->contents();
		// $key = $this->cart_to_key($cart);
		// $data = $this->cart_to_arr($cart);

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
		return $arr;

    }

	function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Permintaan Approval',
			'code'=>'request_approval',
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
			'name'=>'Selesai',
			'code'=>'approved',
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
				'BOQ' => '#'
			);

		$arr['main_action'] = array();

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
		$this->request->task_ext($task_id, 'task_pekerjaan_teknis', $params);
	}

	function get_task_ext($task_id)
	{
		$data = array();
		return $data;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);

		// customize
		$jenis_pekerjaan = $this->master->master_by_code('jenis_pekerjaan_teknis', $task_detail['category']);
		$pelaksana = $this->request->get_user_assigned($task_detail['id']);
		$pelaksana = implode(", ", $pelaksana);
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
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where( $where_string );
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
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
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
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

				//pelaksana
				$pembuat = $row['author_name'];

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Approval</a>';
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
			case 'referensi_survey' :
				// $this->db->like('tag', 'teknis');
				$this->db->where('task_category', 'marketing_progress');
				$this->db->where('category', 'mp_survey');
				$this->db->select('task.id, task.subject');
				$this->db->select('customer.customer_name');
				$this->db->join('customer', 'task.location_id = customer.id', 'left');
				$data = $this->db->get('task')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['customer_name'].' - '.$row['subject'];
					endforeach;
				endif;
			break;

			case 'item_selector' :
				$arr['barang'] = 'Barang';
				$arr['custom'] = 'Custom';
			break;

            case 'approval_boq' :
				$arr['revisi'] = 'Revisi';
				$arr['hold'] = 'Tahan';
				$arr['denied'] = 'Tolak';
			break;

			case 'supplier' :
				$data = $this->db->get('supplier')->result_array();
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['supplier_name'];
					endforeach;
				endif;
			break;



			//pre customer
			default:
				$arr['test'] = 'Hello';
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['hello'] = $this->select_option('hello');
		$arr['referensi_survey'] = $this->select_option('referensi_survey');
		$arr['item_selector'] = $this->select_option('item_selector');
		$arr['supplier'] = $this->select_option('supplier');
		$arr['approval_boq'] = $this->select_option('approval_boq');
		return $arr;
	}
}
