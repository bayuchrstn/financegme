<?php
class Model_request_in extends CI_Model {

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
            case 'dashboard_ri_request':
                $this->db->order_by('id', 'desc');
                $this->db->where('task_category', 'request_in');
                $this->db->where('task.status', 'request');
                $this->db->select('task.*');
                $this->db->select('author.name as author_name');
                $this->db->join('users author', 'author.id = task.author', 'left');
                $data = $this->db->get('task', 10)->result_array();
                // pre($this->db->last_query());
                $arr[$mode] = $data;
            break;

			default:
				$this->db->order_by('id', 'desc');
				$this->db->where('task_category', 'request_in');
				$this->db->where('task.status', 'approved');
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

	function hook($task_id)
	{
		$arr = array();
		$arr['save_item_in'] = $this->save_item_in($task_id);
		return $arr;
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Request',
			'code'=>'request',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Dari'),
				array('label'   => 'Task'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Tanggal Request'),
				array('label'   => 'Detail'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Approved',
			'code'=>'approved',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Dari'),
				array('label'   => 'Task'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Tanggal Request'),
				array('label'   => 'Detail'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		return $arr;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Permintaan Barang Kembali' => '#'
			);
		$arr['main_action'] = array(
				'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
			);
		$arr['table_column'] = array();
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
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
		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
		$arr['daftar_barang_kembali'] = $this->permintaan_barang->daftar_barang_kembali($task_detail['id']);
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
			// $this->db->where('location_id', $filter['location_id']);
		endif;
	}

	function data($modul, $status, $filter)
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

		// pre($modul);
		// pre($filter);

		// Edit Here
		$this->filtering($filter);
		 $this->db->where('task.status', $status);
		$this->db->where('task_category', $modul['categories']);
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
					if ($column=='customer.customer_name') :
						$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
						$where_string_x .= "bts.bts_name like '%".$post_search['value']."%' OR ";
						$where_string_x .= "master.name like '%".$post_search['value']."%' OR ";
					else:
						$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
					endif;
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
			if ($status=='request')
				$this->db->where('flock', 'n');
			$this->db->where( $where_string );
			$this->filtering($filter);
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('customer', 'customer.id = task.location_id', 'left');
			$this->db->join('bts', 'bts.id = task.location_id AND task.location=\'bts\'', 'left')
				->join('master','master.code = task.location_id AND master.category= task.location','left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			if ($status=='request')
				$this->db->where('flock', 'n');
			$this->db->where( $where_string );
			$this->filtering($filter);
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('customer', 'customer.id = task.location_id', 'left');
			$this->db->join('bts', 'bts.id = task.location_id AND task.location=\'bts\'', 'left')
				->join('master','master.code = task.location_id AND master.category= task.location','left');
			$total_filtered = $this->db->get("task")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			// Edit Here
			// $this->db->order_by('id', 'desc');
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;
			if ($status=='request')
				$this->db->where('flock', 'n');
			$this->filtering($filter);
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
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
				$detail = '<a onclick="show_this('.$row['id'].')" href="javascript:void(0);">Detail</a>';


				$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				$task_ref = $this->request->detail($row['up']);

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'author'								=> $row['author_name'],
					'task_ref_title'						=> clean_string($task_ref['subject'], 3060),
					'location'								=> $lokasi,
					'date'									=> format_date($row['date_start']),
					'detail'								=> $detail,
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

	function select_option($mode='ref_task_in_item')
	{
		$arr = array();
		switch ($mode) {

			case 'ref_task_in_item' :
				$this->db->group_by('pelaksana.task_id');
				$where_category = "(task.category='dismantle')";
				$this->db->where($where_category);
				$this->db->where('pelaksana.user_id', my_id());
				$this->db->where('task_category', 'task_teknis');
				$this->db->select('task.*');
				$this->db->join('task_user_assigned pelaksana', 'pelaksana.task_id = task.id', 'left');
				$data = $this->db->get('task')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['subject'];
					endforeach;
				endif;
			break;

		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['ref_task_in_item'] = $this->select_option('ref_task_in_item');
		return $arr;
	}

	function cart_to_key($cart)
	{
		$arr = array();
		if(!empty($cart)):
			foreach($cart as $row):
				$key = $row['id'];
				// pre($key);
				$arr[] = $key;
			endforeach;
		endif;
		return($arr);
	}

    function cart_to_arr($cart)
	{
		$arr = array();
		if(!empty($cart)):
			foreach($cart as $row):
				// pre($row);
				$arr[] = array(
					'id'				=> $row['id'],
					'codition'			=> $row['options']['kondisi'],
					'transaction_id'	=> $row['options']['transaction_id'],
				);
			endforeach;
		endif;
		return($arr);
	}

    function save_item_in($task_id)
    {
        $arr = array();
		$cart = $this->cart->contents();

        if(!empty($cart)):
    		foreach($cart as $row):

                $data = array(
                        'task_id'               => $task_id,
                        'author'                => my_id(),
                        'transaction_id'        => $row['options']['transaction_id'],
                        'item_detail_id'        => $row['name'],
                        'codition'              => $row['options']['condition'],
                        'status'                => 'request_in',
                        'date_post'             => now(),
                        'note'	                => $row['options']['note'],
                    );

                $sql_cek = "SELECT * FROM {PRE}task_item_in WHERE task_id='".$task_id."' AND item_detail_id='".$row['name']."' ";
                $cek = $this->db->query($sql_cek)->result_array();
                if(empty($cek)):
                    $success_insert = $this->db->insert('task_item_in', $data);

                    $this->item_transaction->set_status($row['name'], 'master', 'request_in');
                    $this->item_transaction->set_status($row['options']['transaction_id'], 'transaction', 'request_in');
                endif;

    		endforeach;

            $this->cart->destroy();
        endif;
		return $arr;
    }

	function save_item_in_olddddd($task_id)
    {
		$arr = array();
		$cart = $this->cart->contents();
		// $key = $this->cart_to_key($cart);
		$data = $this->cart_to_arr($cart);

		foreach($data as $row):
			// pre($row);
			//cek di target ada apa tidak?
			$sql_cek = "SELECT * FROM {PRE}task_item_in WHERE task_id='".$task_id."' AND item_detail_id='".$row['id']."' ";
			// pre($sql_cek);
			$cek = $this->db->query($sql_cek)->result_array();
			// pre($this->db->last_query());
			// pre($cek);

			if(empty($cek)):
				$data = array(
					'task_id'				=> $task_id,
					'author'				=> my_id(),
					'transaction_id'		=> $row['transaction_id'],
					'item_detail_id'		=> $row['id'],
					'codition'				=> $row['codition'],
					'status'				=> 'request_in',
					'date_post'				=> now(),
				);
				// pre($data);

				$success_insert = $this->db->insert('task_item_in', $data);
				// if($success_insert):
					// $this->item_transaction->set_status($data['item_detail_id'], 'master', 'approved_out');
				// endif;
			endif;

		endforeach;

		return $arr;

    }

    function current($mode='out', $task_id)
    {
        if($mode=='out'):
            $this->db->where('task_id', $task_id);
    		$data = $this->db->get('task_item_out')->result_array();
        else:
            $this->db->where('task_id', $task_id);
    		$data = $this->db->get('task_item_in')->result_array();
        endif;
        return $data;
    }
}
