<?php
class Model_laporan_harian extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function widget()
	{
		return array();
	}

	function sub_title($filter='', $url='')
	{
		return '';
	}

	function hook($task_id, $mode='')
	{
		$this->load->model('Model_request', 'request');
		$this->load->model('Model_customer', 'customer');
		$this->load->model('Model_bts', 'bts');
		$arr = array();
		switch ($mode) {
			case 'insert':
				
				//send mail
				$data = array();
				$detail = $this->request->detail($task_id);
				$data = $detail;
				$data['task_ext'] = $this->get_task_ext($detail['id'], $detail);
				$data['customer'] = $detail['location']=='bts' ? $this->bts->detail($detail['location_id']) : $this->customer->detail_customer($detail['location_id']);
				// print_r($data);
				$email_support = $this->emailer->sendto('support');
				$email_ce = $this->emailer->sendto('ce');
				$receiver = $email_support.', '.$email_ce;

				$am_email = $data['customer']['am_email'];
				$lokasi = $detail['location']=='bts' ? $data['customer']['bts_name'] : $data['customer']['customer_name'];

				$subject = 'ERP#Laporan.Harian#'.$task_id.'#'.$lokasi;

				$html = $this->load->view('email/template/laporan_harian', $data, TRUE);

				//attachment
				$attachment = $this->get_attachment($detail['id']);
				if (!empty($attachment)) {
					foreach ($attachment as $row) {
						$email['attachment'][] = array(
							'path'	=> FILE_PATH_ATTACHMENT.'laporan_harian/'.$row['file_name']
						);
					}
				}

				$email['to'] = $receiver;
				$email['cc'] = $am_email;
				$email['subject'] = $subject;
				$email['body'] = $html;

				$debug = $this->send_email->compose($email);
				$arr['sendmail'] = $debug;
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

	function tabs()
	{
		return array();
	}

	function set_ui()
	{
		$arr = array();
		$arr['breadcrumb'] = array(
				'Home' => base_url(),
				'Laporan harian' => '#'
			);
		$arr['main_action'] = array(
				'<a onclick="input();" href="javascript:void(0)"><i class="icon-plus3"></i> '.$this->lang->line('all_input').' </a>',
				// '<a onclick="asearch();" href="javascript:void(0)"><i class="icon-search4"></i> Search</a>',
				// '<a onclick="statistic();" href="javascript:void(0)"><i class="icon-chart"></i> Statistik</a>',
			);
		$arr['table_column'] = array(
				array('label'   => '#', 'width'=>'5'),
				array('label'   => 'Pelapor'),
				array('label'   => 'Tanggal'),
				array('label'   => 'Lokasi'),
				array('label'   => 'Judul'),
				// array('label'   => 'Kategori'),
				array('label'   => $this->lang->line('all_action'), 'width'=>'80'),
			);
		return $arr;
	}

	function task_ext($task_id)
	{
		$params = array();
		$this->request->task_ext($task_id, 'task_laporan_harian', $params);
	}

	function get_task_ext($task_id)
	{
		$this->db->where('task_id', $task_id);
		$data = $this->db->get('task_laporan_harian')->row_array();
		return $data;
	}

	function detail($task_id)
	{
		$arr = array();
		$task_detail =  $this->request->detail($task_id);
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
			$this->db->where('location_id', $filter['location_id']);
		endif;
	}

	function get_attachment($task_id)
	{
		$this->db->where('task_id', $task_id);
		$query = $this->db->get('task_attachment');
		$data = $query->result_array();
		return $data;
	}

	function data($modul, $filter)
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
			$this->filtering($filter);
			$this->db->where('task_category', $modul['categories']);
			$this->db->select('task.*');
			$this->db->select('pre_customer.customer_name as customer_name');
			$this->db->select('marketing.name as marketing_name');
			$this->db->join('customer pre_customer', 'pre_customer.id = task.location_id', 'left');
			$this->db->join('users marketing', 'marketing.id = task.author', 'left');
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
				$subject = clean_string($row['subject'], 40);
                $location = $this->location->show($row['location'], $row['location_id']);
				// action button
				$dt_action['action_button'] = array();
				$dt_action['action_button'][] = '<a onclick="update(\''.$row['id'].'\')" href="javascript:void(0);"><i class="icon-pencil"></i> Update</a>';
				$action = $this->load->view('component/action_button/default', $dt_action, TRUE);

				$formated_data[] = array(
					'id'									=> $urut,
					'marketing_name'						=> $row['marketing_name'],
					'subject'								=> $subject,
					'location'							      => $location,
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
	        "data" 				=> $formated_data
	    );
	    echo json_encode($response);
	}

	function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {
			case 'shift' :
				$this->db->where('category', 'shift');
				$data = $this->db->get('master')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['code']] = $row['name'];
					endforeach;
				endif;
			break;

			case 'jenis_laporan_harian' :
				$this->db->where('category', 'jenis_laporan_harian');
				$data = $this->db->get('master')->result_array();
				// pre($this->db->last_query());
				if(!empty($data)):
					foreach($data as $row):
						$arr[$row['code']] = $row['name'];
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
		$arr['shift'] = $this->select_option('shift');
		$arr['jenis_laporan_harian'] = $this->select_option('jenis_laporan_harian');
		return $arr;
	}

	function current_shift()
	{
		$sekarang = mktime(date('H'), date('i'), '0', 0, 0, 0);

		$start_shift_satu = mktime('00', '01', '0', 0, 0, 0);
		$finish_shift_satu = mktime('08', '00', '0', 0, 0, 0);

		$start_shift_dua = mktime('08', '01', '0', 0, 0, 0);
		$finish_shift_dua = mktime('16', '00', '0', 0, 0, 0);

		$start_shift_tiga = mktime('16', '01', '0', 0, 0, 0);
		$finish_shift_tiga = mktime('23', '59', '0', 0, 0, 0);

		if($sekarang >= $start_shift_satu && $sekarang <= $finish_shift_satu){
			$current_shift = 'shift_1';
		} elseif($sekarang >= $start_shift_dua && $sekarang <= $finish_shift_dua){
			$current_shift = 'shift_2';
		} else {
			$current_shift = 'shift_3';
		}

		return $current_shift;
	}
}
