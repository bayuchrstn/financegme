<?php
class Model_ticket_open extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.date_start', 'statusnya', 'typenya', 'prioritynya', 'forwardednya', 'subject'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.name';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS *, date_format(a.date_start, '%d/%m/%Y %H:%i') as tanggal_start,
		case a.status when 1 then 'OPEN' when 3 then 'CLOSED' end as statusnya,
		case a.type when 1 then 'GANGGUAN' when 2 then 'PERMINTAAN' end as typenya,
		case a.priority when 1 then 'LOW' when 2 then 'MEDIUM' when 3 then 'HIGH' end as prioritynya,
		case a.forwarded when 1 then 'HELP DESK' end as forwardednya,
		(SELECT COUNT(id) FROM gmd_ticket WHERE up = a.id) as jml_down,
		COALESCE((SELECT status FROM gmd_ticket WHERE up = a.id),0) as cek_down
		", false);
        $this->db->from('ticket a');
		$this->db->group_start();
		$this->db->like('a.subject', $this->input->post('search_keyword'));
		//$this->db->or_like('a.account_name', $this->input->post('search_keyword'));
		//$this->db->or_like('a.account_number', $this->input->post('search_keyword'));
		$this->db->group_end();
		$this->db->where('a.admin', $this->session->userdata('userid'));
		$this->db->where('a.status', 1);
		$this->db->order_by($order_name, $order_dir);
        if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $q = $this->db->get();
		$qn = $this->db->query('SELECT FOUND_ROWS() AS ttl');
		$n = $qn->row()->ttl;
        $data = array();
        $no = $_POST['start'];
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$cek = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
				if($r['jml_down'] > 0){
					$cek = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
					if($r['cek_down'] == 3){
						$cek = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="closed_data(\''.$r['id'].'\')"><i class="icon-close2 position-left text-slate-800"></i></a>';
					}
				}
				$no++;
				$row = array();
				$row[] = $no.'.';
				$row[] = $r['tanggal_start'];
				$row[] = $r['statusnya'];
				$row[] = $r['typenya'];
				$row[] = $r['prioritynya'];
				$row[] = $r['forwardednya'];
				$row[] = $r['subject'];
				$row[] = $cek;
	 
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
	 
	function create_queue_id(){
		$invoice_cek = 0;
		$userid = str_pad($this->session->userdata('userid'), 4, '0', STR_PAD_LEFT);
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
		$invoice = date('ymdhi').$userid.$code_queue_zero;
		while($invoice_cek < 1){
			$this->db->where("id = '".$invoice."'", NULL, FALSE);
			$q = $this->db->get('ticket');
			if($q->num_rows() == 0){
				$invoice_cek = 1;
			}else{
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 2, '0', STR_PAD_LEFT);
				$invoice = date('ymdHi').$userid.$code_queue_zero;
			}
			$q->free_result();
		}
		return $invoice;
	}
	 
	function insert(){
		$this->db->trans_start();
		$create_queue_id = $this->create_queue_id();
		$data = array( 
					'id' => $create_queue_id,
					'lokasi' => $this->input->post('lokasi'),
					'ref_id' => $this->input->post('ref_id'),
					'forwarded' => $this->input->post('forwarded'),
					'subject' => $this->input->post('subject'),
					'report' => $this->input->post('report'),
					'question' => $this->input->post('question'),
					'status' => 1,
					'type' => $this->input->post('type'),
					'priority' => $this->input->post('priority'),
					'date_start' => date('Y-m-d H:i:s'),
					'admin' => $this->session->userdata('userid'),
					'branch' => $this->cek_id_regional($this->session->userdata('scope_area')),
				);
		$result=$this->db->insert('ticket', $data);	
		if($result==true)
		{
			if(isset($_POST['ques_id'])){
				foreach($_POST['ques_id'] as $k => $v){
					$qd = $this->db->query("insert into gmd_ticket_answer (id_ticket, id_question, descripton, answer) values 
					('".$create_queue_id."', '".$_POST['ques_id'][$k]."', '".$_POST['ques_nama'][$k]."', '".$_POST['ques_answer'][$k]."')");
				}
			}
				
			$sub_dep = 0;
			$link_url = 0;
			if($this->input->post('forwarded') == '1'){
				$sub_dep = 'sub_dept_noc_helpdesk';
				$link_url = 'ticket_noc_helpdesk';
			}
			$this->db->from('users a');
			$this->db->where('a.sub_department', $sub_dep);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$this->m_global->insert_alert_notif('ticket', 'Open Ticket', $this->input->post('subject'), 'unread', date('Y-m-d H:i:s'), $r['id'], $link_url, '0');
				}
			}
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
		$this->db->select("*, if(up_default = 0, id, up_default) as up_default", false);
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("ticket");
		return $q->result();
	}
	 
	function update(){
		$data = array( 
					//'forwarded' => $this->input->post('forwarded'),
					'subject' => $this->input->post('subject'),
					'report' => $this->input->post('report'),
					//'status' => $this->input->post('status'),
					'type' => $this->input->post('type'),
					'priority' => $this->input->post('priority'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('ticket', $data);	
		if($result==true)
		{
			$this->db->where('id_ticket', $this->input->post('id'));
			$qd = $this->db->delete('gmd_ticket_answer');
			if($qd==true){
				if(isset($_POST['ques_id'])){
					foreach($_POST['ques_id'] as $k => $v){
						$qd = $this->db->query("insert into gmd_ticket_answer (id_ticket, id_question, descripton, answer) values 
						('".$this->input->post('id')."', '".$_POST['ques_id'][$k]."', '".$_POST['ques_nama'][$k]."', '".$_POST['ques_answer'][$k]."')");
					}
				}
			}
			
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$result=$this->db->delete('ticket');
		if($result==true)
		{
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		return $msg;
	}
	 
	function closed_data($id){
		$data = array( 
					'status' => 3,
				);
		$this->db->where('id', $id);
		$result=$this->db->update('ticket', $data);	
		if($result==true)
		{
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
	 
	function insert_comment(){
		$this->db->trans_start();
		$data = array( 
					'up' => $this->input->post('up_default'),
					'comment' => $this->input->post('comment_line'),
					'tanggal' => date('Y-m-d H:i:s'),
					'admin' => $this->session->userdata('userid'),
				);
		$result=$this->db->insert('ticket_comment', $data);	
		if($result==true)
		{
			/*
			$sub_dep = 0;
			$link_url = 0;
			if($this->input->post('forwarded') == '1'){
				$sub_dep = 'sub_dept_noc_helpdesk';
				$link_url = 'ticket_noc_helpdesk';
			}
			$this->db->from('users a');
			$this->db->where('a.sub_department', $sub_dep);
			$q = $this->db->get();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					$this->m_global->insert_alert_notif('ticket', 'Open Ticket', $this->input->post('subject'), 'unread', date('Y-m-d H:i:s'), $r['id'], $link_url, '0');
				}
			}
			*/
			$msg = $this->get_timeline($this->input->post('up_default'));
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}

	function get_timeline($up)
	{
		$data = '';
		$this->db->select("SQL_CALC_FOUND_ROWS *, date_format(a.tanggal, '%d/%m/%Y %H:%i') as tanggal_nya,
		b.name as nama", false);
        $this->db->from('ticket_comment a');
		$this->db->join('users b','a.admin = b.id','left');
		$this->db->where('a.up', $up);
		$this->db->order_by('a.tanggal', 'asc');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $r){
				$data .= '<li class="media"><div class="media-body"><div class="media-heading">
										<a href="#" class="text-semibold">'.$r['nama'].'</a>
										<span class="media-annotation dotted">'.$r['tanggal_nya'].'</span>
									</div>
									'.$r['comment'].'</div></li>';
	 
			}
		}else{
			$data = 'No data';
		}
		$q->free_result();
        return $data;
	}
	
	function change_question($id, $id_ticket)
	{
		$data = '';
		$q = $this->m_global->gmd_ticket_question($id);
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$answer = $this->get_answer($r['id'],$id_ticket);
				$data .= '<div class="form-group">
							<label><em>'.($k+1).' .'.$r['descripton'].' ?</em></label>
							<input type="hidden" name="ques_id[]" value="'.$r['id'].'">
							<input type="hidden" name="ques_nama[]" value="'.$r['descripton'].'">
							<input class="form-control" type="text" name="ques_answer[]" value="'.$answer.'" />
						</div>';
			}
		}
		return $data;
	}
	
	function get_answer($id, $id_ticket)
	{
		$data = '';
		$this->db->select("a.answer", false);
        $this->db->from('ticket_answer a');
		$this->db->where('a.id_ticket', $id_ticket);
		$this->db->where('a.id_question', $id);
		$this->db->order_by('a.answer', 'asc');
		$this->db->limit('1');
        $q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data .= $k.$r['answer'];
			}
		}
		return $data;
	}
	 
}
