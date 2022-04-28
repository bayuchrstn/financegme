<?php
class Model_barang_replace extends CI_Model {

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
				'Permintaan Barang Keluar' => '#'
			);
		$arr['main_action'] = array();
		$arr['table_column'] = array();
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		$this->request->task_ext($task_id, 'task_laporan_harian', $params);
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
		$arr['daftar_barang_kembali'] = $this->permintaan_barang->daftar_barang_kembali($task_detail['id']);
        $arr['daftar_barang_keluar'] = $this->permintaan_barang->daftar_barang_keluar($task_detail['id']);
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
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;
			if ($status=='request')
				$this->db->where('flock', 'n');
			// $this->db->order_by('id', 'desc');
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
				$detail = '<a onclick="show_this('.$row['id'].')" href="javascript:void(0);">Detail</a>';

				$task_ref = $this->request->detail($row['up']);

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Approval</a>';
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

	function select_option($mode='ref_task_out_item')
	{
		$arr = array();
		switch ($mode) {
			case 'ref_task_out_item' :
				$this->db->group_by('pelaksana.task_id');
				$where_category = "(task.category='installasi' OR task.category='replace' OR task.category='general' )";
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

			case 'status_barang_kembali':
				$arr['baik'] = 'Baik';
				$arr['rusak'] = 'Rusak';
				$arr['garansi'] = 'Garansi';
			break;

			case 'approval_status':
				$arr['approved'] = 'Sudah diapprove';
				$arr['request'] = 'Belum diapprove';
			break;

			case 'terima_status':
				$arr['diterima'] = 'Diterima';
				$arr['request_in'] = 'Belum diterima';
			break;

			default:
				$arr['ok'] = 'OK';
			break;


		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['ref_task_out_item'] = $this->select_option('ref_task_out_item');
		$arr['status_barang_kembali'] = $this->select_option('status_barang_kembali');
		$arr['approval_status'] = $this->select_option('approval_status');
		$arr['terima_status'] = $this->select_option('terima_status');
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

	function detail_item_masuk($id)
	{
		$this->load->model('Model_bcn', 'bcn');
		$arr = array();
		$this->db->where('id', $id);
		$detail = $this->db->get('task_item_in')->row_array();
		if(!empty($detail)):
			foreach($detail as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
		$arr['nomor_mac'] = $this->bcn->item_detail_info($detail['item_detail_id'], 'nomor_mac');
		$item_id = $this->bcn->item_detail_info($detail['item_detail_id'], 'item_id');
		$arr['bcn'] = $this->bcn->item_info($item_id);

		return $arr;
	}

	function barang_masuk_approve($task_id='')
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_item_in')->result_array();
		if(!empty($data)):
			//dicek dulu ada gak request yang belum "diterima"
			//jika ada yang gak boleh di approve
			//sigudang harus "menerima" item barangnya terlebih dahulu
			foreach($data as $row):
				if($row['status']=='request_in'):
					return FALSE; exit;
				endif;
			endforeach;

			//silahken monggo.. boleh di approve sama mas Gudang
			return TRUE;

		else:
			//jika kosong artinya belum ada request masuk maka gak boleh melakukan approval
			//apanya yang amau di approve hah ? requestnya aja gak ada
			return FALSE;
		endif;
	}

    function barang_keluar_approve($task_id='')
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_item_out')->result_array();
		if(!empty($data)):
			//dicek dulu ada gak request yang belum "diterima"
			//jika ada yang gak boleh di approve
			//sigudang harus "menerima" item barangnya terlebih dahulu
			foreach($data as $row):
				if($row['item_detail_id']==''):
					return FALSE; exit;
				endif;
			endforeach;

			//silahken monggo.. boleh di approve sama mas Gudang
			return TRUE;

		else:
			//jika kosong artinya belum ada request masuk maka gak boleh melakukan approval
			//apanya yang amau di approve hah ? requestnya aja gak ada
			return FALSE;
		endif;
	}

    function get_approval_in($task_id)
    {
        $this->db->where('task_id', $task_id);
		return $this->db->get('task_item_in')->result_array();
    }

    function get_approval_out($task_id)
    {
        $this->db->where('task_id', $task_id);
		return $this->db->get('task_item_out')->result_array();
    }
}
