<?php
class Model_marketing_progress extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function sub_title()
	{
		$sub_title = $this->load->view('component/misc/panel_sub_title', '', TRUE);
		return $sub_title;
	}

	//membuat array untuk pilihan pelanggan ketika akan membuat marketing progresss
	function arr_mp_customer_picker()
	{
		$this->db->where('status', 'pre_customer');
		$data = $this->db->get('customer')->result_array();
		return arr($data, 'id', 'customer_name');
	}

	//untuk update status marketing progress pelanggan
	function update_status()
	{
		$this->db->where('category', 'marketing_progress_category');
		$data_master = $this->db->get('master')->result_array();
		$arr = array();
		foreach($data_master as $mst):
			$arr[$mst['code']]	= $mst['order'];
		endforeach;
		// pre($arr);

		$db_max_mp = $this->meta->get_by_key('customer', $this->input->post('location_id'), 'max_mp');
		// jika masih kosong langsung insert aja
		if($db_max_mp==''):
			$this->meta->set('customer', $this->input->post('location_id'), 'max_mp', $this->input->post('category'));
		// kalau ada isinya dicek dulu
		else:
			$current_step = $arr[$db_max_mp];
			$new_progress = $this->input->post('category');
			$new_progress = $arr[$new_progress];
			if($new_progress > $current_step):
				$this->meta->set('customer', $this->input->post('location_id'), 'max_mp', $this->input->post('category'));
			endif;
		endif;

	}

	function get_category_order($code)
	{
		$this->db->where('code', $code);
		$this->db->where('category', 'marketing_progress_category');
		$data = $this->db->get('master')->row_array();
		return $data['order'];
	}

	function max_mp_level($customer_id='1')
	{
		$current_mp = array();
		$this->db->group_by('task.category');
		$this->db->where('task.location_id', $customer_id);
		$this->db->where('task.task_category', 'marketing_progress');
		// $this->db->select('DISTINCT(category) as mp_level');
		$this->db->select('task.id AS id, task.category as mp_level')
			->join('master','master.code = task.category AND {PRE}master.`category` = \'marketing_progress_category\'', 'left')
			->order_by('master.order', 'asc');
		$cur_mp = $this->db->get('task')->result_array();
		if(!empty($cur_mp)):
			foreach($cur_mp as $row):
				// pre($row['mp_level']);
				$current_mp[] = $row['mp_level'];
			endforeach;
		endif;

		// $dicari = array('mp_billing', 'mp_pre_survey');

		$step = array(
			'mp_prospek' 			=> 1,
			'mp_pre_survey' 		=> 2,
			'mp_survey'				=> 3,
			'mp_instalasi'			=> 4,
			'mp_trial'				=> 5,
			'mp_billing'			=> 6
		);
		$max = 0;
		foreach($step as $langkah=>$nilai):
			// pre($langkah);
			if(in_array($langkah, $current_mp)):
				$max = $nilai;
			endif;
		endforeach;

		// pre($cur_mp);exit;
		// echo $max; exit;

		//check report
		$laporan = array(
			'pre_survey'		=> 2,
			'survey'			=> 3,
			'installasi_new'	=> 4
		);
		if ($max == 5) {
			$this->db->where('task_id', $cur_mp[count($cur_mp)-1]['id'])
				->where('status', 'done');
			$report = $this->db->get('trial')->num_rows();
			$max = $report==0 ? $max : $max+1;
		} elseif ($max > 5 || $max==0 || $max==1) {
			$max = $max+1;
		} else {
			$urutan = ['prospek','pre_survey','survey', 'installasi_new'];
			// echo $max.'-';
			$this->db->select('id, category');
			$this->db->where('task_category', 'task_report')
				->where('location_id', $customer_id)
				->where('category', $urutan[$max-1]);
			$report = $this->db->get('task')->result_array();

			if (!empty($report)) {
				foreach ($report as $row) {
					$current_report[] = $row['category'];
				}

				foreach ($laporan as $langkah=>$value) {
					if ( in_array($langkah, $current_report) ) {
						$max = $value+1;
					}
				}
			} else {
				$max = $max;
			}
			// pre($report);
		}
		// echo $max; exit;

		return $max;
	}

	//untuk menampilan marketing category picker
	function get_category($customer_id)
	{
		//max diisi angka 1 - 6
		$max = $this->max_mp_level($customer_id);

		$this->db->order_by('order', 'asc');
		$this->db->where("`order` BETWEEN '0' AND '".$max."'");
		$this->db->where('category', 'marketing_progress_category');
		$data['data'] = $this->db->get('master')->result_array();
		$data['query'] = $this->db->last_query();
		// pre($data);
		return $data;
	}

	// generate warna marketing progress
	function get_color($key)
	{
		switch ($key) {
			case 'mp_prospek':
				$color_code = 'default';
			break;

			case 'mp_pre_survey':
				$color_code = 'warning';
			break;

			case 'mp_survey':
				$color_code = 'danger';
			break;

			case 'mp_instalasi':
				$color_code = 'info';
			break;

			case 'mp_trial':
				$color_code = 'primary';
			break;

			case 'mp_billing':
				$color_code = 'success';
			break;

		}
		return $color_code;
	}

	function filtering($filter='')
	{
		if($filter !=''):
			$filter = un_filter_serialthis($filter);
			// pre($filter);
			$this->db->where('location_id', $filter['location_id']);
		endif;
	}

	function data($filter)
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
		// $qryrecordsTotal = $this->db->query("SELECT COUNT(id) as total FROM {PRE}task WHERE task_category='marketing_progress' ")->row_array();
		$this->filtering($filter);
		$this->db->where('task_category', 'marketing_progress');
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
			$this->filtering($filter);
			$this->db->where('task_category', 'marketing_progress');
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('author.name as author_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
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
				$subject = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['subject'], 40).'</a>';

				//mp_category
				// $color = $this->get_color($row['category']);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update_marketing_progress(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'date'									=> format_date($row['date_start']),
					'author'								=> $row['author_name'],
					'subject'								=> $subject,
					'customer_name'							=> $row['customer_name'],
					'marketing_progress_category'			=> '',
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

	function existing($mode='pre_customer')
	{
		$arr = array();
		switch ($mode) {
			case 'author':
				$this->db->where('task_category', 'marketing_progress');
				$this->db->select('DISTINCT({PRE}users.name) as cl, {PRE}users.id as author_id');
				$this->db->join('users', 'users.id = task.author', 'left');
				$data = $this->db->get('task')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['author_id']] = $row['cl'];
					endforeach;
				endif;
			break;

			//pre customer
			default:
				$this->db->where('task_category', 'marketing_progress');
				$this->db->select('DISTINCT(customer_name) as cl, pre_customer.id as pre_customer_id');
				$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
				$data = $this->db->get('task')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['pre_customer_id']] = $row['cl'];
					endforeach;
				endif;
			break;
		}

		return($arr);
	}

	function buil_search_param()
	{
		$arr = array();
		$arr['pre_customer'] = $this->existing('pre_customer');
		$arr['author'] = $this->existing('author');
		return $arr;
	}

	function boleh_request_installasi($customer)
	{
		$this->db->where('task_category', 'approval_install');
		$this->db->where('location_id', $customer);
		$this->db->where('status', 'approved');
		$data = $this->db->get('task')->result_array();
		if(!empty($data)):
			return true;
		else:
			return false;
		endif;
	}

}
