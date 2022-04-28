<?php
class Model_approval_pre_customer_install extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
        $this->load->model('request/model_marketing_progress','marketing_progress');
    }

	function widget()
	{
		return array();
	}

	function hook($task_id,$mode='insert')
	{
		$detail = $this->request->detail($task_id);
		$detail_up = $this->request->detail($detail['up']);
		$arr = array();
		if ($mode=='update') {
			// $params = array();
			/*
			$params = array(
    			'title'		       => 'Progress Instalasi',
    			'category'	       => 'installasi',
    			'location'	       => $this->input->post('location'),
    			'location_id'	   => $this->input->post('location_id'),
    			// 'progress'	       => serialthis($progress),
    			'progress'	       => '',
    			'task_id'	       => $task_id,
                'label'            => 'Marketing Progress',
                'code'             => 'marketing_progress',
                'show_url'         => 'marketing_progress/show/'.$task_id.'/echo',
            );
            $arr['progress_result'] = $this->progress->init($params);
            */

            $params_adm_sales = array(
            	'subject' => $detail_up['subject'],
                'body' => $detail_up['body'],
                'location' => $detail_up['location'],
                'location_id' => $detail_up['location_id'],
            );

			$arr['request_instalasi_ts'] = $this->marketing_progress->request_install_ts($task_id, $params_adm_sales);

			$this->db->where('task_id', $detail_up['id']);
			$mr = $this->db->get('task_marketing_request')->row_array();
			$this->request->task_ext($arr['request_instalasi_ts']['task_id'], 'task_marketing_request', array('date_request_start' => $mr['date_request_start']));
		}
		return $arr;
	}

	function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Request',
			'code'=>'request',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Pre Customer'),
				array('label'   => 'Marketing'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Approved',
			'code'=>'approved',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Pre Customer'),
				array('label'   => 'Marketing'),
				array('label'   => 'Tanggal Approve'),
				array('label'   => 'User Approve'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Reject',
			'code'=>'reject',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Pre Customer'),
				array('label'   => 'Marketing'),
				array('label'   => 'Tanggal Reject'),
				array('label'   => 'User Reject'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		$params['date_response'] = now();
		$params['author_response'] = my_id();
		$params['note'] = $this->input->post('note_fake');
		$this->request->task_ext($task_id, 'task_marketing_approval', $params);
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function get_task_ext($task_id)
	{
		$data = array();
		return $data;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Marketing request' => '#'
			);
		$arr['main_action'] = array();
		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Marketing'),
				array('label'   => 'Customer'),
				array('label'   => 'Judul'),
				array('label'   => 'Status'),
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
			if (!empty($filter['location_id'])) {
				$this->db->where('location_id', $filter['location_id']);
			}
		endif;
	}

	function data($modul, $status, $filter)
	{
		// pre($status);
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

		// pre($modul);
		// pre($filter);

		// Edit Here
		$this->filtering($filter);
		$this->db->where('task.task_category', $modul['categories']);
		$this->db->where('task.status', $status);
		$this->db->select('COUNT({PRE}task.id) as total');
		// $this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
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
			$this->db->where( $where_string );
			$this->scope->where('task');
			$this->db->order_by($orderBy, $orderType);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('task.status', $status);
			$this->db->select('task.*');
			$this->db->select('task_marketing_approval.date_response as date_response');
			$this->db->select('task_marketing_approval.author_response as author_response');
			$this->db->select('task_marketing_approval.note as note');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('task_marketing_approval', 'task_marketing_approval.task_id = task.id', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->db->where( $where_string );
			$this->scope->where('task');
			$this->db->order_by($orderBy, $orderType);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('task.status', $status);
			$this->db->select('task.*');
			$this->db->select('task_marketing_approval.date_response as date_response');
			$this->db->select('task_marketing_approval.author_response as author_response');
			$this->db->select('task_marketing_approval.note as note');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('task_marketing_approval', 'task_marketing_approval.task_id = task.id', 'left');
			$total_filtered = $this->db->get("task")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->order_by($orderBy, $orderType);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('task.status', $status);
			$this->db->select('task.*');
			$this->db->select('task_marketing_approval.date_response as date_response');
			$this->db->select('task_marketing_approval.author_response as author_response');
			$this->db->select('task_marketing_approval.note as note');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('task_marketing_approval', 'task_marketing_approval.task_id = task.id', 'left');
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

				//lokasi
				$lokasi = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($this->location->show($row['location'], $row['location_id']), 40).'</a>';

				//focus marketing progress
				$subject = clean_string($row['subject'], 40);


				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				switch ($status) {
					case 'reject':
					case 'approved':
						$formated_data[] = array(
								'id'									=> $urut,
								'date_start'							=> format_date($row['date_start']),
								'precustomer_name'						=> $lokasi,
								'marketing_name'						=> $row['author_name'],
								'date_response'							=> $row['date_response'],
								'author_response'						=> $row['author_response'],
								'action'								=> $action,
							);
					break;

					default:
						$formated_data[] = array(
								'id'									=> $urut,
								'date_start'							=> format_date($row['date_start']),
								'precustomer_name'						=> $lokasi,
								'marketing_name'						=> $row['author_name'],
								'action'								=> $action,
							);
					break;
				}

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

	function select_option($mode='customer_approval_status')
	{
		$arr = array();
		switch ($mode) {


			//pre customer
			default:
				$arr = array(
						'approved'	=> 'Approve',
						'reject'	=> 'Reject',
					);
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['customer_approval_status'] = $this->select_option('customer_approval_status');
		return $arr;
	}


    // custom below


}
