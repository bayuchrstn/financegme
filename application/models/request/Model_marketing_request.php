<?php
class Model_marketing_request extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget($mode, $modul)
	{
		// pre($mode);
		// pre($modul);
		$arr = array();
		switch ($mode) {

			//sudah dikirim tapi belum dijadwalkan
			case 'dashboard_mr_belum_dijadwalkan':
				$this->db->order_by('id', 'desc');
				$this->db->where('task_category', 'mrk');
				$this->db->where('task.status', 'sudah_dikirim');
				$this->db->select('task.*');
				$this->db->select('author.name as author_name');
				$this->db->join('users author', 'author.id = task.author', 'left');
				$data = $this->db->get('task', 10)->result_array();
				// pre($this->db->last_query());
				$arr[$mode] = $data;
			break;

			//sudah dijadwalkan
			case 'dashboard_mr_sudah_dijadwalkan':
				$this->db->order_by('id', 'desc');
				$this->db->where('task_category', 'mrk');
				$this->db->where('task.status', 'sudah_dijadwalkan');
				$this->db->select('task.*');
				$this->db->select('author.name as author_name');
				$this->db->join('users author', 'author.id = task.author', 'left');
				$data = $this->db->get('task', 10)->result_array();
				// pre($this->db->last_query());
				$arr[$mode] = $data;
			break;

			//sales admin
			default:
				$this->db->order_by('id', 'desc');
				$this->db->where('task_category', 'mrk');
				$this->db->where('task.status', 'belum_dikirim');
				$this->db->select('task.*');
				$this->db->select('author.name as author_name');
				$this->db->join('users author', 'author.id = task.author', 'left');
				$data = $this->db->get('task', 10)->result_array();
				// pre($this->db->last_query());
				$arr[$mode] = $data;
			break;
		}
		return $arr;
	}

	function sub_title($filter='', $url='')
	{
		return '';
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function hook($task_id)
	{
		$arr = array();
		return $arr;
	}

	function tabs()
	{
		return array();
	}

	function task_ext($task_id)
	{
		$params = array();
		$this->request->task_ext($task_id, 'task_marketing_request', $params);
	}

	function get_task_ext($task_id)
	{
    	$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_marketing_request')->row_array();
		return $data;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Marketing request' => '#'
			);
		if($this->uri->segment(2)=='r'):
			$arr['main_action'] = array();
		else:
			$arr['main_action'] = array(
					'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
				);
		endif;

		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
	        	array('label'   => 'Tanggal Request'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
	        	array('label'   => 'Judul'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			);
		return $arr;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
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

	function data($modul, $filter, $view_mode='')
	{
		// pre($modul);
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');

		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['name'];
	    $orderType = $post_order[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// Edit Here
		$this->filtering($filter);

		// ------------------------------------------------------------------------
		$this->scope->where('task');
		if($view_mode !='report'):
			if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
				$this->db->where('author', my_id());
			endif;
		endif;
		// ------------------------------------------------------------------------
		$this->db->where('task_category', $modul['categories']);
		$this->db->select('COUNT({PRE}task.id) as total');
		$this->db->join('task_marketing_request', 'task_marketing_request.task_id = task.id', 'left');
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
			$this->db->order_by($orderBy, $orderType);
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('task_marketing_request.date_request_start as tanggal_request');
			$this->db->select('marketing.name as marketing_name');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('task_marketing_request', 'task_marketing_request.task_id = task.id', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('task_marketing_request.date_request_start as tanggal_request');
			$this->db->select('marketing.name as marketing_name');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('task_marketing_request', 'task_marketing_request.task_id = task.id', 'left');
			$total_filtered = $this->db->get("task")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			// $this->db->order_by('task_marketing_request.date_request_start', 'asc');
			$this->db->order_by($orderBy, $orderType);
			$this->filtering($filter);
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('task_marketing_request.date_request_start as tanggal_request');
			$this->db->select('marketing.name as marketing_name');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('task_marketing_request', 'task_marketing_request.task_id = task.id', 'left');
			$query = $this->db->get("task", $length, $start);
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
				//$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
				// $subject = clean_string($row['subject'], 40);
                $subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				// action button
				$dt_action['action_button'] = array();
				if($view_mode=='report'):
					$dt_action['action_button'][] = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-eye"></i> Detail</a>';
				else:
					$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				endif;


				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'marketing_name'						=> $row['marketing_name'],
					'subject'								=> $subject,
					'customer_name'							=> $lokasi,
					'date'									=> format_date($row['tanggal_request'], ''),
					// 'marketing_progress_category'			=> 'wwww',
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

	function build_select_option()
	{
		$arr = array();
		$arr['customer'] = $this->select_option('customer');
		return $arr;
	}
}
