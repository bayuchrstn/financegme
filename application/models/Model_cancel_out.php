<?php
class Model_cancel_out extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_config($modul)
    {
        $this->db->where('modul', $modul);
        $this->db->order_by('sort', 'asc');
        $this->db->select('approval_confiq.*');
        $this->db->select('users.name');
        $this->db->join('users', 'users.id = approval_confiq.user_id', 'left');
        $data = $this->db->get('approval_confiq')->result_array();
        return $data;
    }

    function get_data()
    {

    }

    function info_modul()
	{
		$this->db->where('code', 'cancel_out');
		$data = $this->db->get('modul')->row_array();
		return $data;
	}

    function set_ui()
	{
        $arr = array();
        $arr['main_action'] = array(
            // '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
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

        $arr['selected'] = array(
                'name'   => 'Request',
                'code'   => 'cancel_request',
                'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
                    array('label'   => 'User', 'width'=>'200'),
                    array('label'   => 'Nama Barang'),
                    array('label'   => 'Nomor Barang / Mac Address'),
                    array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
                )
            );
        $arr[] = array(
                'name'   => 'Approved',
                'code'   => 'cancel_aproved',
                'table_columns' => array(
                    array('label'   => '#', 'width'=>'5'),
                    array('label'   => 'User', 'width'=>'200'),
                    array('label'   => 'Nama Barang'),
                    array('label'   => 'Nomor Barang / Mac Address'),
                    array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
                )
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
                'data'				=> 'author',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'nama_barang',
                'searchable'		=> false,
                'orderable'			=> false,
            );
        $jstable[] = array(
                'data'				=> 'nomor_barang',
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

        $this->db->where('task_item_out_cancel.status', $category);
		$this->db->select('COUNT({PRE}task_item_out_cancel.id) as total');
		$qryrecordsTotal = $this->db->get('task_item_out_cancel ')->row_array();

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
            $this->db->where('task_item_out_cancel.status', $category);
			$this->db->select('task_item_out_cancel.*');
			$this->db->select('users.name as author');
            $this->db->join('users', 'users.id = task_item_out_cancel.author', 'left');
			$query = $this->db->get("task_item_out_cancel", $length, $start);
			$recordsFiltered = $recordsTotal;
		endif;

		$data = $query->result_array();

		$formated_data = array();

        $optd = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
                // pre($row);

                $item_info = $this->bcn->item_info($row['item_id']);
                $nomac = $this->bcn->item_detail_info($row['item_detail_id'], 'nomor_mac');

				// $subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Approval</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
    					'id'                       => $urut,
    					'author'                   => $row['author'],
    					'nama_barang'              => $item_info,
    					'nomor_barang'             => $nomac,
    					'detail'                   => 'deta',
    					'action'                   => $action,
    				);
			endforeach;
		endif;
        // pre($formated_data);
        // exit;

		$response = array(
    	        "draw" 				=> intval($draw),
    	        "recordsTotal" 		=> $recordsTotal,
    	        "recordsFiltered" 	=> $recordsFiltered,
    	        "data" 				=> $formated_data,
    			//debuging
    	        "optd" 			     => $optd,
    	        "last" 			     => $this->db->last_query(),
    	    );

	    echo json_encode($response);
    }

    function detail($id)
    {
        $arr = array();
        $this->db->where('id', $id);
        $data = $this->db->get('task_item_out_cancel')->row_array();
        if(!empty($data)):
            $nama_barang = $this->bcn->item_info($data['item_id'], 'default');
            $nomor_barang = $this->bcn->item_detail_info($data['item_detail_id'], 'nomor_barang');
            $mac_address = $this->bcn->item_detail_info($data['item_detail_id'], 'mac_address');
            $arr['nama_barang'] = $nama_barang;
            $arr['nomor_barang'] = $nomor_barang;
            $arr['mac_address'] = $mac_address;

            foreach($data as $row=>$val):
                $arr[$row] = $val;

            endforeach;
        endif;
        return $arr;
    }

}
