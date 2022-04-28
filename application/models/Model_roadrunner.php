<?php
require APPPATH.'models/Model_report_item.php';
class Model_roadrunner extends Model_report_item {

   	function __construct()
    {
        parent:: __construct();
    }

    function info_modul($request_code)
	{
		// $this->db->where('up', '1001');
        $this->db->where('note', 'req');
		$this->db->where('code', $request_code);
		$data = $this->db->get('modul')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

    function tabs($what='')
	{
        return $this->$what('tabs');
	}

    function set_ui($what='')
	{
        return $this->$what('set_ui');
	}

    function js_table($what='')
	{
        return $this->$what('js_table');
	}

    function item_debug($what='')
	{
        $modul_item = $this->$what('js_table', '');
        pre($modul_item);
        // $jstable = json_encode($modul_item['jstable']);
        // echo $jstable;
        // return $modul_item['set_ui'];
	}

    function filtering($filter='')
	{

    }

    function data($what='', $filter='')
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
		$this->scope->where('task');

		$this->db->where('task_category', $what);
		$this->db->select('COUNT({PRE}task.id) as total');
		$qryrecordsTotal = $this->db->get('task')->row_array();

		$recordsTotal = $qryrecordsTotal['total'];

		if( $post_search['value'] ):
			// search
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
			// search

			// Edit Here
			$this->db->order_by('id', 'desc');
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
			$this->db->where('task_category', $what);
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('marketing.name as marketing_name');
			$this->db->select('mpp.name as mpp_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('master mpp', 'mpp.code = task.category and mpp.category=\'marketing_progress_category\' ', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->db->order_by('id', 'desc');
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
			$this->db->where('task_category', $what);
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('marketing.name as marketing_name');
			$this->db->select('mpp.name as mpp_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('master mpp', 'mpp.code = task.category and mpp.category=\'marketing_progress_category\' ', 'left');
			$total_filtered = $this->db->get("task")->num_rows();
			// pre($this->db->last_query());
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			$this->db->order_by('id', 'desc');
			$this->filtering($filter);
			$this->scope->where('task');

			$this->db->where('task_category', $what);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$query = $this->db->get("task", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();

		// $formated_data = array();

        $params = array();
        $params['data'] = $data;
        $modul_item = $this->$what('datatable', $params);
        // pre($modul_item['datatable']);
        $formated_data = $modul_item;
        // pre($formated_data);

		// if(!empty($data)):
		// 	$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
		// 	foreach($data as $row):
		// 		$urut++;
        //
		// 		$subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
        //
		// 		$dt_action['action_button'] = array();
		// 		$dt_action['action_button'][] = '<a onclick="update_marketing_progress(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
		// 		$action = $this->load->view('component/action_button/default', $dt_action, TRUE);
        //
		// 		$formated_data[] = array(
    	// 				'id'									=> 'ssss',
    	// 				'author_name'						    => 'sssss',
    	// 				'subject'								=> 'ssss',
    	// 				'date'									=> 'ssszzzssssss',
    	// 			);
		// 	endforeach;
		// endif;
        // pre($formated_data);

		$response = array(
    	        "draw" 				=> intval($draw),
    	        "recordsTotal" 		=> $recordsTotal,
    	        "recordsFiltered" 	=> $recordsFiltered,
    	        "data" 				=> $formated_data,
    			//debuging
    	        // "modul" 			=> $modul,
    	    );

	    echo json_encode($response);
    }

}
