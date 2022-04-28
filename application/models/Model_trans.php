<?php
class Model_trans extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function info_modul($request_code)
	{
		// $this->db->where('up', '1001');
        // $this->db->where('note', 'req');
        $this->db->select('modul.*');
        $this->db->select('transaction_config.flag_title as flag_title');
        $this->db->select('transaction_config.flag_due_date as flag_due_date');
		$this->db->where('code', $request_code);
        $this->db->join('transaction_config', 'transaction_config.transaction_code = modul.code', 'left');
		$data = $this->db->get('modul')->row_array();
		// pre($this->db->last_query());
		return $data;
	}

    function tabs()
	{
		$arr = array();

		// $arr['selected'] = array(
		// 	'name'=>'Open',
		// 	'code'=>'open',
		// 	'table_columns' => array(
		// 		array('label'   => '#', 'width'=>'5'),
		// 		array('label'   => 'Tanggal'),
		//         array('label'   => 'Pelanggan'),
		//         array('label'   => 'Customer Service'),
		//         array('label'   => 'Action', 'width'=>'80'),
		// 	)
		// );

		return $arr;
	}

    function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Pekerjaan Teknis' => '#'
			);

		// if($this->uri->segment(2)=='r'):
		// 	$arr['main_action'] = array();
		// else:
		// 	$arr['main_action'] = array(
		// 			'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
		// 		);
		// endif;


		// $arr['table_column'] = array(
		// 		array('label'   => '#', 'width'=>'5'),
		// 		array('label'   => 'Nomor'),
		// 		array('label'   => 'Tanggal'),
		// 		array('label'   => 'Tanggal'),
		// 		array('label'   => 'Jumlah'),
		// 		array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
		// 	);
        //
        // $arr['table_column'] = array();
        // $arr['table_column'][] = array('label' => '#', 'width' => '5');
        // $arr['table_column'][] = array('label' => 'Nomor');
        // $arr['table_column'][] = array('label' => 'Date');
        // $arr['table_column'][] = array('label' => 'Due Date');
        // $arr['table_column'][] = array('label' => 'Amount');
        // $arr['table_column'][] = array('label' => 'Action', 'width'=>'80');



		return $arr;
	}

    function data($category='', $filter='')
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
		// $this->filtering($filter);
		$this->db->where('transaction.category', $category);
		$this->db->select('COUNT({PRE}transaction.id) as total');
		// $this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
		$qryrecordsTotal = $this->db->get('transaction')->row_array();
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
			// $this->filtering($filter);
			$this->db->where('transaction.category', $category);
			$this->db->select('transaction.*');
			// $this->db->select('author.name as author_name');
			// $this->db->join('users author', 'author.id = task.author', 'left');
			$query = $this->db->get("transaction", $length, $start);
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
				// $detail = '<a onclick="focus_this(\'js_table_marketing_progress\', \''.base_url().'marketing_progress/focus/'.$row['id'].'\')" href="javascript:void(0);">Detail</a>';
				$detail = '<a onclick="show_this('.$row['id'].')" href="javascript:void(0);">Detail</a>';



				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Approval</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
    					'id'									=> $urut,
    					'number'								=> $row['number'],
    					'transaction_date'						=> format_date($row['transaction_date']),
    					'transaction_due_date'					=> format_date($row['transaction_due_date']),
    					'title'					                => $row['title'],
                        'amount'								=> currency($row['amount']),
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

}
