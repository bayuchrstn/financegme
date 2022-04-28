<?php
class Model_teknis_bod extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'b.date_created', 'a.shift', 'c.customer_name', 'b.subject', 'b.date_start', 'b.date_due', 'time_duration', 'email_onnya', 'email_offnya'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.name';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.subject, c.customer_name,
		date_format(b.date_created, '%d/%m/%Y %H:%i') as date_creatednya, 
		date_format(b.date_start, '%d/%m/%Y %H:%i:%s') as date_startnya, 
		date_format(b.date_due, '%d/%m/%Y %H:%i:%s') as date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration,
		if(a.email_on = 0, '','Done') as email_onnya,
		if(a.email_off = 0, '','Done') as email_offnya", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->group_start();
		$this->db->like('a.shift', $this->input->post('search_keyword'));
		$this->db->or_like('b.subject', $this->input->post('search_keyword'));
		$this->db->or_like('c.customer_name', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('b.area' , $this->session->userdata('scope_area'));
		$this->db->order_by($order_name, $order_dir);
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$no++;
				$edit = ($r['email_on'] == '0' && $r['email_off'] == '0')?'<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\', \''.$r['task_id'].'\')"><i class="icon-bin position-left text-grey"></i></a>':'';
				$time_duration = secondsToTime($r['time_duration']);
				$row = array();
				$row[] = $no.'.';
				$row[] = $r['date_creatednya'];
				$row[] = $r['shift'];
				$row[] = $r['customer_name'];
				$row[] = $r['subject'];
				$row[] = $r['date_startnya'];
				$row[] = $r['date_duenya'];
				$row[] = $time_duration;
				$row[] = $r['email_onnya'];
				$row[] = $r['email_offnya'];
				$row[] = $edit;
	 
				$data[] = $row;
			}
		}
		$q->free_result();
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $n,
                        "recordsFiltered" => $n,
                        "data" => $data,
                );
        echo json_encode($output);
	}
	 
	function insert(){
		$this->db->trans_start();
		$date_created = date('Y-m-d H:i:s');
		$data = array( 
					'task_category' => 'laporan_bod',
					'author' => $this->session->userdata('userid'),
					'date_created' => $date_created,
					'date_start' => $this->input->post('date_start'),
					'date_due' => $this->input->post('date_due'),
					'subject' => $this->input->post('subject'),
					'body' => $this->input->post('pesan'),
					'regional' => $this->session->userdata('scope_regional'),
					'area' => $this->session->userdata('scope_area'),
					'location' => 'customer',
					'location_id' => $this->input->post('location_id'),
					'up' => '',
					'progress_id' => '',
					'category' => '',
					'status' => '',
					'note' => '',
				);
		$result=$this->db->insert('task', $data);	
		if($result==true)
		{
			$task_id = $this->cek_id_task('laporan_bod', $this->session->userdata('userid'),$date_created,$this->input->post('date_start'),$this->input->post('date_due'),$this->input->post('subject'),$this->input->post('pesan'),$this->session->userdata('scope_regional'),$this->session->userdata('scope_area'),'customer',$this->input->post('location_id'));
			$data = array( 
						'task_id' => $task_id,
						'shift' => $this->input->post('shift'),
					);
			$this->db->insert('task_bod', $data);	
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function select(){
		$this->db->select("a.*, b.subject, c.customer_name as pelanggan, c.id as location_id, c.service_id,
		b.date_start, b.date_due, b.body", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->where("a.id", $this->input->post('id'));
        $q = $this->db->get();
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
		$data = array( 
					'shift' => $this->input->post('shift'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('task_bod', $data);	
		if($result==true)
		{
			$data = array( 
						'date_start' => $this->input->post('date_start'),
						'date_due' => $this->input->post('date_due'),
						'subject' => $this->input->post('subject'),
						'body' => $this->input->post('pesan'),
						'location_id' => $this->input->post('location_id'),
					);
			$this->db->where('id', $this->input->post('task_id'));
			$this->db->update('task', $data);	
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	
	function delete($id, $task_id)
	{
		$this->db->where('id', $id);
		$result=$this->db->delete('task_bod');
		if($result==true)
		{
			$this->db->where('id', $task_id);
			$this->db->delete('task');
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	
	function cek_id_regional($id){
		$data = 0;
		
		$q = $this->db->query("select id from gmd_regional where code = '".$id."'");
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	
	function cek_id_task($task_category, $author, $date_created, $date_start, $date_due, $subject, $body, $regional, $area, $location, $location_id){
		$data = 0;
		
		$this->db->select("id", false);
		$this->db->from("task");
		$this->db->where("task_category", $task_category);
		$this->db->where("author", $author);
		$this->db->where("date_created", $date_created);
		$this->db->where("date_start", $date_start);
		$this->db->where("date_due", $date_due);
		$this->db->where("subject", $subject);
		$this->db->where("body", $body);
		$this->db->where("regional", $regional);
		$this->db->where("area", $area);
		$this->db->where("location", $location);
		$this->db->where("location_id", $location_id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = $r['id'];
			}
		}
		$q->free_result();
		
		return $data;
	}
	 
	function select_autocomplite(){
		$this->db->select("a.*", false);
		$this->db->from("customer a");
		$this->db->where("a.status", 'customer');
		//$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
		$this->db->where("(a.customer_name like '%".$this->input->post('term')."%')", NULL, FALSE);
		$q = $this->db->get();
		return $q->result();
	}

	function cek_email_on()
	{
		$tanggal = date('Y-m-d H:i:s');
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.subject, c.customer_name,
		date_format(b.date_created, '%d/%m/%Y %H:%i') as date_creatednya, 
		date_format(b.date_start, '%d/%m/%Y %H:%i:%s') as date_startnya, 
		date_format(b.date_due, '%d/%m/%Y %H:%i:%s') as date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->where("b.date_start <= DATE_ADD('".$tanggal."', INTERVAL 2 DAY)",NULL, FALSE);
		//$this->db->where("b.date_start >= '".$tanggal."'",NULL, FALSE);
		$this->db->where("a.email_on", '0');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = array( 
							'email_on' => 1,
						);
				$this->db->where('id', $r['id']);
				$this->db->update('task_bod', $data);	
			}
		}
		$q->free_result();
	}

	function cek_email_off()
	{
		$tanggal = date('Y-m-d H:i:s');
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, b.subject, c.customer_name,
		date_format(b.date_created, '%d/%m/%Y %H:%i') as date_creatednya, 
		date_format(b.date_start, '%d/%m/%Y %H:%i:%s') as date_startnya, 
		date_format(b.date_due, '%d/%m/%Y %H:%i:%s') as date_duenya,
		TIMESTAMPDIFF(SECOND, b.date_start, b.date_due) as time_duration", false);
        $this->db->from('task_bod a');
		$this->db->join('task b','a.task_id = b.id','left');
		$this->db->join('customer c','b.location_id = c.id','left');
		$this->db->where("b.date_due <= DATE_ADD('".$tanggal."', INTERVAL 2 DAY)",NULL, FALSE);
		//$this->db->where("b.date_due >= '".$tanggal."'",NULL, FALSE);
		$this->db->where("a.email_off", '0');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data = array( 
							'email_off' => 1,
						);
				$this->db->where('id', $r['id']);
				$this->db->update('task_bod', $data);	
			}
		}
		$q->free_result();
	}
	 
}
