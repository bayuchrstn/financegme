<?php
class Model_ticket_email extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function info_modul()
	{
		// $this->db->where('up', '1001');
        // $this->db->where('note', 'req');
		$this->db->where('code', 'ticket_inbox');
		$data = $this->db->get('modul')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

    function tabs()
    {
        $arr = array();

        //tabs
        $arr['selected'] = array(
    			'name'=>'Email Baru',
    			'code'=>'baru',
    			'table_columns' => array(
    				array('label'   => '#', 'width'=>'5'),
    				array('label'   => 'Dari', 'width'=>'200'),
    				array('label'   => 'Subject'),
                    array('label'   => 'tanggal', 'width'=>'200'),
    				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    			)
    		);
        $arr[] = array(
    			'name'=>'Sudah Dibuat Ticket',
    			'code'=>'open',
    			'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
    				array('label'   => 'Dari', 'width'=>'200'),
    				array('label'   => 'Subject'),
                    array('label'   => 'tanggal', 'width'=>'250'),
    				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
    			)
    		);
        return $arr;
    }

    function set_ui()
	{
        $arr = array();
        $arr['main_action'] = array();
        $arr['table_column'] = array(
                array('label'   => '#', 'width'=>'5'),
                array('label'   => 'Tanggal'),
                array('label'   => 'Marketing'),
                array('label'   => 'Customer'),
                array('label'   => 'Judul'),
            );
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
                'data'				=> 'from',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'subject',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'date',
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

    function data($status, $filter)
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

        $this->db->where('status', $status);
		$this->db->select('COUNT({PRE}ticket_email .id) as total');
		$qryrecordsTotal = $this->db->get('ticket_email ')->row_array();

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
            $this->db->where('status', $status);
			$this->db->select('ticket_email.*');
			$query = $this->db->get("ticket_email", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;

		$data = $query->result_array();

		$formated_data = array();

		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;

				// $subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

                if($row['status']=='baru'):
    				$dt_action['action_button'] = array();
    				$dt_action['action_button'][] = '<a onclick="open_ticket(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Open Ticket</a>';
    				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);
                else:
                    $action = '';
                endif;
                
				$formated_data[] = array(
    					'id'									=> $urut,
    					'from'						            => $row['fromaddr'],
    					'subject'								=> $row['subject'],
    					'date'									=> $row['maildate'],
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
    	        // "modul" 			=> $modul,
    	    );

	    echo json_encode($response);
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get('ticket_email')->row_array();
        return $data;
    }

}
