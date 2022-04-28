<?php
class Model_approval extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_config($modul)
    {
        $this->db->where('category', $modul);
        $this->db->order_by('sort', 'asc');
        $this->db->select('approval_config.*');
        $this->db->select('approval_config.category as modul, users.name');
        $this->db->join('users', 'users.id = approval_config.user_id', 'left');
        $data = $this->db->get('approval_config')->result_array();
        return $data;
    }

    function get_data()
    {

    }

    function info_modul()
	{
		$this->db->where('code', 'approval');
		$data = $this->db->get('modul')->row_array();
		return $data;
	}

    function set_ui()
	{
        $arr = array();
        $arr['main_action'] = array(
            '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
        );
        $arr['table_column'] = array(
                array('label'   => '#', 'width'=>'5'),
                array('label'   => 'User'),
            );
        return $arr;
	}

    function tabs()
    {
        $arr = array();

        $approval_category = $this->db->get('approval_config_category ')->result_array();
        foreach($approval_category as $row):
            // pre($row);
            //tabs
            $selected = ($row['code']=='boq') ? 'selected' : '';
            $arr[$selected] = array(
        			'name'   => $row['name'],
        			'code'   => $row['code'],
        			'table_columns' => array(
        				array('label'   => '#', 'width'=>'5'),
        				array('label'   => 'User Approval', 'width'=>'200'),
        				array('label'   => 'Options'),
        				array('label'   => 'Final Option'),
        				array('label'   => 'Urutan'),
        				array('label'   => 'Required'),
        				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
        			)
        		);
            endforeach;
        return $arr;
    }

    function js_table()
    {
        $jstable  = array();
        $jstable[] = array(
                'data'				=> 'id',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'user_approval',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'options',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'final_option',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'urutan',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'required',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'action',
                'searchable'		=> false,
                'orderable'			=> false,
            );



        $arr = json_encode($jstable);
        return $arr;
    }

    function data($category, $filter)
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

        $this->db->where('category', $category);
		$this->db->select('COUNT({PRE}approval_config .id) as total');
		$qryrecordsTotal = $this->db->get('approval_config ')->row_array();

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
            $this->db->where('category', $category);
			$this->db->select('approval_config.*');
			$this->db->select('users.name as user_approval');
            $this->db->join('users', 'users.id = approval_config.user_id', 'left');
			$query = $this->db->get("approval_config", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;

		$data = $query->result_array();

		$formated_data = array();

        $optd = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;

                $options = $row['options'];
                $json = utf8_encode($options);
                $optd[] = json_decode( $json );

				// $subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
    					'id'									=> $urut,
    					'user_approval'						    => $row['user_approval'],
    					'options'						        => $row['options'],
    					'final_option'						    => $row['final_option'],
    					'urutan'						        => $row['sort'],
    					'required'						        => $row['required'],
    					'action'								=> $action,
    				);
			endforeach;
		endif;
        // pre($formated_data);

		$response = array(
    	        "draw" 				=> intval($draw),
    	        "recordsTotal" 		=> $recordsTotal,
    	        "recordsFiltered" 	=> $recordsFiltered,
    	        "data" 				=> $formated_data,
    			//debuging
    	        "optd" 			     => $optd,
    	    );

	    echo json_encode($response);
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get('approval_config')->row_array();
        return $data;
    }

}
