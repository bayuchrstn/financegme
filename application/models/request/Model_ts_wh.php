<?php
class Model_ts_wh extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function hook($task_id)
	{
		$arr = array();
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

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function data($filter)
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

		// Edit Here
		$this->filtering($filter);
		$this->db->where('task_category', 'request_ts');
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
			$this->db->select('patient.*');
			$query = $this->db->get("patient", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->db->where( $where_string );
			$total_filtered = $this->db->get("patient")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			$this->filtering($filter);
			$this->db->where('task_category', 'request_ts');
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('marketing.name as marketing_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
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
				$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//mp_category
				// $color = $this->get_color($row['category']);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'marketing_name'						=> $row['marketing_name'],
					'subject'								=> $subject,
					'customer_name'							=> $row['customer_name'],
					'date'									=> format_date($row['date_start']),
					'marketing_progress_category'			=> 'wwww',
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
}
