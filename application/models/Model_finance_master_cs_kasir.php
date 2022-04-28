<?php 
class Model_finance_master_cs_kasir extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function get_data_table()
	{
		$column_order = array(null, 'a.kasir'); 
		$order_name = (isset($_POST['order']))? $column_order[$_POST['order']['0']['column']]:'a.name';
		$order_dir = (isset($_POST['order']))? $_POST['order']['0']['dir']:'asc';
		
		$this->db->select("SQL_CALC_FOUND_ROWS a.*, date_format(a.kasir, '%d/%m/%Y') as tanggalnya", false);
        $this->db->from('finance_close_date a');
		$this->db->where('a.branch',$this->model_global->cek_id_regional($this->session->userdata('scope_area')));
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
				$row[] = $r['tanggalnya'];
				$row[] = '<a href="#" onClick="view_data(\''.$r['id'].'\')"><i class="icon-menu7 position-left text-slate-800"></i></a>';
	 
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
		$data = array( 
					'nama' => $this->input->post('nama'),
				);
		$result=$this->db->insert('finance_close_date', $data);	
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
	 
	function select(){
		$this->db->where("id", $this->input->post('id'));
		$q = $this->db->get("finance_close_date");
		return $q->result();
	}
	 
	function update(){
		$data = array( 
					'kasir' => $this->input->post('tanggal'),
				);
		$this->db->where('id', $this->input->post('id'));
		$result=$this->db->update('finance_close_date', $data);	
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
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$result=$this->db->delete('finance_close_date');
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

}
