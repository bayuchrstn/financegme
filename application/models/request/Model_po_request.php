<?php
class Model_po_request extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget($mode, $modul)
	{
		$arr = array();
		$arr['modul'] = $modul;
		switch ($mode) {
			default:
				$this->db->order_by('id', 'desc');
                $this->scope->where('task');
				$this->db->where('task_category', 'marketing_progress');
				$this->db->select('task.*');
				$this->db->select('author.name as author_name');
				$this->db->select('mp_jenis.name as mp_jenis_name');
				$this->db->join('users author', 'author.id = task.author', 'left');
				$this->db->join('master mp_jenis', 'mp_jenis.code = task.category and mp_jenis.category=\'marketing_progress_category\' ', 'left');
				$data = $this->db->get('task', 10)->result_array();
				$arr['last_mp'] = $data;
			break;
		}
		return $arr;
	}

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function hook($task_id)
	{
		$arr = array();
        $this->save_task_item($task_id);
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

    function tabs()
	{
		$arr = array();

		$arr['selected'] = array(
			'name'=>'Request',
			'code'=>'requestor',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
				array('label'   => 'judul'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		$arr[] = array(
			'name'=>'Warehouse',
			'code'=>'warehouse',
			'table_columns' => array(
                array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Dari'),
				array('label'   => 'Lokasi'),
                array('label'   => 'judul'),
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
                array('label'   => 'judul'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			)
		);
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
	}

	function get_task_ext($task_id, $detail)
	{
		$data = array();

		$this->db->where('up', $task_id);
		$this->db->where('task_category', 'mrk');
		$this->db->select('task_marketing_request.date_request_start as tanggal_request');
		$this->db->join('task_marketing_request', 'task_marketing_request.task_id = task.id', 'left');
		$dt = $this->db->get('task')->row_array();

		if($detail['category']=='mp_survey'):
			$data['tanggal_request_survey'] = $dt['tanggal_request'];
		else:
			$data['tanggal_request_survey'] = '';
		endif;

		$data['tanggal_request_install'] = '';
		return $data;
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Marketing request' => '#'
			);

		if($this->uri->segment(2)=='r'):
			$arr['main_action'] = array();
		else:
			$arr['main_action'] = array(
					'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
				);
		endif;



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

	function sub_title($filter='', $url='')
	{
		$data['sub_info'] = array();
		if($filter !=''):
			$filter = un_filter_serialthis($filter);
			// pre($filter);
			if(!empty($filter)):
				foreach($filter as $col=>$val):
					if($val !=''):
						switch ($col) {
							case 'location_id':
								$lokasi = $lokasi = $this->location->show('customer', $val);
								$data['sub_info'][] = 'lokasi : '.$lokasi;
							break;

							case 'author':
								$marketing = $this->user->detail($val);
								$data['sub_info'][] = 'marketing : '.$marketing['name'];
							break;


						}
					endif;
				endforeach;
			endif;
		endif;

		$data['reset'] = base_url().$url.'';
		return $this->load->view('component/misc/panel_sub_title', $data, TRUE);
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
		$arr['mp_level'] = $this->master->master_name_by_code('marketing_progress_category', $task_detail['category']);
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
			if(!empty($filter)):
				foreach($filter as $col=>$val):
					if($val !=''):
						// pre($col);
						switch ($col) {
							case 'author':
								$this->db->where('author', $val);
							break;


						}
					endif;
				endforeach;

			endif;
		endif;
	}

	function data($modul, $status, $filter, $view_mode='')
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
		// ------------------------------------------------------------------------
		$this->scope->where('task');
		if($view_mode !='report'):
			if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
				$this->db->where('author', my_id());
			endif;
		endif;
		// ------------------------------------------------------------------------

		$this->db->where('task_category', $modul['categories']);
		$this->db->select('COUNT({PRE}task.id) as total');
		// $this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
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
            $this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
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
            $this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
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

			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
            $this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
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
				$subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

                //lokasi
				$lokasi = $this->location->show($row['location'], $row['location_id']);

                $dt_action['action_button'] = array();
                $dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'author_name'						    => $row['author_name'],
					'subject'								=> $subject,
					'lokasi'							    => $lokasi,
					'date'									=> format_date($row['date_start']),
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
			//debuging
	        // "modul" 			=> $modul,
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {

            case 'status_request':
				$arr['requestor'] = 'progress';
				$arr['warehouse'] = 'Kirim Ke Gudang';
			break;

            case 'po_category':
                $cat = $this->master->arr('po_category');
                foreach($cat as $code=>$label):
                  $arr[$code] = $label;
				endforeach;
			break;

			//pre customer
			default:
				$this->scope->where('customer');
				$this->db->where('status', 'pre_customer');
				if(!modul_full_access('marketing_progress') && !modul_full_view('marketing_progress')):
					$this->db->where('id_am', my_id());
				endif;

				$data = $this->db->get('customer')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['customer_name'];
					endforeach;
				endif;
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['po_category'] = $this->select_option('po_category');
		$arr['status_request'] = $this->select_option('status_request');
		return $arr;
	}


    // custom below

    function check_request_survey_ts($task_id)
    {
        $this->db->where('up', $task_id);
        $this->db->where('task_category', 'mrk');
		$this->db->where('category', 'install');
        return $this->db->get('task')->row_array();
    }

	function check_request_install_ts($task_id)
    {
        $this->db->where('up', $task_id);
        $this->db->where('task_category', 'mrk');
        $this->db->where('category', 'new_install');
        return $this->db->get('task')->row_array();
    }

    function request_survey_ts($task_id, $params=array())
    {
		$arr = array();
        $check = $this->check_request_survey_ts($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'mrk',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'survey',
                'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
                'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
                'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'belum_dikirim',
                'date_start' => (isset($params['date_start']) && $params['date_start'] !='') ? $params['date_start'] : now(),
                'date_due' => (isset($params['date_due']) && $params['date_due'] !='') ? $params['date_due'] : '',
                'subject' => (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : $this->input->post('subject'),
                'body' => (isset($params['body']) && $params['body'] !='') ? $params['body'] : $this->input->post('body_fake'),
                'regional' => (isset($params['regional']) && $params['regional'] !='') ? $params['regional'] : session_scope_regional(),
                'area' => (isset($params['area']) && $params['area'] !='') ? $params['area'] : session_scope_area(),
                'location' => (isset($params['location']) && $params['location'] !='') ? $params['location'] : $this->input->post('location'),
                'location_id' => (isset($params['location_id']) && $params['location_id'] !='') ? $params['location_id'] : $this->input->post('location_id'),
            );
            $this->db->insert('task', $data);
			$arr['query_insert_survey_ts'] = $this->db->last_query();
			$params = array();
			$this->request->task_ext($this->db->insert_id(), 'task_marketing_request', $params);
        endif;
		return $arr;
    }

	function request_install_ts($task_id, $params=array())
    {
		$arr = array();
        $check = $this->check_request_install_ts($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'mrk',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'new_install',
                'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
                'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
                'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : '',
                'date_start' => (isset($params['date_start']) && $params['date_start'] !='') ? $params['date_start'] : now(),
                'date_due' => (isset($params['date_due']) && $params['date_due'] !='') ? $params['date_due'] : '',
                'subject' => (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : 'Request Installasi',
                'body' => (isset($params['body']) && $params['body'] !='') ? $params['body'] : 'Isi Request survey',
                'regional' => (isset($params['regional']) && $params['regional'] !='') ? $params['regional'] : session_scope_regional(),
                'area' => (isset($params['area']) && $params['area'] !='') ? $params['area'] : session_scope_area(),
                'location' => (isset($params['location']) && $params['location'] !='') ? $params['location'] : 'customer',
                'location_id' => (isset($params['location_id']) && $params['location_id'] !='') ? $params['location_id'] : $this->input->post('location_id'),
            );
            $this->db->insert('task', $data);
			$arr['query_insert_install_ts'] = $this->db->last_query();
			$params = array();
			$this->request->task_ext($this->db->insert_id(), 'task_marketing_request', $params);
        endif;
		return $arr;
    }

	function check_request_approval_install($task_id)
    {
        $this->db->where('up', $task_id);
        $this->db->where('category', 'approval_install');
        return $this->db->get('task')->row_array();
    }

	function request_approval_install($task_id, $params=array())
    {
		$arr = array();
        $check = $this->check_request_approval_install($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'approval_install',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : '',
                'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
                'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
                'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'request',
                'date_start' => (isset($params['date_start']) && $params['date_start'] !='') ? $params['date_start'] : now(),
                'date_due' => (isset($params['date_due']) && $params['date_due'] !='') ? $params['date_due'] : '',
                'subject' => (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : 'Approval Install',
                'body' => (isset($params['body']) && $params['body'] !='') ? $params['body'] : 'Approval Install',
                'regional' => (isset($params['regional']) && $params['regional'] !='') ? $params['regional'] : session_scope_regional(),
                'area' => (isset($params['area']) && $params['area'] !='') ? $params['area'] : session_scope_area(),
                'location' => (isset($params['location']) && $params['location'] !='') ? $params['location'] : $this->input->post('location'),
                'location_id' => (isset($params['location_id']) && $params['location_id'] !='') ? $params['location_id'] : $this->input->post('location_id'),
            );
            $this->db->insert('task', $data);
			$arr['query_insert_approval_install'] = $this->db->last_query();
        endif;
		return $arr;
    }

}
