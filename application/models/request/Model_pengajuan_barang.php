<?php
class Model_pengajuan_barang extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget()
	{
		return array();
	}

	function hook($task_id)
	{
		$arr = array();
		$arr['save_pengadaan'] = $this->save_pengadaan($task_id);
        // $this->save_task_item($task_id);
		return $arr;
	}

    function save_task_item($task_id)
    {
		$arr = array();
		$cart = $this->cart->contents();

		$arr_sql = array();
		foreach($cart as $data):

            $sql = "INSERT INTO {PRE}task_pengadaan (task_id, item_id, supplier, qty, price, mode) VALUES ('".$task_id."', '".$data['name']."', '".$data['options']['supplier']."', '".$data['qty']."', '".$data['price']."', '".$data['options']['mode']."')";
            $qcek = "SELECT * from {PRE}task_pengadaan WHERE task_id='".$task_id."' AND item_id='".$data['name']."' ";
            $cek = $this->db->query($qcek)->result_array();
            if(empty($cek)):
                $this->db->query($sql);
            endif;

		endforeach;
		$arr['arr_sql'] = $arr_sql;
		$this->cart->destroy();
		return $arr;

    }

	function save_pengadaan($task_id)
    {
		$arr = array();
		$cart = $this->cart->contents();
		// $key = $this->cart_to_key($cart);
		// $data = $this->cart_to_arr($cart);

		$arr_sql = array();
		foreach($cart as $data):

			if($data['options']['type']=='recomended'):
				$sql = "INSERT INTO {PRE}task_pengadaan (task_id, item_id, supplier, qty, price, mode) VALUES ('".$task_id."', '".$data['name']."', '".$data['options']['supplier']."', '".$data['qty']."', '".$data['price']."', '".$data['options']['mode']."')";
				$qcek = "SELECT * from {PRE}task_pengadaan WHERE task_id='".$task_id."' AND item_id='".$data['name']."' AND supplier='".$data['options']['supplier']."' ";
				$cek = $this->db->query($qcek)->result_array();
				if(empty($cek)):
					$this->db->query($sql);
				endif;
			else:
				$sql = "INSERT INTO {PRE}task_pengadaan_pembanding (task_id, item_id, supplier, qty, price, mode) VALUES ('".$task_id."', '".$data['name']."', '".$data['options']['supplier']."', '".$data['qty']."', '".$data['price']."', '".$data['options']['mode']."')";
				$qcek = "SELECT * from {PRE}task_pengadaan_pembanding WHERE task_id='".$task_id."' AND item_id='".$data['name']."' AND supplier='".$data['options']['supplier']."' ";
				$cek = $this->db->query($qcek)->result_array();
				if(empty($cek)):
					$this->db->query($sql);
				endif;
			endif;

			$arr_sql[] = $sql;

		endforeach;
		$arr['arr_sql'] = $arr_sql;
		$this->cart->destroy();
		return $arr;

    }

    function params_ext($task_id)
	{
		$params = array();
		$params['custom_action'] = base_url().'ajax/item_out_approval';
		$params['info_request'] = '<h1>sdcdsc</h1>';
		$params['form_approval'] = 'ini data object';
		return $params;
	}

	function tabs()
	{
		$arr = array();

        $arr['selected'] = array(
			'name'=>'Warehouse',
			'code'=>'warehouse',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Detail'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
        $arr[] = array(
			'name'=>'Approval',
			'code'=>'approval',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Detail'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Final',
			'code'=>'final',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
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
				'Pengajuan Barang' => '#'
			);
		$arr['main_action'] = array(
				// '<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i>Pengajuan Barang </a>',
				// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
				// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
			);
		$arr['table_column'] = array();
		return $arr;
	}

	function task_ext($task_id)
	{
        return array();
		// $params = array();
		// $this->request->task_ext($task_id, 'task_laporan_harian', $params);
	}

	function get_task_ext($task_id)
	{
		return array();
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
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
			$this->db->order_by('id', 'desc');
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

				//focus marketing progress
				$detail = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);">'.$row['subject'].'</a>';

				$task_ref = $this->request->detail($row['up']);

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
    					'id'									=> $urut,
						'date'									=> format_date($row['date_start']),
    					'author'								=> $row['author_name'],
    					'location'								=> $lokasi,
						// 'task_ref_title'						=> clean_string($task_ref['subject'], 3060),
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
	        "data" 				    => $formated_data,
	        "last_query" 	         => $this->db->last_query(),
	    );
	    echo json_encode($response);
	}

	function select_option($mode='ref_task_out_item')
	{
		$arr = array();
		switch ($mode) {
			case 'item_selector' :
				$arr['barang'] = 'Barang';
				$arr['custom'] = 'Custom';
			break;

            case 'status_request':
				$arr['progress'] = 'progress';
				$arr['request_wh'] = 'Kirim Ke Gudang';
			break;

            case 'status_request_gudang':
                $arr['warehouse'] = 'Warehouse';
				$arr['approval'] = 'Request Approval';
			break;

			case 'supplier' :
				$data = $this->db->get('supplier')->result_array();
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['supplier_name'];
					endforeach;
				endif;
			break;

		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['item_selector'] = $this->select_option('item_selector');
		$arr['supplier'] = $this->select_option('supplier');
		$arr['status_request'] = $this->select_option('status_request');
		$arr['status_request_gudang'] = $this->select_option('status_request_gudang');
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
					'qty'				=> $row['qty'],
					'name'				=> $row['name'],
					'owner_status'		=> $row['options']['item_installed_owner_status'],
				);
			endforeach;
		endif;
		return($arr);
	}


}
