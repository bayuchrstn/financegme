<?php
class Model_task_teknis extends CI_Model {

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
			// case 'survey':
			// 	$this->db->order_by('id', 'desc');
			// 	$this->db->where('task_category', 'task_teknis');
			// 	$this->db->where('category', 'survey');
			// 	$this->db->select('task.*');
			// 	$this->db->select('author.name as author_name');
			// 	$this->db->join('users author', 'author.id = task.author', 'left');
			// 	$data = $this->db->get('task', 10)->result_array();
			// 	$arr['last_mp'] = $data;
			// break;

			default:
				$this->db->order_by('id', 'desc');
				$this->db->where('task_category', 'task_teknis');
				$this->db->where('category', $mode);
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

    function params_ext($task_id)
	{
		$params = array();
		return $params;
	}

	function hook($task_id, $mode='')
	{
		$arr = array();
		switch ($mode) {
			case 'delete':
				echo 'Hapus';exit;
				break;
			
			default:
				// code...
				break;
		}
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
		        array('label'   => 'Judul'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
		        array('label'   => 'Jenis pekerjaan'),
		        array('label'   => 'pelaksana'),
		        array('label'   => 'Action'),
			)
		);
		$arr[] = array(
			'name'=>'Selesai',
			'code'=>'selesai',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Judul'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
		        array('label'   => 'Task Creator'),
		        array('label'   => 'pelaksana'),
		        array('label'   => 'Action'),
			)
		);
		$arr[] = array(
			'name'=>'Belum Selesai',
			'code'=>'belum_selesai',
			'table_columns' => array(
				array('label'   => '#', 'width'=>'5'),
		        array('label'   => 'Judul'),
				array('label'   => 'Mulai'),
		        array('label'   => 'Selesai'),
		        array('label'   => 'Lokasi'),
		        array('label'   => 'Task Creator'),
		        array('label'   => 'pelaksana'),
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
				'Pekerjaan Teknis' => '#'
			);
		$arr['main_action'] = array(
				'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
				// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
				// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
			);
		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Dari'),
				array('label'   => 'Judul'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Tanggal Request'),
				array('label'   => 'Kategori'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			);
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

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);

		// customize
		$jenis_pekerjaan = $this->master->master_by_code('jenis_pekerjaan_teknis', $task_detail['category']);
		$pelaksana = $this->request->get_user_assigned($task_detail['id']);
		$pelaksana = implode(", ", $pelaksana);
		// customize

		$arr['location_name'] = $this->location->show($task_detail['location'], $task_detail['location_id']);
		$arr['jenis_pekerjaan'] = $jenis_pekerjaan['name'];
		$arr['pelaksana'] = $pelaksana;
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
		$this->scope->where('task');
		$this->db->where('task.status', $status);
		$this->db->where('task_category', $modul['categories']);
		$this->db->where('flock', 'n');
		$this->db->select('COUNT({PRE}task.id) as total');
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
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;

			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where( $where_string );
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());

			// Edit Here
			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where( $where_string );
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$total_filtered = $this->db->get("task")->num_rows();
			$recordsFiltered = $total_filtered;
			$last_query = $this->db->last_query();

		//bukan pencarian
		else:
			// Edit Here
			for($i=0; $i<count($post_order); $i++):
				$orderByColumnIndex  = $post_order[$i]['column'];
			    $orderBy = $post_columns[$orderByColumnIndex]['name'];
				$orderType = $post_order[$i]['dir'];
				$this->db->order_by($orderBy, $orderType);
			endfor;

			$this->filtering($filter);
			$this->scope->where('task');
			$this->db->where('task.status', $status);
			$this->db->where('task_category', $modul['categories']);
			$this->db->where('flock', 'n');
			$this->db->select('task.*');
			$this->db->select('author.name as author_name');
			$this->db->select('task_category.name as task_category_name');
			$this->db->join('users author', 'author.id = task.author', 'left');
			$this->db->join('master task_category', 'task_category.code = task.category and task_category.category=\'jenis_pekerjaan_teknis\'', 'left');
			$query = $this->db->get("task", $length, $start);
			// pre($this->db->last_query());
			$last_query = $this->db->last_query();
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

				//pelaksana
				$pelaksana = $this->request->get_user_assigned($row['id']);
				$pelaksana = implode(", ", $pelaksana);

				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';

				//delete
				if (have_privileges('delete_task_teknis') && $status=='progress') {
				 	$dt_action['action_button'][] = '<a onclick="hapus(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-trash"></i> Delete</a>';
				}

				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'subject'								=> $subject,
					'date_start'							=> format_date($row['date_start']),
					'date_due'								=> format_date($row['date_due']),
					'lokasi'								=> $lokasi,
					'task_category_name'					=> $row['task_category_name'],
					'pelaksana'								=> $pelaksana,
					'action'								=> $action,
				);
			endforeach;
		endif;
		// exit;
		$response = array(
			// "query"	=> $last_query,
	        "draw" 				=> intval($draw),
	        "recordsTotal" 		=> $recordsTotal,
	        "recordsFiltered" 	=> $recordsFiltered,
	        "data" 				=> $formated_data
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
			case 'assigned_user' :

				if (is_admin() || is_admin_regional()) :
					$this->db->group_start();
						$this->db->group_start();
							$this->scope->where('users');
						$this->db->group_end();
						$this->db->or_where('level', 'su');
					$this->db->group_end();
				else :
					$this->scope->where('users');
				endif;
				// $this->db->where('departement', 'teknis');
				$this->db->where('status', 'active');
				$data = $this->db->get('users')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['id']] = $row['name'];
					endforeach;
				endif;
			break;

			case 'jenis_pekerjaan_teknis' :
				$data = $this->master->arr('jenis_pekerjaan_teknis');
				// pre($data);
				if(!empty($data)):
					foreach($data as $row=>$val):
						$arr[$row] = $val;
					endforeach;
				endif;
			break;

			//pre customer
			default:
				$this->db->where('status_active !=', '0');
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
		$arr['assigned_user'] = $this->select_option('assigned_user');
		$arr['jenis_pekerjaan_teknis'] = $this->select_option('jenis_pekerjaan_teknis');
		return $arr;
	}

    function cek_laporan($task_id='')
    {
        $this->db->where('task_category', 'task_report');
        $this->db->where('up', $task_id);
        $data = $this->db->get('task')->row_array();
        return $data;
    }

    function update_koordinat()
    {
    	$koordinat = $this->input->post('koordinat_klien') ? $this->input->post('koordinat_klien') : $this->input->post('koordinat');
    	$lokasi = $this->input->post('location_id');
    	$data = array('koordinat' => $koordinat);
    	$this->db->where('id', $lokasi);
    	$this->db->update('customer', $data);
    }
}
