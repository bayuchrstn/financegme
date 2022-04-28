<?php
class Model_task extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function dari()
	{
		$this->db->get('task');
	}

	function task_valid_modul($code)
    {
        $this->db->where('modul.code', $code);
		$this->db->select('*');
		// $this->db->select('task_category.name');
		$this->db->join('task_category', 'task_category.task_code=modul.code', 'left');
        return $this->db->get('modul')->row_array();
    }

	

	// pencarian by column dari jquery data
	function search_by_column()
	{
		for($i=0; $i<count($this->input->post('columns')); $i++){
			$column = $this->input->post('columns')[$i]['data'];
			$searchable = $this->input->post('columns')[$i]['searchable'];
			if($searchable=='true'):
				$this->db->or_like($column, $this->input->post('search')['value']);
			endif;
		}
	}

	function filter($filter)
	{
		// pre($filter);
		if(is_array($filter) && !empty($filter)):
			foreach($filter as $row):
				arr_to_query($row);
			endforeach;
		endif;
	}

	// mengambil total jumlah data keseluruhan
	function total_record($task_category, $filter)
	{
		$this->filter($filter);
		$this->db->where('task_category', $task_category);
		$data = $this->db->get('task')->num_rows();
		return $data;
	}

	// menampilkan data pada mode pencarian
	function searching_data($task_category, $orderBy, $orderType, $length, $start, $filter)
	{
		$this->db->order_by($orderBy, $orderType);

		$this->search_by_column();
		$this->filter();
		$this->db->where('task_category', $task_category);

		$this->db->select('task.*');
		$this->db->select('author.name as author_name');
		$this->db->join('users author', 'author.id = task.author', 'left');
		$data = $this->db->get("task", $length, $start);
		// pre($this->db->last_query());
		return $data;
	}

	// mengambil total jumlah data pada mode pencarian
	function total_searching_data($task_category, $filter)
	{
		//mencari total data ketika dalam mode pencarian
		$this->search_by_column();
		$this->filter();
		$this->db->where('task_category', $task_category);

		$this->db->select('task.*');
		$this->db->select('author.name as author_name');
		$this->db->join('users author', 'author.id = task.author', 'left');
		$total_filtered = $this->db->get("task")->num_rows();
		return $total_filtered;
	}

	// menampilkan data tanpa pencarian
	function all_data($task_category, $start, $length, $filter)
	{
		$this->filter($filter);
		$this->db->where('task_category', $task_category);
		$this->db->select('task.*');
		$this->db->select('author.name as author_name');
		$this->db->join('users author', 'author.id = task.author', 'left');
		// pre($this->db->last_query());
		return $this->db->get("task", $length, $start);
	}

	// global
	function data($task_category, $filter='')
	{
		// param ini dikirim otomatis oleh Jquery datatables
		$draw = $this->input->post('draw');
	    $orderByColumnIndex  = $this->input->post('order')[0]['column'];
	    $orderBy = $this->input->post('columns')[$orderByColumnIndex]['data'];
	    $orderType = $this->input->post('order')[0]['dir'];
	    $start  = $this->input->post('start');
	    $length = $this->input->post('length');
		// param ini dikirim otomatis oleh Jquery datatables

		// EDIT DISINI
		$recordsTotal = $this->total_record($task_category, $filter);

		//jika ada pencarion
		if( $this->input->post('search')['value'] ):
			$query = $this->searching_data($task_category, $orderBy, $orderType, $length, $start, $filter);
			$recordsFiltered = $this->total_searching_data($task_category, $filter);
		//bukan pencarian
		else:
			$query = $this->all_data($task_category, $start, $length, $filter);
			$recordsFiltered = $recordsTotal;
		endif;

		$res = array();
		$data = $query->result_array();
		$res['data'] = $data;
		$res['draw'] = intval($draw);
		$res['recordsTotal'] = $recordsTotal;
		$res['recordsFiltered'] = $recordsFiltered;
		$res['draw'] = intval($draw);

		return($res);
	}

	function detail($task_id)
	{
		$this->db->where('task.id', $task_id);
		$this->db->select('task.*');
		$this->db->select('author.name as author_name');
		$this->db->join('users author', 'author.id = task.author', 'left');
		$data = $this->db->get('task')->row_array();
		return $data;
	}

	function location($location, $location_id)
	{

		switch ($location) {
			case 'bts':
				$this->db->where('id', $location_id);
				$data = $this->db->get('bts')->row_array();
				$location_name = $data['bts_name'];
			break;

			case 'pre_customer':
				$this->db->where('id', $location_id);
				$data = $this->db->get('customer')->row_array();
				$location_name = $data['customer_name'];
			break;

			//customer
			default:
				$this->db->where('id', $location_id);
				$data = $this->db->get('customer')->row_array();
				$location_name = $data['customer_name'];
			break;
		}
		return $location_name;
	}

	function ext_current($table, $task_id)
	{
		$this->db->where('task_id', $task_id);
		return $this->db->get($table)->row_array();
	}

	function ext_get_column($table)
	{
		$fields = $this->db->field_data($table);
		return $fields;
	}

	function ext($table, $task_id, $param=array())
	{
		// pre($param);
		$existing = $this->ext_current($table, $task_id);

		$column = $this->ext_get_column($table);
		if(!empty($column)):
			$data = array();
			foreach($column as $field):
				if($field->name !='id' && $field->name !='task_id'):
					if($this->input->post($field->name)):
						$data[$field->name] = htmlspecialchars($this->input->post($field->name));
					elseif(isset($param[$field->name])):
						$data[$field->name] = htmlspecialchars($param[$field->name]);
					else:
						$data[$field->name] = '';
					endif;
				endif;
			endforeach;
		endif;

		if(empty($existing)):
			//diinsert
			$data['task_id'] = $task_id;
			$insert = $this->db->insert($table, $data);
		else:
			$this->db->where('task_id', $task_id);
			$insert = $this->db->update($table, $data);
		endif;
	}

	function ext_detail($table, $task_id)
	{
		$this->db->where('task_id', $task_id);
		return $this->db->get($table)->row_array();
	}

	function lock_task($id)
	{
		$data = array(
			'flock'	=> 'y'
		);
		$this->db->where('id', $id);
		$this->db->update('task', $data);

		$detail = $this->db->where('id', $id)->get('task')->row_array();

		$log = array(
			'task_id'	=> $detail['id'],
			'author'	=> my_id(),
			'author_type'	=> 'users',
			'date_post'	=> date('Y-m-d H:i:s'),
			'code'	=> 'delete_task_'.$detail['task_category'],
			'note'	=> $detail['category']
		);
		$this->insert_task_log($log);
	}

	function insert_task_log($params)
	{
		$this->db->insert('task_log', $params);
	}

	function get_fields()
	{
		return $this->db->list_fields('task');
	}

	function get_by($data = array())
	{
		$this->db->select('*');
		$this->db->from('task');

		foreach ($data as $key => $value) {
			$this->db->where($key, $value);
		}

		return $this->db->get();
	}

	function get_task_parent($task_id)
	{
		$data = array();
		$this->db->select('id, up');
		$this->db->where('id', $task_id);
		$q = $this->db->get('task');
		$data = $q->row_array();
		if (!empty($data)) {
			// get parent
			if ($data['up']!='') {
				$data['parent'] = $this->get_task_parent($data['up']);
			} else {
				$data['parent'] = array();
			}
		}
		return $data;
	}

	function get_task_child($task_id)
	{
		$data = array();
		$this->db->select('id, up');
		$this->db->where('id', $task_id);
		$q = $this->db->get('task');
		$data = $q->row_array();

		if (!empty($data)) {
			// get child
			$this->db->select('id');
			$this->db->where('up', $data['id']);
			$q = $this->db->get('task');
			$dt = $q->result_array();
			if (!empty($dt)) {
				// $data['child'] = $this->get_task_child($dt['id']);
				$i = 0;
				foreach ($dt as $row) {
					$data['child'][$i] = $this->get_task_child($row['id']);
					$i++;
				}
			} else {
				$data['child'] = array();
			}
		}
		return $data;
	}

	function get_upper_task($task_id)
	{
		$id = 0;
		$data = $this->get_task_parent($task_id);
		if (!empty($data)) {
			if (!empty($data['parent'])) {
				$id = $this->get_upper_task($data['up']);
				// echo 'fuck'; exit;
			} else {
				$id = $data['id'];
			}
		}
		return $id;
	}

	function get_related_task_id($data=array())
	{
		$id = '';
		if (!empty($data)) {
			$id .= $data['id'].',';
			if (!empty($data['child'])) {
				for ($i = 0; $i < count($data['child']); $i++) {
					$id .= $this->get_related_task_id($data['child'][$i]);
				}
			}
		}
		return $id;
	}

	function get_task_comment($arr_id = array())
	{
		$this->db->select('task_comment.*, users.name AS author_name');
		$this->db->where_in('task_id', $arr_id);
		$this->db->join('users', 'task_comment.author = users.id', 'left');
		$this->db->group_by('task_comment.id');
		$this->db->order_by('task_comment.id', 'asc');
		$q = $this->db->get('task_comment');
		$data = $q->result_array();
		return $data;
	}

	function get_related_user_task($arr_id = array())
	{
		$data = array();
		if (!empty($arr_id)) {
			$this->db->select('task.id AS task_id, task.task_category, task.subject AS task_subject, users.id AS user_id, users.name AS user_name, users.email AS user_email');
			$this->db->join('users', 'users.id = task.author');
			$this->db->where_in('task.id', $arr_id);
			$this->db->not_like('task.task_category','request_');
			$this->db->group_by('task.author');
			$q = $this->db->get('task');
			$data = $q->result_array();
		}
		return $data;
	}

}
