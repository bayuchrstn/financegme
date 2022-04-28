<?php
class Model_customer_call extends CI_Model {

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
		$params['form_action'] = base_url().'xhr/customer_care/update/';
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
			'name'=>'Open',
			'code'=>'open',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
		        array('label'   => 'Pelanggan'),
		        array('label'   => 'Customer Service'),
		        array('label'   => 'Action', 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Close',
			'code'=>'close',
			'table_columns' => array(
                array('label'   => '#', 'width'=>'5'),
                array('label'   => 'Tanggal'),
                array('label'   => 'Pelanggan'),
                array('label'   => 'Customer Service'),
                array('label'   => 'Action', 'width'=>'80'),
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
					'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
					// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
					// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
				);
		endif;


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
        $this->db->where('task_id', $task_id);
		$data = $this->db->get('task_customer_care')->row_array();
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


                //lokasi
				$lokasi = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($this->location->show($row['location'], $row['location_id']), 40).'</a>';


				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'date_start'							=> format_date($row['date_start']),
					'lokasi'								=> $lokasi,
                    'pembuat'								=> $row['author_name'],
					'action'								=> $action,
				);
			endforeach;
		endif;
		// exit;
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data,
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
			case 'customer' :
                $this->db->where('status', 'customer');
                $this->db->where('status_active !=', '0');
                $this->db->order_by('customer_name', 'asc');
				$data = $this->db->get('customer')->result_array();
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['customer_name'];
					endforeach;
				endif;
			break;

            case 'category' :
                $arr['gangguan'] = 'Gangguan';
                $arr['permintaan'] = 'Permintaan';
                $arr['informasi'] = 'Informasi';
			break;

            case 'feedback' :
                $arr['1'] = '1';
                $arr['2'] = '2';
                $arr['3'] = '3';
                $arr['4'] = '4';
                $arr['5'] = '5';
			break;

            case 'status' :
                $arr['open'] = 'Open';
                $arr['close'] = 'Close';
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
		$arr['customer'] = $this->select_option('customer');
		$arr['category'] = $this->select_option('category');
		$arr['feedback'] = $this->select_option('feedback');
		$arr['status'] = $this->select_option('status');
		return $arr;
	}
}
