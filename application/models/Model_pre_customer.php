<?php
class Model_pre_customer extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function data()
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

		// Total record
		$this->scope->where('customer');
		if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
			$this->db->where('id_am', my_id());
		endif;

		$this->db->where('status', 'pre_customer');
		$this->db->select('COUNT(id) as total');
		$qryrecordsTotal = $this->db->get('customer')->row_array();
		// $qryrecordsTotal = $this->db->query("SELECT COUNT(id) as total FROM {PRE}customer WHERE status !='pre_customer'")->row_array();
		$recordsTotal = $qryrecordsTotal['total'];
		// Total record


		//jika ada pencarion
		if( $this->input->post('search')['value'] ):

			// where
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					// $this->db->or_like($column, $post_search['value']);
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$this->db->where( $where_string );
			// where

			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('status', 'pre_customer');
			$this->db->select('customer.*');
			$query = $this->db->get("customer",$length, $start);
			// pre($this->db->last_query());

			//mencari total data ketika dalam mode pencarian
			// where
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					// $this->db->or_like($column, $post_search['value']);
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$this->db->where( $where_string );
			// where
			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('status', 'pre_customer');
			$total_filtered = $this->db->get("customer")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			$this->db->order_by('id', 'desc');
			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('customer.status', 'pre_customer');
			$this->db->select('customer.*');
			$query = $this->db->get("customer",$length, $start);
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();
		// pre($data);

		//Array dari database diedit dulu biar sesuai dengan output table
		//proses custom data dilakukan di sini
		//contoh dalam case ini adalah membuat marketing progress bar

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
				//focus customer
				// $pre_customer_name = '<a onclick="focus_this(\'js_table_pre_customer\', \''.base_url().'customer/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['customer_name'], 40).'</a>';
				$pre_customer_name = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['customer_name'], 40).'</a>';

				//action form
				$button['update'] = array('label'=>'Update', 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update_customer(\''.$row['id'].'\');" class="edit_button" ');
				$button['timeline'] = array('label'=>'Timeline', 'url'=>'javascript:void(0);', 'icon'=>'icon-calendar52', 'more'=>'onclick="show_timeline(\''.$row['id'].'\');" class="edit_button" ');
				
				$button['mp'] = array('label'=>'Marketing progress', 'url'=>'javascript:void(0);', 'icon'=>'icon-stats-growth', 'more'=>'onclick="input_marketing_progress(\''.$row['id'].'\');" class="edit_button" ');
				// $action = $this->actionform->dropdown($button);
				$action = $this->actionform->button_link($button);

				//marketing progress bar
				$data_mp_bar = array();
				$data_mp_bar['pre_customer_id'] = $row['id'];
				$data_mp_bar['prosentase'] = $this->pre_customer->get_marketing_progress($row['id']);
				$progress_bar = $this->load->view('pre_customer/progress_bar', $data_mp_bar, TRUE);

				if ($row['contact_person']=='') {
					$contact_person = $this->get_contact_person($row['id']);
					$row['contact_person'] = !empty($contact_person) ? $contact_person[0]['name'] : '';
					$row['telephone_work'] = !empty($contact_person) ? ($contact_person[0]['telephone_office']!='' && $contact_person[0]['telephone_office']!='-') ? $contact_person[0]['telephone_office'] : ( ($contact_person[0]['telephone_mobile']!='' && $contact_person[0]['telephone_mobile']!='-') ? $contact_person[0]['telephone_mobile'] : $contact_person[0]['telephone_home'] ) : '-'; 
				}

				$formated_data[] = array(
					'urut'	=> $urut,
					'id'					=> $row['id'],
					'dt_customer_name'			=> $pre_customer_name,
					'customer_name'			=> $row['customer_name'],
					'customer_address'		=> $row['customer_address'],
					'contact_person'		=> $row['contact_person'],
					'telephone_work'		=> $row['telephone_work'],
					'mp_bar'				=> $progress_bar,
					'prosentase_progress'	=> $data_mp_bar['prosentase'],
					'action'				=> $action,
				);
			endforeach;
		endif;
		// pre($formated_data);

		//terakhir .... Create JSON nya
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data
	    );
	    return json_encode($response);
	}

    function data_view()
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

		// Total record
		$this->scope->where('customer');
		if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
			$this->db->where('id_am', my_id());
		endif;

		$this->db->where('status', 'pre_customer');
		$this->db->select('COUNT(id) as total');
		$qryrecordsTotal = $this->db->get('customer')->row_array();
		// $qryrecordsTotal = $this->db->query("SELECT COUNT(id) as total FROM {PRE}customer WHERE status !='pre_customer'")->row_array();
		$recordsTotal = $qryrecordsTotal['total'];
		// Total record


		//jika ada pencarion
		if( $this->input->post('search')['value'] ):

			// where
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					// $this->db->or_like($column, $post_search['value']);
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$this->db->where( $where_string );
			// where

			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('status', 'pre_customer');
			$this->db->select('customer.*');
			$query = $this->db->get("customer",$length, $start);
			// pre($this->db->last_query());

			//mencari total data ketika dalam mode pencarian
			// where
			$where_string = "( ";
			$where_string_x = '';
			for($i=0; $i<count($this->input->post('columns')); $i++){
	            $column = $post_columns[$i]['name'];
				$searchable = $post_columns[$i]['searchable'];
				if($searchable=='true'):
					// $this->db->or_like($column, $post_search['value']);
					$where_string_x .= $column." like '%".$post_search['value']."%' OR ";
				endif;
	        }
			$where_string_x = substr($where_string_x, 0, strlen($where_string_x)-4);
			$where_string .= $where_string_x;
			$where_string .= " )";
			$this->db->where( $where_string );
			// where
			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('status', 'pre_customer');
			$total_filtered = $this->db->get("customer")->num_rows();
			$recordsFiltered = $total_filtered;

		//bukan pencarian
		else:
			$this->db->order_by('id', 'desc');
			$this->scope->where('customer');
			if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('customer.status', 'pre_customer');
			$this->db->select('customer.*');
			$query = $this->db->get("customer",$length, $start);
			$recordsFiltered = $recordsTotal;
		endif;
		$data = $query->result_array();
		// pre($data);

		//Array dari database diedit dulu biar sesuai dengan output table
		//proses custom data dilakukan di sini
		//contoh dalam case ini adalah membuat marketing progress bar

		$formated_data = array();
		if(!empty($data)):
			$urut = ($this->input->post('start')) ? $this->input->post('start') : 0;
			foreach($data as $row):
				$urut++;
				//focus customer
				// $pre_customer_name = '<a onclick="focus_this(\'js_table_pre_customer\', \''.base_url().'customer/focus/'.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['customer_name'], 40).'</a>';
				$pre_customer_name = '<a onclick="show_this(\''.$row['id'].'\')" href="javascript:void(0);">'.clean_string($row['customer_name'], 40).'</a>';

				//action form
				$button['update'] = array('label'=>$this->lang->line('all_update'), 'url'=>'javascript:void(0);', 'icon'=>'icon-pencil7', 'more'=>'onclick="update(\''.$row['id'].'\');" class="edit_button" ');
				// $button['search'] = array('label'=>$this->lang->line('all_asearch'), 'url'=>'javascript:void(0);', 'icon'=>'icon-search4', 'more'=>'onclick="search_customer(\''.$row['id'].'\');" class="edit_button" ');
				$action = $this->actionform->dropdown($button);

				//marketing progress bar
				$data_mp_bar = array();
				$data_mp_bar['pre_customer_id'] = $row['id'];
				$data_mp_bar['prosentase'] = $this->pre_customer->get_marketing_progress($row['id']);
				$progress_bar = $this->load->view('pre_customer/progress_bar', $data_mp_bar, TRUE);

				$formated_data[] = array(
					'id'					=> $urut,
					'customer_name'			=> $pre_customer_name,
					'customer_address'		=> $row['customer_address'],
					'contact_person'		=> $row['contact_person'],
					'telephone_work'		=> $row['telephone_work'],
					'mp_bar'				=> $progress_bar,
					'action'				=> $action,
				);
			endforeach;
		endif;
		// pre($formated_data);

		//terakhir .... Create JSON nya
		$response = array(
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data
	    );
	    return json_encode($response);
	}

	function get_pre_customer_by_user($user_id)
	{
		$this->db->where('id_am', $user_id);
		$this->db->where('status', 'pre_customer');
		return $this->db->get('customer')->result_array();
	}

    function all()
    {
        // $this->db->where('status !=', 'need_approval');
        $this->db->where('status', 'pre_customer');
        return $this->db->get('customer')->result_array();
    }

	function get_marketing_progress($customer_id)
	{
		$this->db->order_by('master.order', 'DESC');
		$this->db->where('task.location_id', $customer_id);
		//$this->db->where('marketing_progress.id_user', my_id());
		$this->db->select('task.*, master.order');
		$this->db->join('master', 'task.category = master.code AND task.category <> \'general\'');
		$query = $this->db->get('task', 1);
		$progress = $query->row_array();
		//pre($this->db->last_query());

		if(empty($progress)):
			$prosentase = 0;
		else:
			$step = (int) $progress['order'];
			$prosentase = ($step/6)*100;
		endif;

		return $prosentase;
	}

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('customer_group')->row_array();
    }

	function widget($mode)
	{
		switch ($mode) {
			default:
			$this->db->order_by('customer.id', 'desc');
			$this->scope->where('customer');
            if(!modul_full_access('pre_customer') && !modul_full_view('pre_customer')):
				$this->db->where('id_am', my_id());
			endif;
			$this->db->where('customer.status', 'pre_customer');
			$this->db->select('customer.customer_name');
			$this->db->select('customer.id');
			$this->db->select('users.name as am');
			$this->db->select('jenis_pelanggan.name as jenis_pelanggan');
			$this->db->join('users', 'customer.id_am = users.id', 'left');
			$this->db->join('master jenis_pelanggan', 'jenis_pelanggan.code = customer.customer_type and jenis_pelanggan.category=\'customer_type\'', 'left');
			return $this->db->get('customer', 4)->result_array();
			break;
		}
	}
	function data_marketing_progress($location_id)
	{
		$this->db->select('task.*, master.order')
			->join('master', 'task.category = master.code')
			->where('task.location_id', $location_id)
			->where('task.task_category','marketing_progress')
			->order_by('master.order', 'ASC');
		$query = $this->db->get('task');
		$total = $query->num_rows();
		$data = $query->result_array();
		return $data;
	}

	function child_marketing_progress($up,$index=0)
	{
		$arr = array();
		$this->db->select('task.*, \'false\' AS is_trial');
		$this->db->where('up', $up);
		$query = $this->db->get('task');
		$total = $query->num_rows();
		$data = $query->row_array();
		if ($total>0) {
			$child = $this->child_marketing_progress($data['id'],$index++);
			if ($child) {
				$data['child']= $child;
			} else {
				$data['child'] = array();
			}
			$arr = $data;
		}
		return $arr;
	}

	function get_contact_person($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$q = $this->db->get('contact_person');
		$data = $q->result_array();
		return $data;
	}

	function timeline($customer_id, $up='')
	{
		// $data = array();
		$this->db->select('task.id, task.up, task.task_category, task.category, task.date_created, task.date_start, task.date_due, task.subject, task.body, task.location_id, task.note, task.flock, author.name as author_name, master.name AS master_name');
		$this->db->where('location_id', $customer_id)
			->where('up', $up)
			// ->where('flock','n')
			->group_start()
				->where('location','customer')
				->or_where('location','pre_customer')
			->group_end()
			->order_by('id', 'asc');
		$this->db->join('users author', 'author.id = task.author', 'left');
		$this->db->join('master', 'task.category = master.code', 'left');
		$query = $this->db->get('task');
		$data = $query->result_array();

		$i = 0;
		foreach ($data as $row) {

			// child
			$this->db->where('up', $row['id']);
			$q = $this->db->get('task');
			if ($q->num_rows() > 0)
				$data[$i]['child'] = $this->timeline($row['location_id'], $row['id']);

			// user_assign
			$this->db->select('users.name, users.email');
			$this->db->where('task_id', $row['id']);
			$this->db->join('users', 'users.id = task_user_assigned.user_id');
			$q = $this->db->get('task_user_assigned');
			if ($q->num_rows() > 0)
				$data[$i]['user_assign'] = $q->result_array();

			$i++;
		}

		return $data;
	}

}
