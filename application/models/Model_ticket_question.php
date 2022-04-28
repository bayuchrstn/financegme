<?php
class Model_ticket_question extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.nama'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.name';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", false);
        $this->db->from('ticket_question_type a');
		$this->db->group_start();
		$this->db->like('a.nama', $this->input->post('search_keyword'));
		$this->db->group_end();
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
				$row = array();
				$row[] = $no.'.';
				$row[] = $r['nama'];
				$row[] = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a> <a href="#" onClick="delete_data(\''.$r['id'].'\')"><i class="icon-bin position-left text-grey"></i></a>';
	 
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
		$code_queue = 1;
		$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
		$invoice = date('y').$code_queue_zero;
		while($invoice_cek < 1){
			$this->db->where("id = '".$invoice."'", NULL, FALSE);
			$q = $this->db->get('ticket_question_type');
			if($q->num_rows() == 0){
				$invoice_cek = 1;
			}else{
				$code_queue++;
				$code_queue_zero = str_pad($code_queue, 3, '0', STR_PAD_LEFT);
				$invoice = date('y').$code_queue_zero;
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
					'nama' => $this->input->post('nama'),
				);
		$result=$this->db->insert('ticket_question_type', $data);	
		if($result==true)
		{
				if(isset($_POST['tambah_pertanyaan'])){
					foreach($_POST['tambah_pertanyaan'] as $k => $v){
						$qd = $this->db->query("insert into gmd_ticket_question (type, descripton) values 
						('".$create_queue_id."', '".$_POST['tambah_pertanyaan'][$k]."')");
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
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("ticket_question_type");
		return $q->result();
	}
	 
	function update(){
		$this->db->trans_start();
		$data = array( 
					'nama' => $this->input->post('nama'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('ticket_question_type', $data);	
		if($result==true)
		{
			$this->db->where('type', $this->input->post('id'));
			$q=$this->db->delete('ticket_question');
			if($q==true){
				if(isset($_POST['tambah_pertanyaan'])){
					foreach($_POST['tambah_pertanyaan'] as $k => $v){
						$qd = $this->db->query("insert into gmd_ticket_question (type, descripton) values 
						('".$this->input->post('id')."', '".$_POST['tambah_pertanyaan'][$k]."')");
					}
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
	
	function delete($id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$result=$this->db->delete('ticket_question_type');
		if($result==true)
		{
			$this->db->where('type', $id);
			$this->db->delete('ticket_question');
			$msg = 1;
		}
		else
		{
			$msg = 0;
		}
		$this->db->trans_complete();
		return $msg;
	}
	 
	function select_data_detail()
	{
		$data = '';
		
		$this->db->select("a.*", false);
		$this->db->from('ticket_question AS a');
		$this->db->where('a.type', $this->input->post('id'));
		$this->db->order_by('a.id', 'asc');
		$q = $this->db->get();
		if($q->num_rows() > 0){
			foreach($q->result_array() as $k => $r){
				$data .= '<tr class="remove">';
				$data .= '<td style="vertical-align:middle;"><input class="form-control" type="text" name="tambah_pertanyaan[]" value="'.$r['descripton'].'" /></td>';
				$data .= '<td style="vertical-align:middle;"><button type="button" class="button">X</button></td>';
				$data .= '</tr>';
				
				
			}
		}
		$q->free_result();
		return $data; 
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

}
