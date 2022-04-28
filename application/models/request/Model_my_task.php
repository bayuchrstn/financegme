<?php
class Model_my_task extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget()
	{
		return array();
	}

	function hook($task_id, $mode='')
	{
		$arr = array();
		switch ($mode) {
			case 'insert':
				// code...
				break;
			
			default:
				// code...
				break;
		}
		return $arr;
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);

		$jenis_pekerjaan = $this->master->master_by_code('jenis_pekerjaan_teknis', $task_detail['category']);
		$pelaksana = $this->request->get_user_assigned($task_detail['id']);
		$pelaksana = implode(", ", $pelaksana);

		$arr['jenis_pekerjaan'] = $jenis_pekerjaan['name'];
		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
		$arr['pelaksana'] = $pelaksana;

		if(!empty($task_detail)):
			foreach($task_detail as $key=>$val):
				$arr[$key] = $val;
			endforeach;
		endif;
		return $arr;
	}

	function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Progress',
			'code'=>'progress',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Pekerjaan'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
				array('label'   => 'Jenis Pekerjaan'),
		        array('label'   => 'Action'),
			)
		);
		$arr[] = array(
			'name'=>'Selesai',
			'code'=>'selesai',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Pekerjaan'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
		        array('label'   => 'Jenis Pekerjaan'),
		        array('label'   => 'Action'),
			)
		);
		$arr[] = array(
			'name'=>'Belum Selesai',
			'code'=>'belum_selesai',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Pekerjaan'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
		        array('label'   => 'Jenis Pekerjaan'),
		        array('label'   => 'Action'),
			)
		);
		return $arr;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Pekerjaan Saya' => '#'
			);
		$arr['main_action'] = array(
				// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
				// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
			);
		$arr['table_column'] = array();
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		$this->request->task_ext($task_id, 'task_pekerjaan_teknis', $params);
	}

	function get_task_ext($task_id)
	{
		$data = array();
		return $data;
	}

	function filtering($filter='')
	{
		if($filter !=''):
			$filter = un_filter_serialthis($filter);
			// pre($filter);
			if (!empty($filter['location_id'])) {
				$this->db->where('location_id', $filter['location_id']);
			}
			if (!empty($filter['category'])) {
				$this->db->where('task.category', $filter['category']);
			}
		endif;
	}

	function data($modul, $status, $filter)
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');
		$draw = $this->input->post('draw');
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// pre($modul);
		// pre($status);
		// pre($filter);

		// Edit Here
		$this->filtering($filter);
		$this->db->where('task.status', $status);
		$this->db->where('task_category', $modul['categories']);
		$this->db->where('flock', 'n');
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
			$this->db->group_by('task.id');
			$this->filtering($filter);
			$this->db->where( $where_string );

			if (!empty($this->input->post('jenis_pekerjaan'))) {
				$this->db->where('category', $this->input->post('jenis_pekerjaan'));
			}

			$this->db->where('task_user_assigned.user_id', my_id());
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->db->group_by('task.id');
			$this->filtering($filter);
			$this->db->where( $where_string );
			$this->db->where('task_user_assigned.user_id', my_id());
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left');
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

			$this->db->group_by('task.id');
			$this->filtering($filter);
			$this->db->where('task_user_assigned.user_id', my_id());
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$this->db->join('task_user_assigned', 'task_user_assigned.task_id = task.id', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());
			$recordsFiltered = $recordsTotal;
            $last_query = $this->db->last_query();
		endif;
		$data = $query->result_array();

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
				// pre($row);

				//focus marketing progress
				$subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
				// $subject = clean_string($row['subject'], 40);

				//lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

				// action button
				$dt_action['action_button'] = array();
				// $dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class=" icon-display"></i> Request barang</a>';
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-file-check"></i> Buat Laporan</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'subject'								=> $subject,
					'date_start'							=> format_date($row['date_start']),
					'date_due'								=> format_date($row['date_due']),
					'lokasi'								=> $lokasi,
					'author_name'							=> $row['author_name'],
					'task_category_name'					=> $row['task_category_name'],
					'action'								=> $action,
				);
			endforeach;
		endif;
		// exit;
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data,
	        "last_query" 	 => $last_query,
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
            // ----------------------------------------
			case 'jenis_primary_link_survey' :
                $arr['fo'] = 'Fiber Optic';
                $arr['wr'] = 'Wireless';
			break;

            case 'jenis_secondary_link_survey' :
                $arr['tidak_ada'] = 'Tidak Ada';
                $arr['fo'] = 'Fiber Optic';
                $arr['wr'] = 'Wireless';
			break;




            // ----------------------------------------

            case 'jenis_primary_link_install' :
                $arr['fo'] = 'Fiber Optic';
                $arr['wr'] = 'Wireless';
			break;

            case 'jenis_secondary_link_install' :
                $arr['tidak_ada'] = 'Tidak Ada';
                $arr['fo'] = 'Fiber Optic';
                $arr['wr'] = 'Wireless';
			break;
            // ----------------------------------------

			// case 'status_pekerjaan_survey':
			// 	$arr = array(
			// 		'progress'	=> 'Progress',
			// 		'belum_selesai'	=> 'Belum Selesai',
			// 		'need_approval'	=> 'Selesai',
			// 	);
			// 	break;

			//pre customer
			default:
				$arr['progress'] = 'Progress';
				$arr['selesai'] = 'Selesai';
				$arr['belum_selesai'] = 'belum Selesai';
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();

		$arr['status_pekerjaan'] = $this->select_option('status_pekerjaan');
		// $arr['status_pekerjaan_survey'] = $this->select_option('status_pekerjaan_survey');
		$arr['jenis_primary_link'] = $this->select_option('jenis_primary_link');
		$arr['jenis_secondary_link'] = $this->select_option('jenis_secondary_link');

		$arr['jenis_primary_link_survey'] = $this->select_option('jenis_primary_link_survey');
		$arr['jenis_secondary_link_survey'] = $this->select_option('jenis_secondary_link_survey');

        $arr['jenis_primary_link_install'] = $this->select_option('jenis_primary_link_install');
		$arr['jenis_secondary_link_install'] = $this->select_option('jenis_secondary_link_install');
		return $arr;
	}

    function update_task_status($task_id)
    {
        $data = array(
                'status' => $this->input->post('status_pekerjaan')
            );
        $this->db->where('id', $task_id);
        $this->db->update('task', $data);
    }

    function modal_report_ui($category)
    {
        // pre($category);
        $arr = array();
        switch ($category) {
            case 'pre_survey':
                $arr['modal_title'] = 'Laporan Pre Survey';
            break;

            case 'survey':
                $arr['modal_title'] = 'Laporan Survey';
            break;

            case 'installasi':
                $arr['modal_title'] = 'Laporan Installasi';
            break;

            case 'installasi_new':
                $arr['modal_title'] = 'Laporan Installasi Baru';
            break;

            case 'dismantle':
                $arr['modal_title'] = 'Laporan Dismantle';
            break;

            case 'replace':
                $arr['modal_title'] = 'Laporan Replace';
            break;
            //pre survey
            default:
                $arr['modal_title'] = 'Laporan Pekerjaan';
            break;
        }
        // pre($arr);
        return $arr;
    }

    //masih ngebug ketika update/laporan ulang dan item barang dikurangi / cancel dipasang
    function save_barang_dipasang($item_barang, $report_id)
    {
        $arr = array();
        if(!empty($item_barang)):
            foreach($item_barang as $row):
                $cek = $this->db->query("SELECT * FROM {PRE}item_transaction WHERE id_item='".$row['item_id']."' AND id_item_detail='".$row['item_detail_id']."' AND location='".$this->input->post('location')."' AND location_id='".$this->input->post('location_id')."' AND status='install' ")->row_array();
                if(empty($cek)):
                    $arr[] = array(
                            'id_item'           => $row['item_id'],
                            'id_item_detail'    => $row['item_detail_id'],
                            'location'          => $this->input->post('location'),
                            'location_id'       => $this->input->post('location_id'),
                            'status'            => 'install',
                            'dev'               => '1',
                            'date_install'      => now(),
                        );

                    // update status barang
                    $this->db->where('id', $row['item_detail_id']);
                    $this->db->update('item_detail', array('item_status' => 'install'));
                endif;
            endforeach;
            if(!empty($arr)):
                $this->db->insert_batch('item_transaction', $arr);
            endif;
        endif;
        return $arr;
    }

    function save_barang_installasi_new($report_id='')
    {
    	$report = $this->db->where('id', $report_id)->get('task')->row_array();
    	$where_req = array(
    		'up'	=> $report['up'],
    		'task_category'	=> 'request_out',
    		'status'	=> 'approved',
    		'location_id'	=> $report['location_id']
    	);
    	$request_out = $this->db->where($where_req)->get('task')->row_array();
    	$task_item_out = $this->db->where('task_id', $request_out['id'])->where('status','approved')->get('task_item_out')->result_array();
    	$arr = array();
    	if (!empty($task_item_out)) {
    		foreach ($task_item_out as $row) {
    			$arr[] = array(
    				'id_item'           => $row['item_id'],
					'id_item_detail'    => $row['item_detail_id'],
					'location'          => $this->input->post('location'),
					'location_id'       => $this->input->post('location_id'),
					'status'            => 'install',
					'dev'               => '1',
					'date_install'      => now(),
    			);
    		}

    		if(!empty($arr)):
                $this->db->insert_batch('item_transaction', $arr);
            endif;
    	}
    }
}
