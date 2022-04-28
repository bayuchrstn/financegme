<?php
class Model_marketing_progress extends CI_Model {

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
                if(!modul_full_access('marketing_progress') && !modul_full_view('marketing_progress')):
					$this->db->where('author', my_id());
				endif;
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

    function init_mp($customer_id='', $mp_id='')
    {
        $this->db->where('status', '1');
        $this->db->where('customer_id', $customer_id);
        $active_mp = $this->db->get('mp')->row_array();
        if(empty($active_mp)):
            $data = array(
                'customer_id'   => $customer_id,
                'progress'      => '',
                'mp_id'         => $mp_id,
                'status'        => '1',
            );
            $this->db->insert('mp', $data);
            $active_mp_id = $this->db->insert_id();
        else:
            $data = array(
                'mp_id'         => $active_mp['mp_id'].','.$mp_id,
            );
            $this->db->where('customer_id', $customer_id);
            $this->db->where('status', '1');
            $this->db->update('mp', $data);
            $active_mp_id = $active_mp['id'];
        endif;
        return $active_mp_id;
    }

	function hook($task_id, $mode='')
    {
        $arr = array();
        $customer = $this->input->post('location_id');
        $this->init_mp($customer, $task_id);
        $category = $this->input->post('category');
        switch ($category) {
            case 'mp_prospek':

            break;

            case 'mp_pre_survey':

                // init progress started tag
                if($mode=='insert'):
                    // init progress started tag
                    // init progress ->
            		$params = array(
            			'title'		       => 'Progress Pre Survey',
            			'category'	       => 'pre_survey',
            			'location'	       => $this->input->post('location'),
            			'location_id'	   => $this->input->post('location_id'),
            			// 'progress'	       => serialthis($progress),
            			'progress'	       => '',
            			'task_id'	       => $task_id,
                        'label'            => 'Marketing Progress',
                        'code'             => 'marketing_progress',
                        'show_url'         => 'marketing_progress/show/'.$task_id.'/echo',
                    );
                    $progress_result = $this->progress->init($params);

                    // membuat alert ->
              //       $params_alert['link_url'] = 'progress/index/'.$progress_result['progress_id'];
            		// $alert_config = $this->alert->get_config('m1', $params_alert);
            		// $this->alert->create($alert_config);

					$params_alert = array(
						'alert_code'	=> 'm1',
						'title'	=> 'Request Pre Survey',
						'content'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : $this->input->post('subject'),
						'user_id'	=> $this->alert_notif->get_user_by_modul('view_marketing_request'),
						'related_id'	=> $task_id,
						'url_link'	=> 'view_marketing_request'
					);
					$this->alert_notif->insert($params_alert);
            		// membuat alert ->



                endif;

                //kirim ke admin sales
                $arr['request_pre_survey_ts'] = $this->request_pre_survey_ts($task_id);

                //sekalian update seperlunya di master pelanggan
                $arr['update_customer_from_mp'] = $this->update_customer_from_mp($task_id, $customer);
            break;

            case 'mp_survey':
            	if ($mode=='insert') {

            		$params = array(
            			'title'		       => 'Progress Survey',
            			'category'	       => 'survey',
            			'location'	       => $this->input->post('location'),
            			'location_id'	   => $this->input->post('location_id'),
            			// 'progress'	       => serialthis($progress),
            			'progress'	       => '',
            			'task_id'	       => $task_id,
                        'label'            => 'Marketing Progress',
                        'code'             => 'marketing_progress',
                        'show_url'         => 'marketing_progress/show/'.$task_id.'/echo',
                    );
                    $progress_result = $this->progress->init($params);

            		$arr['request_survey_ts'] = $this->request_survey_ts($task_id);
            		// $arr['update_customer_from_mp'] = $this->update_customer_from_mp($task_id, $customer);

            		// membuat alert ->
              //       $params_alert['link_url'] = 'progress/index/'.$progress_result['progress_id'];
            		// $alert_config = $this->alert->get_config('m2', $params_alert);
            		// $this->alert->create($alert_config);
            		$params_alert = array(
            			'alert_code'	=> 'm2',
            			'title'	=> 'Request Survey',
            			'content'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : $this->input->post('subject'),
            			// 'user_id'	=> $this->alert_notif->get_user_by_modul('view_marketing_request'),
            			'user_id'	=> $this->alert_notif->get_user_by_modul('view_marketing_request'),
						'related_id'	=> $task_id,
            			'url_link'	=> 'view_marketing_request'
            		);
            		$this->alert_notif->insert($params_alert);
            		// membuat alert ->
            	}
            	break;

            case 'mp_instalasi':
            	if ($mode=='insert') {

            		$params = array(
            			'title'		       => 'Progress Instalasi',
            			'category'	       => 'installasi',
            			'location'	       => $this->input->post('location'),
            			'location_id'	   => $this->input->post('location_id'),
            			// 'progress'	       => serialthis($progress),
            			'progress'	       => '',
            			'task_id'	       => $task_id,
                        'label'            => 'Marketing Progress',
                        'code'             => 'marketing_progress',
                        'show_url'         => 'marketing_progress/show/'.$task_id.'/echo',
                    );
                    $progress_result = $this->progress->init($params);


            		// $arr['request_instalasi_ts'] = $this->request_install_ts($task_id);
            		$arr['request_instalasi_ts'] = $this->request_approval_install($task_id);

            		$this->request->task_ext($task_id, 'task_marketing_request', array());

            		// membuat alert ->
              //       $params_alert['link_url'] = 'progress/index/'.$progress_result['progress_id'];
            		// $alert_config = $this->alert->get_config('m1', $params_alert);
            		// $this->alert->create($alert_config);
            		$params_alert = array(
						'alert_code'	=> 'req_install',
						'title'	=> 'Request Installasi',
						'content'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : $this->input->post('subject'),
						'user_id'	=> $this->alert_notif->get_user_by_column('jabatan','admin_sales_div_sales_marketing_01_jogja'),
						'related_id'	=> $task_id,
						'url_link'	=> 'admin_sales'
					);
					$this->alert_notif->insert($params_alert);
            		// membuat alert ->
            	}
            	break;

            case 'mp_trial':
            	if ($mode=='insert') {
            		$params = array(
            			'title'		       => 'Progress Trial',
            			'category'	       => 'trial',
            			'location'	       => $this->input->post('location'),
            			'location_id'	   => $this->input->post('location_id'),
            			// 'progress'	       => serialthis($progress),
            			'progress'	       => '',
            			'task_id'	       => $task_id,
                        'label'            => 'Marketing Progress',
                        'code'             => 'marketing_progress',
                        'show_url'         => 'marketing_progress/show/'.$task_id.'/echo',
                    );
                    $progress_result = $this->progress->init($params);

                    // task marketing request
                    $params_mrk_request = array(
                    	'task_id'	=> $task_id,
                    	'date_request_start'	=> $this->input->post('date_start'),
                    	'date_request_end'	=> $this->input->post('date_end'),
                    	'date_penjadwalan'	=> now(),
                    );
                    $this->crud->insert('task_marketing_request', $params_mrk_request, array('id'));
                    // end task marketing request

                    // add to gmd_trial
                    $params_trial = array(
                    	'task_id'	=> $task_id,
                    	'status'	=> 'request',
                    	'flag_lock'	=> '0'
                    );
                    $this->crud->insert('trial', $params_trial, array('id'));
                    //end add to gmd_trial
            	}
            	break;

            case 'mp_billing':
            	// setelah billing menjadi customer
            	// $params_billing = array(
            	// 	'status'	=> 'customer'
            	// );
            	// $this->db->where('id', $customer)
            	// 	->update('customer', $params_billing);
            	break;

            default:
                # code...
                break;
        }
        $arr['hook_debug'] = 'hook debug';
        return $arr;
    }

    function update_customer_from_mp($task_id, $customer)
    {
        $this->load->model('Model_customer', 'customer');
        $data = array(
            'customer_name'         => $this->input->post('customer_name'),
            'customer_address'      => $this->input->post('customer_address'),
            'koordinat'             => $this->input->post('koordinat'),
        );
        $this->db->where('id', $customer);
        $this->db->update('customer', $data);
        $res_sid = $this->customer->save_customer_sid($customer);
    }

	function hook_old($task_id)
	{
		$arr = array();

        //membuat request ke TS untuk pre survey
        if($this->input->post('category')=='mp_pre_survey'):
            $arr['request_pre_survey_ts'] = $this->request_pre_survey_ts($task_id);
        endif;

		//membuat request ke TS untuk survey
		//meminta aaproval ke manajer marketing untuk "lanjut" ke proses installasi
		if($this->input->post('category')=='mp_survey'):
        	$arr['request_survey_ts'] = $this->request_survey_ts($task_id);
			$arr['request_approval_install'] = $this->request_approval_install($task_id);
		endif;

        //membuat request ke TS untuk installasi
		if($this->input->post('category')=='mp_instalasi'):
        	$arr['request_install_ts'] = $this->request_install_ts($task_id);
		endif;

		return $arr;
	}

	function tabs()
	{
		return array();
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
		// $detail = $dt;

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

							default:
								$this->db->where($col, $val);
								break;
						}
					endif;
				endforeach;

			endif;
		endif;
	}

	function data($modul, $filter, $view_mode='')
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$post_order = $this->input->post('order');
		$post_columns = $this->input->post('columns');
		$post_search = $this->input->post('search');

		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $post_order[0]['column'];
	    $orderBy = $post_columns[$orderByColumnIndex]['name'];
	    $orderType = $post_order[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// pre($modul);
		// pre($filter);

		// Edit Here
		$this->filtering($filter);
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
			// $this->db->order_by('id', 'desc');
			$this->db->order_by($orderBy, $orderType);
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
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
			// $this->db->order_by('id', 'desc');
			$this->db->order_by($orderBy, $orderType);
			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------
			$this->db->where( $where_string );
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
			// $this->db->order_by('id', 'desc');
			$this->db->order_by($orderBy, $orderType);
			$this->filtering($filter);

			// ------------------------------------------------------------------------
			$this->scope->where('task');
			if($view_mode !='report'):
				if(!modul_full_access($modul['code']) && !modul_full_view($modul['code'])):
					$this->db->where('author', my_id());
				endif;
			endif;
			// ------------------------------------------------------------------------

			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('marketing.name as marketing_name');
			$this->db->select('mpp.name as mpp_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
			$this->db->join('master mpp', 'mpp.code = task.category and mpp.category=\'marketing_progress_category\' ', 'left');
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
                switch ($row['category']) {
                    // case 'mp_pre_survey':
                        // $subject = '<a href="'.base_url('progress/index/'.$row['progress_id']).'">'.clean_string($row['subject'], 40).'</a>';
                        // $subject = '<a onclick="show_progress('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
                    // break;

                    default:
                        $subject = '<a onclick="show_this('.$row['id'].');" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';
                    break;
                }


				$mp_level = $row['mpp_name'];

				// action button
				$dt_action['action_button'] = array();
				if($view_mode=='report'):
					$dt_action['action_button'][] = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-eye"></i> Detail</a>';
				else:
					$dt_action['action_button'][] = '<a onclick="update_marketing_progress(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				endif;

				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'urut'									=> $urut,
					'id'	=> $row['id'],
					'marketing_name'						=> $row['marketing_name'],
					'subject'								=> $subject,
					'judul'	=> $row['subject'],
					'customer_name'							=> $row['customer_name'],
					'date'									=> format_date($row['date_start']),
					'marketing_progress_category'			=> $mp_level,
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
	        "modul" 			=> $modul,
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
			case 'marketing':
				$this->db->group_by('task.author');
				$this->db->where('task_category', 'marketing_progress');
				$this->db->select('author.name as marketing_name');
				$this->db->select('author.id as marketing_id');
				$this->db->join('users author', 'author.id = task.author', 'left');
				$data = $this->db->get('task')->result_array();
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['marketing_id']] = $row['marketing_name'];
					endforeach;
				endif;
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
		$arr['customer'] = $this->select_option('customer');
		$arr['marketing'] = $this->select_option('marketing');
		return $arr;
	}


    // custom below

    function check_request_pre_survey_ts($task_id)
    {
        $this->db->where('up', $task_id);
        $this->db->where('task_category', 'mrk');
		$this->db->where('category', 'pre_survey');
        return $this->db->get('task')->row_array();
    }

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

    function request_pre_survey_ts($task_id, $params=array())
    {
        $detail_up = $this->request->detail($task_id);
		$arr = array();
        $check = $this->check_request_pre_survey_ts($task_id);
        if(empty($check)):
            $data = array(
                'up' => $detail_up['id'],
                'progress_id' => $detail_up['progress_id'],
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'mrk',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'pre_survey',
                'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
                'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
                // 'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'belum_dikirim',
                'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'sudah_dikirim',
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

    function request_survey_ts($task_id, $params=array())
    {
    	$detail_up = $this->request->detail($task_id);
		$arr = array();
        $check = $this->check_request_survey_ts($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'progress_id' => $detail_up['progress_id'],
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'mrk',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'survey',
                'author' => (isset($params['author']) && $params['author'] !='') ? $params['author'] : my_id(),
                'date_created' => (isset($params['date_created']) && $params['date_created'] !='') ? $params['date_created'] : now(),
                // 'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'belum_dikirim',
                'status' => (isset($params['status']) && $params['status'] !='') ? $params['status'] : 'sudah_dikirim',
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
    	$detail_up = $this->request->detail($task_id);
		$arr = array();
        $check = $this->check_request_install_ts($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'progress_id' => $detail_up['progress_id'],
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'mrk',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'installasi_new',
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
            $last_id = $this->db->insert_id();
            $arr['task_id'] = $last_id;
			$arr['query_insert_install_ts'] = $this->db->last_query();
			$params = array();
			$this->request->task_ext($last_id, 'task_marketing_request', $params);
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
    	$detail_up = $this->request->detail($task_id);
		$arr = array();
        $check = $this->check_request_approval_install($task_id);
        if(empty($check)):
            $data = array(
                'up' => $task_id,
                'progress_id' => $detail_up['progress_id'],
                'task_category' => (isset($params['task_category']) && $params['task_category'] !='') ? $params['task_category'] : 'approval_install',
                // 'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : '',
                'category' => (isset($params['category']) && $params['category'] !='') ? $params['category'] : 'installasi_new',
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
            $last_id = $this->db->insert_id();
			$arr['query_insert_approval_install'] = $this->db->last_query();
			$params_mrk_approval = array(
				'task_id'	=> $last_id,
				'date_response'	=> '0000-00-00 00:00:00',
				'author_response'	=> '0',
				'note'	=> (isset($params['subject']) && $params['subject'] !='') ? $params['subject'] : 'Approval Install',
			);
			$this->db->insert('task_marketing_approval', $params_mrk_approval);
			$arr['query_insert_approval_install_mrk'] = $this->db->last_query();
        endif;
		return $arr;
    }

    function check_request_trial($task_id)
    {
        $this->db->where('up', $task_id);
        $this->db->where('category', 'approval_install');
        return $this->db->get('task')->row_array();
    }

}
